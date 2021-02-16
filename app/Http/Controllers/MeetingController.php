<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MeetingController extends Controller
{
    //Comprar
    public function comprar($id, $slug = "")
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return Redirect::back()->with('warning', 'Debe registrarse como alumno para poder comprar cursos');
        }
        else
        {
            $publicacion = Publication::find($id);
            return view("cursos.comprar", compact("publicacion"));
        }
        
    }
}
