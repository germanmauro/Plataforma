<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function listado()
    {
        $publicaciones = Publication::where('baja', 'false')->where("estado","Activa")->paginate(15);

        return view("cursos.listado", compact("publicaciones"));
    }

    //filtro de cursos
    public function coursefilter(Request $request)
    {
        if($request->filter!="") {
            $array = explode(' ', $request->filter);
            $regex = "'".implode("|", $array)."'";
            $publicaciones = Publication::where('baja', 'false')
            ->where("estado", "Activa")
            // ->whereIn("titulo", $array)
                // ->where('titulo','like','%'.$request->filter.'%')
                ->where('titulo','regexp',implode("|",$array))
                ->paginate(15);
        } else {
           return $this->listado();
        }
        

        return view("cursos.listado", compact("publicaciones", "request"));
    }

    public function show($id,$slug="")
    {
        $publicacion = Publication::find($id);
        return view("cursos.show", compact("publicacion"));
    }

}
