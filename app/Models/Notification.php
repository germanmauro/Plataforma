<?php

namespace App\Models;

use App\Mail\notificationMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notifications";

    protected $primarykey = "id";

    public function register($usuario, $tipo, $texto)
    {
        $this->user_id = $usuario;
        $this->tipo = $tipo;
        $this->texto = $texto;
        $this->save();
    }

    public function userRegister(User $user, $tipo)
    {
        $this->register(1, "Registro", "El " . $tipo . " " . $user->nombre . " " . $user->apellido . " se ha registrado");
    }

    public function userValidated(User $user)
    {
        $this->register($user->id, "Mensaje", "Se ha validado su usuario. Ya puede utlilizar el sistema");
    }

    public function userInvalidated(User $user)
    {
        $this->register($user->id, "Mensaje", "Se ha invalidado su usuario. Quedó inhabilitado para utilizar el sistema");
    }

    public function compraAlumno(Course $course)
    {
        $user = User::find(session("Id"));
        $mensaje = "Has comprado el curso: " . $course->publication->titulo .
            ". Inicio de cursada " . $course->inicio->format("d/m/Y H:i");
        $this->register($user->id,"Compra",$mensaje);
        Mail::to($user->email)->send(new notificationMessage("Compra reailzada - CEE","Compra exitosa",$mensaje));
    }

    public function compraProfesor(Course $course)
    {
        $user = User::find(session("Id"));
        $profesor = $course->publication->user;
        $mensaje = "El usuario " . $user->nombre . " " . $user->apellido . " ha comprado " . $course->publication->titulo .
            " para la fecha " . $course->inicio->format("d/m/Y H:i");
        $this->register($profesor->id,"Compra",$mensaje);
        Mail::to($profesor->email)->send(new notificationMessage("Compra realizada - CEE", "Compra exitosa", $mensaje));
    }

    public function compraAdministrador(Course $course)
    {
        $user = User::find(session("Id"));
        $admin = User::find(1);
        $mensaje =  "El usuario " . $user->nombre . " " . $user->apellido . " ha comprado " . $course->publication->titulo .
        " para la fecha " . $course->inicio->format("d/m/Y H:i");
        $this->register(1, "Compra",$mensaje);
        Mail::to($admin->email)->send(new notificationMessage("Compra realizada - CEE", "Compra exitosa", $mensaje));
    }

    public function pagoAlumno(Buy $buy)
    {
        $user = User::find(session("Id"));
        $mensaje = "Has pagado la cuota: ".$buy->cuota." del curso: " 
        . $buy->course->publication->titulo;
        $this->register($user->id,"Pago",$mensaje);
        Mail::to($user->email)->send(new notificationMessage("Cuota abonada - CEE","Pago exitoso",$mensaje));
    }

    public function pagoProfesor(Buy $buy)
    {
        $user = User::find(session("Id"));
        $profesor = $buy->course->publication->user;
        $mensaje = "El usuario " . $user->nombre . " " . $user->apellido . " ha pagado la cuota ".$buy->cuota .
         " del curso ". $buy->course->publication->titulo;
        $this->register($profesor->id,"Pago",$mensaje);
        Mail::to($profesor->email)->send(new notificationMessage("Cuota abonada - CEE", "Pago exitoso", $mensaje));
    }

    public function pagoAdministrador(Buy $buy)
    {
        $user = User::find(session("Id"));
        $admin = User::find(1);
        $mensaje =  "El usuario " . $user->nombre . " " . $user->apellido . 
        " ha pagado la cuota ".$buy->cuota." del curso " . $buy->course->publication->titulo;
        $this->register(1, "Pago",$mensaje);
        Mail::to($admin->email)->send(new notificationMessage("Cuota abonada - CEE", "Pago exitoso", $mensaje));
    }

    public function avisoClase(User $user,Course $course, $fecha)
    {
        $mensaje =  "Le recordamos que en el día de mañana tiene una clase a las ".$fecha->format("H:i"). 
        " horas, correspondiente al curso ".$course->publication->titulo;
        $this->register($user->id, "Aviso Clase", $mensaje);
        Mail::to($user->email)->send(new notificationMessage("Recordatorio de clase - CEE", "Recordatorio de clase", $mensaje));
    }

    public function avisoClase30min(User $user,Course $course)
    {
        $mensaje =  "Le recordamos que en 30 minutos comienza la clase del curso "
        .$course->publication->titulo;
        $this->register($user->id, "Aviso Clase", $mensaje);
        Mail::to($user->email)->send(new notificationMessage("Recordatorio de clase - CEE", "Recordatorio de clase", $mensaje));
    }
}
