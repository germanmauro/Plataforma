<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
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
        $buys = Buy::where(["estado"=>"pagado","user_id" => $user->id])->paginate(5);
        return view("administraralumno.clases", compact("buys","user"));
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
        $clases = $user->buys()->("ultimaclase", ">", $hoy->format("Y-m-d H:i"))->paginate(6);
        return view('alumno.clasespendientes', compact("clases","user"));
    }

    public function clasespasadas()
    {
        if (!session()->has('Perfil') || session("Perfil") != "alumno") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $hoy = new DateTime();
        $clases = $user->courses()->where("ultimaclase", ">", $hoy->format("Y-m-d H:i"))->paginate(6);
        return view('alumno.clasespendientes', compact("clases","user"));
    }
    
}
