<?php

namespace App\Http\Controllers;

use App\Mail\mailContract;
use App\Mail\mailRegistry;
use App\Models\Category;
use App\Models\Day;
use App\Models\User;
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
        return view('registro.profesor');
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
        $url = $this->enlaceVerificacion($user->id);
        Mail::to($user->email)->send(new mailRegistry($user, $url));

        return redirect("/RegistroExitoso");
    }

    //Registro de profesor, paso 1
    public function storeprofesor(Request $request)
    {
        $category = Category::all()->where("baja", "false")->sortBy("nombre");
        $day = Day::all();
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
        $user->baja = "true"; //Por si solo completa la mitad
   
        //Password generator
        $user->password = password_hash($request->pass, PASSWORD_DEFAULT);
        $user->perfil = "profesor";
        $user->save();
        return view("registro.profesorpaso2", compact("user","category","day"));
    }

    public function storeprofesor2(User $user, Request $request)
    {
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
        $user->horas = $request->horas;
        //Título
        $nombre = "";
        if ($request->hasFile('titulo')) {
            $nombre = $request->file('titulo')->store("public");
            $nombre = str_replace("public/","",$nombre);
        }
        $user->titulo = $nombre;
        $user->baja = "false";
        $user->save();
        //Agrego las especialidades
        $user->specialties()->attach($request->input('especialidades'));
        //Agrego los días disponibles
        $user->days()->attach($request->input('dias'));

        //Envío de email.
        $url = $this->enlaceVerificacion($user->id);
        Mail::to($user->email)->send(new mailRegistry($user,$url));
        
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
        return "http://plataforma.test/ValidarEmail/" . $this->encriptar($id);
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
