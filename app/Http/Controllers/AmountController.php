<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use Illuminate\Http\Request;

class AmountController extends Controller
{
    public function index()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        //Esta tabla tiene un único registro, que es el monto por hora.
        $monto = Amount::find(1);
        return view('monto.index', compact("monto"));
    }

    public function update(Amount $monto, Request $request)
    {
        $monto->valor = $request->valor;
        $monto->save();

        return redirect("/Monto")->with("success", "Monto por hora actualizado");;
    }
}
