<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Meeting;
use App\Models\Notification;
use App\Models\PayPal;
use App\Models\Teacher_Pay;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Amount;
use PayPal\Api\InputFields;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig["live"]['client_id'],
                $payPalConfig["live"]['client_secret']
            )
        );
        $this->apiContext->setConfig($payPalConfig['settings']);
        
    }


    public function payWithPayPal()
    {
        try {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $buy = unserialize(session("Compra"));
            $amount = new Amount();
            $amount->setTotal($buy->precio);
            $amount->setCurrency('EUR');

            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription("Curso");

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(url('/paypal/process'))
                ->setCancelUrl(url('/paypal/cancel'));
            //Esto es para que no aparezca la opción de envíos que acá no hace falta
            $inputFields = new InputFields();
            $inputFields->setNoShipping(1); // 1 No envíos.

            $webProfile = new WebProfile();
            $webProfile->setName('test' . uniqid())->setInputFields($inputFields);
            $webProfileId = $webProfile->create($this->apiContext)->getId();

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setTransactions(array($transaction))
                ->setRedirectUrls($redirectUrls)
                ->setExperienceProfileId($webProfileId);
        
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            $buy->delete();
            echo $ex->getData();
        }
    }

    public function process(Request $request)
    {
        $pago = new PayPal();
        $paymentId = $pago->paymentId = $request->input('paymentId');
        $payerId = $pago->PayerID = $request->input('PayerID');
        $token = $pago->token = $request->input('token');

        //Obtengo la compra guardada en la sesion
        $buy = unserialize(session("Compra"));
        
        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            $pago->status = "error";
            $buy->delete();
            return redirect('')->with('error', $status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        $pago->status = $result->getState();
        if ($result->getState() === 'approved') {
            try {
                DB::beginTransaction();
                $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
                $buy->estado = "Pagado";
                $buy->save();
                $buy->course->users()->attach(session("Id"));
                $buy->course->cantidadalumnos += 1;
                $buy->pay()->save($pago);
                $buy->push();
                //Cargo el pago del profesor
                $pago_profesor = new Teacher_Pay();
                $pago_profesor->pago = number_format($buy->precio - $buy->montoadministrador, 2);
                $pago_profesor->user_id = $buy->course->publication->user_id;

                $buy->teacher_pay()->save($pago_profesor);
                //Agrego todas las cuotas de ese curso que quedaran como pendientes
                //Si el curso es mensual
                if ($buy->course->cantidadcuotas > 0) {
                    for ($i = 2; $i <= $buy->course->cantidadcuotas; $i++) {
                        $cuota = new Buy();
                        $cuota->course_id = $buy->course->id;
                        $buy->course->ultimaclase = $buy->course->days()->where("cuota", "=", $i)
                            ->orderBy("fecha", "desc")
                            ->value("fecha");
                        $buy->course->cantidadclases = $buy->course->days()->where("cuota", "=", $i)->count();
                        $buy->course->fechaactual = $buy->course->days()->where("cuota", "=", $i)->value("fecha");
                        $cuota->precio = ($buy->course->cantidadclases) * $buy->course->precioclase;
                        $cuota->montoadministrador = number_format($cuota->precio * (100 - $buy->course->porcentajeprofesor) / 100, 2);
                        $cuota->user_id = session("Id");
                        $cuota->estado = "Pendiente";
                        $cuota->tipopago = "mensual";
                        $cuota->cuota = $i;
                        $cuota->fecha = $buy->course->fechaactual;
                        //Calculo la fecha de vencimiento de la cuota. Ultimo día del mes anterior.
                        $vencimiento = new DateTime($buy->course->fechaactual);
                        $vencimiento = $vencimiento->sub(new DateInterval("P1M"));
                        $cuota->fechavencimiento = new DateTime($vencimiento->format("Y-m") . "-" . $vencimiento->format("t") . " 23:59");
                        $cuota->save();
                        foreach ($buy->course->days()->where("cuota", "=", $i)->get() as $dia) {
                            $meeting = new Meeting();
                            $meeting->fecha = $dia->fecha;
                            $cuota->meetings()->save($meeting);
                        }
                    }
                }
                $not = new Notification();
                $not2 = new Notification();
                $not3 = new Notification();
                $not->compraAlumno($buy->course);
                $not2->compraProfesor($buy->course);
                $not3->compraAdministrador($buy->course);
                DB::commit();
                return redirect('')->with('success', $status);

            } catch (\Throwable $th) {
                DB::rollBack();
                $buy->delete();
                return redirect('')->with('error', "Error al realizar la transacción");
            }
            
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        $buy->delete();
        
        return redirect('')->with('error',$status);
    }

    public function cancel()
    {
        //borro la compra y redirijo al curso otra vez
        $buy = unserialize(session("Compra"));
        $buy->delete();
        return redirect('')->with('error', 'Cancelaste el pago, el curso no fue adquirido');
    }

    //Pago de cuotas
    public function payBuy(Buy $buy)
    {
        try {
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $amount = new Amount();
            $amount->setTotal($buy->precio);
            $amount->setCurrency('EUR');

            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription("Curso");

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(url('/paypal/processbuy'))
            ->setCancelUrl(url('/paypal/cancelbuy'));
            //Esto es para que no aparezca la opción de envíos que acá no hace falta
            $inputFields = new InputFields();
            $inputFields->setNoShipping(1); // 1 No envíos.

            $webProfile = new WebProfile();
            $webProfile->setName('test' . uniqid())->setInputFields($inputFields);
            $webProfileId = $webProfile->create($this->apiContext)->getId();

            $payment = new Payment();
            $payment->setIntent('sale')
            ->setPayer($payer)
                ->setTransactions(array($transaction))
                ->setRedirectUrls($redirectUrls)
                ->setExperienceProfileId($webProfileId);

            $payment->create($this->apiContext);
            session(["Compra" => serialize($buy)]);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function processBuy(Request $request)
    {
        $pago = new PayPal();
        $paymentId = $pago->paymentId = $request->input('paymentId');
        $payerId = $pago->PayerID = $request->input('PayerID');
        $token = $pago->token = $request->input('token');

        //Obtengo la compra guardada en la sesion
        $buy = unserialize(session("Compra"));

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            $pago->status = "error";
            return redirect('')->with('error', $status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        $pago->status = $result->getState();
        if ($result->getState() === 'approved') {
            try {
                DB::beginTransaction();
                $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
                $buy->estado = "Pagado";
                $buy->save();
                $buy->pay()->save($pago);
                $buy->push();
                //Cargo el pago del profesor
                $pago_profesor = new Teacher_Pay();
                $pago_profesor->pago = number_format($buy->precio - $buy->montoadministrador, 2);
                $pago_profesor->user_id = $buy->course->publication->user_id;

                $buy->teacher_pay()->save($pago_profesor);
                
                $not = new Notification();
                $not2 = new Notification();
                $not3 = new Notification();
                $not->pagoAlumno($buy);
                $not2->pagoProfesor($buy);
                $not3->pagoAdministrador($buy);
                DB::commit();
                return redirect("/Alumno/Pagos/Pendientes")->with('success', $status);
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect('')->with('error', "Error al realizar la transacción");
            }
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        $buy->delete();

        return redirect('')->with('error', $status);
    }

    public function cancelBuy()
    {
        return redirect('')->with('error', 'Cancelaste el pago, la cuota no fue abonada');
    }
}
