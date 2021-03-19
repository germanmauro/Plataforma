<?php

namespace App\Http\Controllers;

use App\Mail\mailRegistry;
use App\Models\Availability;
use App\Models\Category;
use App\Models\Notification;
use App\Models\User;
use DateTime;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function registroalumno()
    {
        return view('registro.alumno');
    }

    public function registroprofesor()
    {
        $category = Category::all()->where("baja", "false")->sortBy("nombre");
        return view('registro.profesor',compact("category"));
    }

    //Registro de Alumno
    public function storealumno(Request $request)
    {
        //Mayor de 18
        $nacimiento = DateTime::createFromFormat('Y-m-d', $request->fechanacimiento);
        $nacimiento = $nacimiento->diff(new DateTime())->format("%y");

        if ($nacimiento < 18) {
            throw ValidationException::withMessages(['menoredad' => 'Debe ser mayor de 18 años para poder registrarse en la plataforma']);
        }
        
        //Debe aceptar términos
        if($request->pass<>$request->passrepeat) {
            throw ValidationException::withMessages(['passrepeat' => 'Debe repetir la misma contraseña']);
        }
        //Si existe el usuario
        if (User::where('usuario', $request->usuario)->count()) {
            throw ValidationException::withMessages(['usuario' => 'El nombre de usuario ya existe']);
        }
        //Si existe el email
        if (User::where('email', $request->email)->count()) {
            throw ValidationException::withMessages(['email' => 'El e-mail ya está registrado']);
        }
        if (!$request->has("webcam")) {
            throw ValidationException::withMessages(['webcam' => 'Debe contar con webcam, micrófono y conexión a internet para poder participar de clases']);
        }
        if (!$request->has("terminos")) {
            throw ValidationException::withMessages(['terminos' => 'Debe aceptar los términos 
            y condiciones para ingresar al sistema']);
        }
        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->telefono = $request->telefono;
        $user->dni = $request->dni;
        $user->tipodocumento = $request->tipodocumento;
        $user->email = $request->email;
        $user->fechanacimiento = $request->fechanacimiento;
        $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
        $user->password = password_hash($request->pass, PASSWORD_DEFAULT);
        $user->perfil = "alumno";
        $user->save();
        //Envío de email.
        $url = $this->enlaceVerificacion($user->id);
        Mail::to($user->email)->send(new mailRegistry($user, $url));
        //Notificacion
        $not = new Notification();
        $not->userRegister($user,"alumno");
        return redirect("/RegistroExitoso");
    }

    //Registro de profesor, paso 1
    public function storeprofesor(Request $request)
    {
        // return $request["nombre"];
        //Mayor de 18
        $nacimiento = DateTime::createFromFormat('Y-m-d', $request->fechanacimiento);
        $nacimiento = $nacimiento->diff(new DateTime())->format("%y");
        
        if($nacimiento < 18) {
            throw ValidationException::withMessages(['menoredad' => 'Debe ser mayor de 18 años para poder registrarse en la plataforma']);
        }
        //Pass iguales
        if($request->pass<>$request->passrepeat) {
            throw ValidationException::withMessages(['passrepeat' => 'Debe repetir la misma contraseña']);
        }
        //Si existe el usuario
        if (User::where('usuario', $request->usuario)->count()) {
            throw ValidationException::withMessages(['usuario' => 'El nombre de usuario ya existe']);
        }
        //Si existe el email
        if (User::where('email', $request->email)->count()) {
            throw ValidationException::withMessages(['email' => 'El e-mail ya está registrado']);
        }
        if (!$request->has('especialidades')) {
            throw ValidationException::withMessages(['especialidades' => 'Debe elegir al menos una especialidad']);
        }
        if (!$request->has('dias')) {
            throw ValidationException::withMessages(['dias' => 'Debe elegir al menos un día']);
        }
        //Debe aceptar términos
        if (!$request->has("terminos")) {
            throw ValidationException::withMessages(['terminos' => 'Debe aceptar los términos 
            y condiciones para ingresar al sistema']);
        }
        if (!$request->has("webcam")) {
            throw ValidationException::withMessages(['webcam' => 'Debe contar con webcam, micrófono y conexión a internet para poder participar de clases']);
        }
        //Verifico los días y horarios elegidos
        foreach ($request->dias as $value) {
            $desde = new DateTime($request["desde" . $value]);
            $hasta = new DateTime($request["hasta" . $value]);
            if ($desde->diff($hasta)->format("%h") < 1) {
                throw ValidationException::withMessages(['horas' => 'Al menos debe tener disponibilidad de una hora para el día seleccionado (' . $value . ')']);
            }
            if ($desde > $hasta) {
                throw ValidationException::withMessages(['horas' => 'En el día ' . $value . "la hora hasta debe ser mayor que la hora desde"]);
            }
        }

        $user = new User();
        
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        // $user->telefono = $request->telefono;
        $user->dni = $request->dni;
        $user->tipodocumento = $request->tipodocumento;
        $user->email = $request->email;
        // $user->cuentabancaria = $request->cuentabancaria;
        $user->fechanacimiento = $request->fechanacimiento;
        // $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
   
        //Password generator
        $user->password = password_hash($request->pass, PASSWORD_DEFAULT);
        $user->perfil = "profesor";
        // $user->horas = $request->horas;
        //Título
        $nombre = "";
        if ($request->hasFile('titulo')) {
            $nombre = $request->file('titulo')->store("public");
            $nombre = str_replace("public/", "", $nombre);
        }
        $user->titulo = $nombre;
        //Foto
        $nombre = "";
        if ($request->hasFile('foto')) {
            $nombre = $request->file('foto')->store("public/foto");
            $nombre = str_replace("public/foto/", "", $nombre);
        }
        $user->foto = $nombre;
        $user->baja = "false";
        $user->save();
        //Agrego las especialidades
        $user->specialties()->attach($request->input('especialidades'));
        //Días y horarios
        foreach ($request->dias as $value) {
            $desde = new DateTime($request["desde" . $value]);
            $hasta = new DateTime($request["hasta" . $value]);
            $availability = new Availability();
            $availability->dia = $value;
            $availability->desde = $desde;
            $availability->hasta = $hasta;
            $user->availabilities()->save($availability);
        }
        //Envío de email.
        $url = $this->enlaceVerificacion($user->id);
        Mail::to($user->email)->send(new mailRegistry($user, $url));
        $not = new Notification();
        $not->userRegister($user, "profesor");
        return redirect("/RegistroExitoso");
    }

    //Autentica email por url enviada por email.
    public function verifyemail($id) {
        $id = $this->desencriptar($id);
        //Si existe el usuario
        if (User::where('id', $id)->count()) {
            $user = User::find($id);
            
            //Si es alumno ya se habilita
            if($user->perfil=="alumno") {
                $user->estado = "validado";
            } else { //profesor
                $user->estado = "a entrevistar";
            }
            $user->save();
            //Loggeo
            session([
                'Id' => $user->id,
                'Usuario' => $user->usuario,
                'Perfil' => $user->perfil,
                'Estado' => $user->estado,
                'Nombre' => $user->nombre,
                'Apellido' => $user->apellido,
            ]);
           
            return redirect("")->with("success","E-mail validado correctamente");
        }
    }

    //Genero un enclace para encriptar
    public function enlaceVerificacion($id)
    {
        return env("APP_URL")."/ValidarEmail/". $this->encriptar($id);
    }

    protected function encriptar($text)
    {
        return base64_encode(openssl_encrypt($text, "AES-128-CBC", "german123", 0, "1234567891011121"));
    }

    protected function desencriptar($text)
    {
        return openssl_decrypt(base64_decode($text), "AES-128-CBC", "german123", 0, "1234567891011121");
    }
}
