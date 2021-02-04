<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function listado()
    {

        $publicaciones = Publication::where('baja', 'false')->where("estado","Activa")->get();

        return view("cursos.listado", compact("publicaciones"));
    }
}
