<?php

namespace App\Models;

use App\Mail\notificationContract;
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

    public function userContract(User $user)
    {
        $this->register($user->id, "Mensaje", "Debe aceptar el contrato de exclusividad para poder empezar a utlizar la plataforma");
        Mail::to($user->email)->send(new notificationContract("Habilitado para aceptar los términos de uso para docentes - CEE",
        "Se ha habilitado para aceptar los términos de uso para docentes", "Ha sido habilitado para aceptar los términos de uso para docentes.<br>
        Debe ingresar al sistema para poder aceptarlo. 
        <br>Una vez aceptado estará habilitado para operar en la plataforma.
        <br>Se envía adjunto un instructivo para poder generar publicaciones."));
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
        Mail::to($user->email)->send(new notificationMessage("Compra reailzada - CEE","Muchas gracias por su compra",$mensaje));
    }

    public function compraProfesor(Course $course)
    {
        $user = User::find(session("Id"));
        $profesor = $course->publication->user;
        $mensaje = "El usuario " . $user->nombre . " " . $user->apellido . " ha comprado " . $course->publication->titulo .
            " para la fecha " . $course->inicio->format("d/m/Y H:i");
        $this->register($profesor->id,"Compra",$mensaje);
        Mail::to($profesor->email)->send(new notificationMessage("Compra realizada - CEE", "Compra registrada", $mensaje));
    }

    public function compraAdministrador(Course $course)
    {
        $user = User::find(session("Id"));
        $admin = User::find(1);
        $mensaje =  "El usuario " . $user->nombre . " " . $user->apellido . " ha comprado " . $course->publication->titulo .
        " para la fecha " . $course->inicio->format("d/m/Y H:i");
        $this->register(1, "Compra",$mensaje);
        Mail::to($admin->email)->send(new notificationMessage("Compra realizada - CEE", "Compra registrada", $mensaje));
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

    public function avisoSinCursos(Publication $pub)
    {
        $mensaje =  "Su publicación <strong>".$pub->titulo."</strong> ya no tiene cursos activos.
        <br> Para cargar el calendario ingrese al siguiente 
        <a href='https://capacitacionee.com/Publicaciones/".$pub->id."/Calendar'>enlace</a>";
        Mail::to($pub->user->email)->send(new notificationMessage("Publicación sin cursos - CEE", "Publicación sin cursos", $mensaje));
    }

    public function avisoEnlaceClase(User $user,Day $day, $enlace)
    {
        $mensaje =  "Le enviamos el enlace a Google Meet para porder ralizar la clase correspondiente 
        a la clase ".$day->course->publication->titulo. " el ".$day->fecha->format("d/m/Y").
        " a las ". $day->fecha->format("H:i")."<br>
         <a link href='".$enlace."'>Enlace: ".$enlace. "</a><br> Esperamos su asistencia";
        $this->register($user->id, "Enlace a curso", $mensaje);
        Mail::to($user->email)->send(new notificationMessage("Enlace de conexión para clase - CEE", "Enlace de conexión para clase", $mensaje));
    }

    public function transfenciaPago($pago, User $user)
    {
        $mensaje =  "Transferencia realizada por el monto de € ". $pago;
        $this->register($user->id, "Pago", $mensaje);
        Mail::to($user->email)->send(new notificationMessage("Transferencia enviada - CEE", "Transferencia enviada", $mensaje));
    }

    public function publicacion(Publication $pub)
    {
        $user = User::find(1);
        $mensaje = "El profesor " . $pub->user->nombre . " " . $pub->user->apellido . " ha publicado " . $pub->titulo;
        $this->register(1, "Publicació nueva", $mensaje);
        Mail::to($user->email)->send(new notificationMessage("Publicación nueva", "Nueva publicación generada", $mensaje));
    }
}
