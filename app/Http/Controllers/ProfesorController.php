<?php

namespace App\Http\Controllers;

use App\Mail\mailContract;
use App\Models\Buy;
use App\Models\Course;
use App\Models\Day;
use App\Models\Notification;
use App\Models\Teacher_Pay;
use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

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
        $hoy = new DateTime();
        
        $clases = $user->cursosActivos();
        return view("administrarprofesor.clases", compact("clases", "user"));
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

    public function pagos(User $user)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        $pagos = $user->teachers_pays()->whereIn("estado", ["A pagar", "Pagado"])
        ->orderBy("estado")->orderBy("updated_at")
        ->paginate(6);
        $totalpagar = $user->teachers_pays()->where("estado","A pagar")->sum("pago");
        
        return view("administrarprofesor.pagos", compact("pagos", "user","totalpagar"));
    }

    public function transferirTodo(User $user)
    {
        if (!session()->has('Perfil') || session("Perfil") != "admin") {
            return redirect("");
        }
        DB::table('teachers_pays')
        ->where('user_id', $user->id)
        ->update(['estado' => "Pagado"]);
        return redirect('AdministrarProfesores/'.$user->id."/Pagos")->with("success", "Monto marcad como transferido");
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

    public function clasespendientes()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $hoy = new DateTime();
        
        $clases = $user->cursosActivos();
        return view('profesor.clasespendientes', compact("clases", "user"));
    }

    public function clasespasadas()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $clases = $user->cursosPasados();
        return view('profesor.clasesrealizadas', compact("clases", "user"));
    }

    public function clasescurso(Course $course)
    {
        if (!session()->has('Perfil') || !in_array(session("Perfil"),["profesor","admin"])) {
            return redirect("");
        }
        $days = Day::where("course_id", $course->id)
            ->get();
        return view('profesor.clases', compact("course", "days"));
    }

    //Info pagos
    public function pagosrecibidos()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $pays = $user->teachers_pays()->where("Estado","Pagado")
            ->orderBy("updated_at", "desc")
            ->paginate(10);
        return view('profesor.pagosrecibidos', compact("pays"));
    }

    public function pagospendientes()
    {
        if (!session()->has('Perfil') || session("Perfil") != "profesor") {
            return redirect("");
        }
        $user = User::find(session("Id"));
        $pays = $user->teachers_pays()->where("Estado", "A pagar")
        ->orderBy("updated_at","desc")
        ->paginate(10);
        return view('profesor.pagospendientes', compact("pays"));
    }
}