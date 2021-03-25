<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Day;
use App\Models\Notification;
use App\Models\Publication;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
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
        $dias = new Collection();
        $hoy = new DateTime();
        foreach ($publicacion->courses()->where("inicio", ">", $hoy)->orderBy("inicio")->get() as $item) {
            if (!($publicacion->tipo == "Individual" && count($item->users) > 0)) {
                $dias[] = $item;
            }
        }
        return view("cursos.show", compact("publicacion","dias"));
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

    //Listado de clases para ver avisos
    public function clasesaviso()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        //Listo los cursos vigentes con alumnos
        $hoy = new DateTime();
        $cursos = Course::where("cantidadalumnos", ">", 0)
        ->where("ultimaclase", ">", $hoy->format("Y-m-d H:i"))->pluck("id");
        $days = Day::whereIn("course_id",$cursos)
        ->where("fecha", ">", $hoy->format("Y-m-d H:i"))
        ->orderBy("fecha")->paginate(10);
        return view("clases.aviso", compact("days"));
    }

    public function sendlink(Day $day, Request $request)
    {
        $not = new Notification();
        $not->avisoEnlaceClase($day->course->publication->user, $day, $request->enlace);  
        foreach ($day->course->users as $alumno) {
                //aviso a profesor
                $not = new Notification();
                $not->avisoEnlaceClase($alumno,$day,$request->enlace);  
        }
        $day->envioenlace = true;
        $day->save();
        return Redirect::back()->with('success', 'Enlace enviados a todos los participantes');
    }
}
