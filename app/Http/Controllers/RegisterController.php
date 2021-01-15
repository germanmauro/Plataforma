<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

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
    
        return view("messages.successuser");
    }
}
