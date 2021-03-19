<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Course;
use App\Models\Meeting;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Redirect;

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

    public function clases(User $user)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $hoy = new DateTime();
        $clases = $user->courses()->where("ultimaclase", ">", $hoy->format("Y-m-d H:i"))->paginate(6);
        return view("administraralumno.clases", compact("clases","user"));
    }

    public function pagos(User $user)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $pagos = $user->buys()->whereIn("estado",["Pagado","Pendiente"])
        ->orderBy("estado")->orderBy("fechavencimiento")
        ->paginate(6);
        return view("administraralumno.pagos", compact("pagos","user"));
    }

    public function enable(User $user)
    {
        $user->estado = "validado";
        $user->save();
        $not = new Notification();
        $not->userValidated($user);
        Redirect::back()->with("success", "El alumno: " . $user->nombre . " " . $user->apellido . " ha sido habilitado");
    }

    public function disable(User $user)
    {
        $user->estado = "invalidado";
        $user->save();
        $not = new Notification();
        $not->userInvalidated($user);
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

    public function clasespendientes()
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $hoy = new DateTime();
        $clases = $user->courses()->where("ultimaclase", ">", $hoy->format("Y-m-d H:i"))->paginate(6);
        return view('alumno.clasespendientes', compact("clases","user"));
    }

    public function clasespasadas()
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $hoy = new DateTime();
        $clases = $user->courses()->where("ultimaclase", "<", $hoy->format("Y-m-d H:i"))->paginate(6);
        return view('alumno.clasesrealizadas', compact("clases","user"));
    }

    public function clasescurso(Course $course, User $user = null)
    {
        if (!session()->has('Perfil') || !in_array(session("Perfil"),["alumno","admin"])) {
            return redirect("");
        }
        if($user==null)
        {
            $user = User::find(session("Id"));
        }
        $buys = Buy::where("course_id",$course->id)
        ->where("user_id",$user->id)
        ->get();
        return view('alumno.clases', compact("course","buys", "user"));
    }

    //Info pagos
    public function pagosrealizados()
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $buys = $user->buys()->where("Estado","Pagado")->paginate(10);
        return view('alumno.pagosrealizados', compact("buys", "user"));
    }

    public function pagospendientes()
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return redirect("");
        }
        //fecha a 15 días
        $hoy = new DateTime();
        $hoy->add(new DateInterval("P15D"));
        $user = User::find(session("Id"));
        $buys = $user->buys()->where("Estado","Pendiente")
        ->where('fechavencimiento',"<",$hoy->format('Y-m-d H:i'))
        ->paginate(10);
        return view('alumno.pagospendientes', compact("buys", "user"));
    }
}
