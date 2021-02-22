<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\PayPal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
                $payPalConfig["sandbox"]['client_id'],
                $payPalConfig["sandbox"]['client_secret']
            )
        );
        $this->apiContext->setConfig($payPalConfig['settings']);
        
    }

    // ...

    public function payWithPayPal(Buy $buy)
    {
        //Guardo la compra en la sessión para 
        session(["Compra" => serialize($buy)]);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($buy->publication->precio);
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Producto');

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

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
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
            $buy->estado = "cancelado";
            $buy->save();
            $buy->pay()->save($pago);
            return redirect('')->with('error', $status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        $pago->status = $result->getState();
        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            $buy->estado = "pagado";
            $buy->save();
            $buy->pay()->save($pago);
            return redirect('')->with('success', $status);
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        $buy->estado = "cancelado";
        $buy->save();
        $buy->pay()->save($pago);
        return redirect('')->with('error',$status);
    }

    public function cancel()
    {
        //borro la compra y redirijo al curso otra vez
        $buy = unserialize(session("Compra"));
        $buy->delete();
        return redirect('')->with('error', 'Cancelaste el pago, el curso no fue adquirido');
    }

}
