<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Calendar;
use App\Models\Course;
use App\Models\Day;
use App\Models\Publication;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PublicationController extends Controller
{
    public function index()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $publicaciones = Publication::where('baja', 'false')
        ->where("user_id",session("Id"))->get();
        
        return view("publicacion.index", compact("publicaciones"));
    }

    public function create()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));

        return view("publicacion.create", compact("user"));
    }

    public function store(Request $request)
    {
        $publicacion = new Publication();
        $publicacion->user_id = session("Id");
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->nivel = $request->nivel;
        $publicacion->temas = $request->temas;
        $publicacion->beneficios = $request->beneficios;
        $publicacion->aprendizaje = $request->aprendizaje;
        $publicacion->specialty_id = $request->especialidad;
        $publicacion->tipo = $request->tipo;
        $publicacion->clases = $request->clases;
        if ($publicacion->clases == 0) {
            $publicacion->duracion = $request->duracion;
        }
        if ($publicacion->tipo == "Grupal") {
            $publicacion->alumnos = $request->alumnos;
        }
        $publicacion->precio = $request->precio;
        $publicacion->total = $request->precio * $request->clases;
        $publicacion->video = $request->video;
        $nombre = "";
        if ($request->hasFile('imagen1')) {
            $nombre = $request->file('imagen1')->store("public/publicaciones");
            $publicacion->imagen1 = str_replace("public/publicaciones/", "", $nombre);
        }
        if ($request->hasFile('imagen2')) {
            $nombre = $request->file('imagen2')->store("public/publicaciones");
            $publicacion->imagen2 = str_replace("public/publicaciones/", "", $nombre);
        }
        if ($request->hasFile('imagen3')) {
            $nombre = $request->file('imagen3')->store("public/publicaciones");
            $publicacion->imagen3 = str_replace("public/publicaciones/", "", $nombre);
        }
        $publicacion->save();

        return redirect("/Publicaciones")->with("success", "Publicación generada correctamente");
    }

    public function edit(Publication $publicacion)
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        return view('publicacion.update', compact("user", "publicacion"));
    }

    public function update(Publication $publicacion, Request $request)
    {
        $publicacion->titulo = $request->titulo;
        $publicacion->descripcion = $request->descripcion;
        $publicacion->nivel = $request->nivel;
        $publicacion->temas = $request->temas;
        $publicacion->beneficios = $request->beneficios;
        $publicacion->aprendizaje = $request->aprendizaje;
        $publicacion->specialty_id = $request->especialidad;
        $publicacion->tipo = $request->tipo;
        $publicacion->clases = $request->clases;
        if ($publicacion->clases == 0) {
            $publicacion->duracion = $request->duracion;
        }
        if ($publicacion->tipo == "Grupal") {
            $publicacion->alumnos = $request->alumnos;
        }
        $publicacion->precio = $request->precio;
        $publicacion->total = $request->precio * $request->clases;
        $publicacion->video = $request->video;
        $nombre = "";
        if ($request->hasFile('imagen1')) {
            $nombre = $request->file('imagen1')->store("public/publicaciones");
            $publicacion->imagen1 = str_replace("public/publicaciones/", "", $nombre);
        }
        if ($request->hasFile('imagen2')) {
            $nombre = $request->file('imagen2')->store("public/publicaciones");
            $publicacion->imagen2 = str_replace("public/publicaciones/", "", $nombre);
        }
        if ($request->hasFile('imagen3')) {
            $nombre = $request->file('imagen3')->store("public/publicaciones");
            $publicacion->imagen3 = str_replace("public/publicaciones/", "", $nombre);
        }
        $publicacion->save();

        return redirect("/Publicaciones")->with("success", "Registro actualizado correctamente");;
    }

    //Pausar, eliminar y reactivar publicacion
    public function pause(Publication $publicacion)
    {
        $publicacion->estado = "Pausada";
        $publicacion->save();
        session()->flash("success", "La publicación ".$publicacion->titulo." ha sido pausada");
    }
    
    public function reactivate(Publication $publicacion)
    {
        $publicacion->estado = "Activa";
        $publicacion->save();
        session()->flash("success","La publicación ".$publicacion->titulo." ha sido reactivada");
    }
    
    public function delete(Publication $publicacion)
    {
        $publicacion->estado = "Eliminada";
        $publicacion->baja = "true";
        $publicacion->save();
        session()->flash("success", "La publicación " . $publicacion->titulo . " ha sido eliminada");
    }

    public function deleteimage(Publication $publicacion, $image)
    {
        //Borro las imagenes de la db y del disco
        switch ($image) {
            case '1':
                Storage::disk("public")->delete("publicaciones/" . $publicacion->imagen1);
                $publicacion->imagen1 = "";
                break;
            case '2':
                Storage::disk("public")->delete("publicaciones/".$publicacion->imagen2);
                $publicacion->imagen2 = "";
                break;
            case '3':
                Storage::disk("public")->delete("publicaciones/".$publicacion->imagen3);
                $publicacion->imagen3 = "";
                break;
            
            default:
                break;
        }
        $publicacion->save();
    }

    //Dias de cursada
    public function calendar(Publication $publicacion)
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        return view('publicacion.calendar', compact("user", "publicacion"));
    }

    // Cargar Nuevo día
    public function updatecalendar(Publication $publicacion, Request $request)
    {
        try {
            $fecha = new DateTime($request->fecha . " " . $request->hora);
            //Cargo los datos del curso
            $course = new Course();
            $course->publication_id = $publicacion->id;
            $course->inicio = $fecha->format("Y-m-d H:i:s");
            $course->fechaactual = $fecha->format("Y-m-d H:i:s");
            $course->cantidadcuotas = $publicacion->duracion;
            $course->cuotaactual = 1;
            $course->precioclase = $publicacion->precio;
            $porcentaje = Amount::find(1);
            $course->porcentajeprofesor = $porcentaje->valor;
            $days = array();
            $dias = new Collection();
            //abono mensual
            if ($publicacion->clases == 0) {
                $flagFirst = true;
                for ($i = 0; $i < $course->cantidadcuotas; $i++) {
                    if ($flagFirst && count($days) > 0) {
                        $course->ultimaclase = $days[count($days) - 1];
                        $course->cantidadclases = count($days);
                        $flagFirst = false;
                    }
                    $mesActual = $fecha->format("m");
                    while ($fecha->format("m") == $mesActual) {
                        $days[] = $fecha->format("Y-m-d H:i:s");
                        $dia = new Day();
                        $dia->fecha = $fecha->format("Y-m-d H:i:s");
                        $dia->cuota = $i + 1;
                        $dias->add($dia);
                        $fecha->add(new DateInterval("P7D"));
                    }
                }
            } 
            else  //Abono total
            {
                for ($i = 0; $i < $publicacion->clases; $i++) {
                    $days[] = $fecha->format("Y-m-d H:i:s");
                    $dia = new Day();
                    $dia->fecha = $fecha->format("Y-m-d H:i:s");
                    $dia->cuota = $i + 1;
                    $dias->add($dia);
                    $fecha->add(new DateInterval("P7D"));
                }
                $course->ultimaclase = $days[count($days) - 1];
                $course->cantidadclases = $publicacion->clases;
            }
            $hoy = new DateTime();
            DB::beginTransaction();
            $diasUsados = DB::table('days')
                ->join('courses', 'courses.id', '=', 'days.course_id')
                ->join('publications', 'publications.id', '=', 'courses.publication_id')
                ->where('publications.user_id', "=", $publicacion->user_id)
                ->whereIn("days.fecha",[implode(",",$days)])
                ->where('courses.inicio', ">", $hoy->format('Y-m-d'))
                ->select('days.fecha')
                ->count();

            $diasUsadosSinAlumnos = DB::table('days')
                ->join('courses', 'courses.id', '=', 'days.course_id')
                ->join('publications', 'publications.id', '=', 'courses.publication_id')
                ->join('course_user','courses.id','course_user.course_id')
                ->where('publications.user_id', "=", $publicacion->user_id)
                ->whereIn("days.fecha",[implode(",",$days)])
                ->where('courses.inicio', "<", $hoy->format('Y-m-d'))
                ->select('days.fecha')
                ->count();
            if(!$diasUsados&&!$diasUsadosSinAlumnos)
            {
                //Salvo el curso
                $course->save();
                //Salvo todas las clases
                $course->days()->saveMany($dias);
                
                DB::commit();
                return Redirect::back()->with("success", "Fecha agredada");
            }
            else
            {
                return Redirect::back()->with("error", "Las fechas del curso ya están utilizadas");
                // throw ValidationException::withMessages(['fecha' => 'Ya ha utilizado alguna de las fechas']);
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::back()->with("error", "Error al crear la fecha ".$th->getMessage());
        }
    }

    public function deletecourse(Course $course)
    {
        
        if($course->publication->user_id == session("Id"))
        {
            $course->delete();
        }   
    }
}
