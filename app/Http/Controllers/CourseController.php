<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        $publicaciones = $categoria->publications()
        ->where('publications.baja', 'false')
        ->where("estado", "Activa")->paginate(15);
        return view("cursos.listadocategoria", compact("publicaciones","categoria"));
    }

    public function show($id,$slug="")
    {
        $publicacion = Publication::find($id);
        return view("cursos.show", compact("publicacion"));
    }

    //Agregar a favoritos
    public function addfavorite($id)
    {
        $user = User::find(session("Id"));
        if(!$user->favorites()->where('publication_id', $id)->count())
        {
            $user->favorites()->attach($id);
        }
        
        return Redirect::back()->with('success', 'Curso agregado a favoritos');
    }

    //Agregar a favoritos
    public function removefavorite($id)
    {
        $user = User::find(session("Id"));
        $user->favorites()->detach($id);
        return Redirect::back()->with('success', 'Curso eliminado de favoritos');
    }
    

}
