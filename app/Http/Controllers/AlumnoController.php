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
}
