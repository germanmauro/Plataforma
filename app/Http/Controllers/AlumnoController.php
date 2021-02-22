<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AlumnoController extends Controller
{
    public function administrar()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $usuarios = User::where(['baja' => 'false', 'perfil' => 'alumno'])->get();
        return view("administraralumno.index", compact("usuarios"));
    }

    public function enable(User $user)
    {
        $user->estado = "validado";
        $user->save();

        session()->flash("success", "El alumno: " . $user->nombre . " " . $user->apellido . " ha sido habilitado");
    }

    public function disable(User $user)
    {
        $user->estado = "invalidado";
        $user->save();
        session()->flash("success", "El alumno: " . $user->nombre . " ".$user->apellido." ha sido deshabilitado");
    }

    public function misfavoritos()
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        return view('alumno.misfavoritos', compact("user"));
    }
}
