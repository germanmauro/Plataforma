<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Publication;
use App\Models\Specialty;
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

    public function showbycategories($id,$slug="")
    {
        $categoria = Category::find($id);
        $publicaciones = $categoria->publications()->paginate(15);
        return view("cursos.listadocategoria", compact("publicaciones"));
    }

    public function show($id,$slug="")
    {
        $publicacion = Publication::find($id);
        return view("cursos.show", compact("publicacion"));
    }

}
