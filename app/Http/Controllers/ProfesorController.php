<?php

namespace App\Http\Controllers;

use App\Mail\mailContract;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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

    //Habilitar profesor
    public function show(User $user)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view('administrarprofesor.enable', compact("user"));
    }

    public function enable(User $user)
    {
        $user->estado = "validado";
        $user->save();
        
        return redirect("/AdministrarProfesores")->with("success", "Profesor habilitado para operar");
    }

    public function disable(User $user)
    {
        $user->estado = "invalidado";
        $user->save();
        return redirect("/AdministrarProfesores")->with("success", "Profesor deshabilitado");
    }

    //Al aprobar la entrevista se habilita al profesor para enviar el contrato
    public function entrevistaprofesorok($id)
    {
        $user = User::find($id);
        Mail::to($user->email)->send(new mailContract($user));
        return redirect("/AdministrarProfesores")->with("success", "Entrevista aprobada, se ha enviado un contrato al profesor");
        // return redirect("Validacion/Contrato"); //Esta url va en el mail de contrato
    }
}