<?php

namespace App\Http\Controllers;

use App\Mail\mailRegistry;
use App\Models\Category;
use App\Models\Day;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function registroalumno()
    {
        return view('registro.alumno');
    }

    public function registroprofesor()
    {
        $category = Category::all()->where("baja","false")->sortBy("nombre");
        $day = Day::all();
        return view('registro.profesor',compact("category","day"));
    }

    //Registro de Alumno
    public function storealumno(Request $request)
    {
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
            throw ValidationException::withMessages(['webcam' => 'Debe contar con webcam y micrófono para poder participar de clases']);
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
        $user->email = $request->email;
        $user->fechanacimiento = $request->fechanacimiento;
        $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
        $user->password = password_hash($request->pass, PASSWORD_DEFAULT);
        $user->perfil = "alumno";
        $user->save();
        //Envío de email.
        Mail::to($user->email)->send(new mailRegistry($user));

        return view("messages.successuser");
    }

    public function storeprofesor(Request $request)
    {
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
            throw ValidationException::withMessages(['webcam' => 'Debe contar con webcam y micrófono para poder participar de clases']);
        }
        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->telefono = $request->telefono;
        $user->dni = $request->dni;
        $user->email = $request->email;
        $user->cuentabancaria = $request->cuentabancaria;
        $user->fechanacimiento = $request->fechanacimiento;
        $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
        $user->horas = $request->horas;
        //Título
        $nombre = "";
        if ($request->hasFile('titulo')) {
            $nombre = $request->file('titulo')->store("public");
            $nombre = str_replace("public/","",$nombre);
            return $nombre;
        }
        $user->titulo = $nombre;
        //Password generator
        $user->password = password_hash($request->pass, PASSWORD_DEFAULT);
        $user->perfil = "profesor";
        $user->save();
        //Agrego las especialidades
        $user->specialties()->attach($request->input('especialidades'));
        //Agrego los días disponibles
        $user->days()->attach($request->input('dias'));
        //Envío de email.
        $url = $this->enlaceVerificacion($user->id);
        Mail::to($user->email)->send(new mailRegistry($user,$url));
        return view("messages.successuser");
    }

    //Autentica email por url enviada por email.
    public function emailVeryfy($id) {
        return $this->desencriptar($id);
    }

    //Genero un enclace para encriptar
    public function enlaceVerificacion($id)
    {
        return "plataforma.test/VerficarEmail/" . $this->encriptar($id);
    }

    protected function encriptar($text)
    {
        return openssl_encrypt($text, "AES-128-CBC", "german123", 0, "1234567891011121");
    }

    protected function desencriptar($text)
    {
        return openssl_decrypt($text, "AES-128-CBC", "german123", 0, "1234567891011121");
    }
}
