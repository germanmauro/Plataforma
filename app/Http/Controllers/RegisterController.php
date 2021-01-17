<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
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
        return view('registro.profesor',compact("category"));
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
        //Si existe el email
        if (User::where('email', $request->email)->count()) {
            throw ValidationException::withMessages(['email' => 'El e-mail ya está registrado']);
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
    
        //Debe aceptar términos
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
        $user->cuentabancaria = $request->cuentabancaria;
        $user->fechanacimiento = $request->fechanacimiento;
        $user->direccion = $request->direccion;
        $user->usuario = $request->usuario;
        //Título
        $nombre = "";
        if ($request->hasFile('titulo')) {
            $nombre = $request->file('titulo')->store('public');
        }
        $user->titulo = $nombre;
        //Password generator
        $user->password = password_hash($request->pass, PASSWORD_DEFAULT);
        $user->perfil = "profesor";
        $user->save();
        $user->specialties()->attach($request->input('especialidades'));
        return view("messages.successuser");
    }
}
