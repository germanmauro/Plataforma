<?php

namespace App\Http\Controllers;

use App\Mail\mailContract;
use App\Models\Buy;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProfesorController extends Controller
{
    public function administrar()
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $usuarios = User::where(['baja'=>'false','perfil'=>'profesor'])->get();
        return view("administrarprofesor.index", compact("usuarios"));
    }

    public function clases(User $user)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $id = $user->id;
        $buys = Buy::where('estado','pagado')->whereIn('publication_id', function ($query) use ($id) {
            $query->select('id')->from('publications')->where('user_id',$id);
        })->paginate(5);
        return view("administrarprofesor.clases", compact("buys", "user"));
    }

    public function info($id)
    {
        $user = User::find($id);
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view("administrarprofesor.info", compact("user"));
    }

    public function mispreferencias()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        return view("profesor.mispreferencias", compact("user"));
    }

    //Habilitar profesor
    public function show(User $user)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        return view('administrarprofesor.enable', compact("user"));
    }

    public function enable(User $user)
    {
        $user->estado = "validado";
        $user->save();
        $not = new Notification();
        $not->userValidated($user);
        session()->flash("success", "El profesor: " . $user->nombre . " " . $user->apellido . " ha sido habilitado");
    }

    public function disable(User $user)
    {
        $user->estado = "invalidado";
        $user->save();
        $not = new Notification();
        $not->userInvalidated($user);
        session()->flash("success", "El profesor: " . $user->nombre . " ".$user->apellido." ha sido deshabilitado");
    }

    //Al aprobar la entrevista se habilita al profesor para enviar el contrato
    public function entrevistaprofesorok($id)
    {
        $user = User::find($id);
        Mail::to($user->email)->send(new mailContract($user));
        return redirect("/AdministrarProfesores")->with("success", "Entrevista aprobada, se ha enviado un contrato al profesor");
        // return redirect("Validacion/Contrato"); //Esta url va en el mail de contrato
    }

    //Listado profesores validados con calificaciones
    public function infoprofesor()
    {
        $users = User::where(['baja' => 'false', 'perfil' => 'profesor','estado' => 'validado'])->get();
        return view("cursos.profesores", compact("users"));
    }
}