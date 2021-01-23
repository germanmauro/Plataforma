<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfesorController extends Controller
{
    public function administrar()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $usuarios = User::where(['baja'=>'false','perfil'=>'profesor'])->get();
        return view("administrarprofesor.index", compact("usuarios"));
    }

    public function info($id)
    {
        $user = User::find($id);
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view("administrarprofesor.info", compact("user"));
    }

    public function mispreferencias()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        return view("profesor.mispreferencias", compact("user"));
    }
}