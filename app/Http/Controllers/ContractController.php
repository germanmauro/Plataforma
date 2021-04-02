<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        //Esta tabla tiene un único registro, que es el porcentaje que cobra cada profesor.
        return view('contrato.index');
    }

    public function update(Request $request)
    {
        $contrato = Contract::firstOrNew(array('id' => 1));
        $nombre = "";
        if ($request->hasFile('contrato')) {
            $nombre = $request->file('contrato')->store("public/contrato/");
            $contrato->nombre = str_replace("public/contrato/", "", $nombre);
        }

        $contrato->save();

        return redirect("")->with("success", "Contrato cargado con éxito");;
    }
}
