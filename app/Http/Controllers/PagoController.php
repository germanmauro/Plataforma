<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Notification;
use App\Models\Teacher_Pay;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function pagosrecibidos()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $buys = Buy::where("Estado","Pagado")
        ->orderBy("fecha", "desc")
        ->paginate(10);
        return view('pago.pagosrecibidos', compact("buys"));
    }

    public function pagospendientes()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $buys = Buy::where("Estado", "Pendiente")
        ->orderBy("fechavencimiento")
        ->paginate(10);
        return view('pago.pagospendientes', compact("buys"));
    }

    public function transferir()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $pays = Teacher_Pay::where("Estado", "A pagar")
        ->orderBy("created_at", "desc")
        ->paginate(10);
        return view('pago.transferir', compact("pays"));
    }

    //Marca Pagado
    public function setPaid(Teacher_Pay $pago)
    {
        $pago->estado = "Pagado";
        $pago->save();
        //Notificación
        $not = new Notification();
        $not->transfenciaPago($pago->pago,$pago->user);
    }
}
