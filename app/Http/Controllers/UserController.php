<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('usuarios.index',compact('users'));
    }

    public function edit()
    {
        if (!session()->has('Perfil')) {
            return redirect("");
        }
        $user = User::find(session("Id"));
        return view('cambiodatos', compact("user"));
    }

    public function update(User $user, Request $request)
    {
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->telefono = $request->telefono;
        $user->tipodocumento = $request->tipodocumento;
        $user->dni = $request->dni;
        // $user->email = $request->email;
        $user->fechanacimiento = $request->fechanacimiento;
        $user->direccion = $request->direccion;
        if(session("Perfil")=="profesor") {
            $user->descripcion = $request->descripcion;
            $user->cuentabancaria = $request->cuentabancaria;
            $user->banco = $request->banco;
            $user->alias = $request->alias;
            $user->cbu = $request->cbu;
            $user->titular = $request->titular;
            $user->paypal = $request->paypal;
            if ($request->hasFile('foto')) {
                $nombre = $request->file('foto')->store("public/foto");
                $nombre = str_replace("public/foto/", "", $nombre);
                $user->foto = $nombre;
            }
            //  Si no hay cobro
            if (($user->cbu=="" || $user->banco == "" || $user->titular == "") && $user->paypal == "") {
                throw ValidationException::withMessages(['cobro' => 'Debe completar un método de cobro']);
            }
        }
       
        if($request->pass!="") {
            if ($request->pass <> $request->passrepeat) {
                throw ValidationException::withMessages(['passrepeat' => 'Debe repetir la misma contraseña']);
            }
            $user->password = password_hash($request->pass, PASSWORD_DEFAULT);
        }
        $user->save();
        session([
            'Nombre' => $user->nombre,
            'Apellido' => $user->apellido,
        ]);
        return redirect("")->with("success","Perfil modificado correctamente");
    }

    //Carga de contrato
    public function cargacontract()
    {
        if (!session()->has('Perfil')) {
            return redirect("");
        }
        $user = User::find(session("Id"));
        if($user->estado == "contrato a enviar") {
            return view('contrato.carga');
        } else {
            return redirect("");
        }  
    }

    public function uploadcontract(Request $request)
    {
        if (!session()->has('Perfil')) {
            return redirect("");
        }
        
        $user = User::find(session("Id"));
        if (!$request->has("contrato")) {
            throw ValidationException::withMessages(['terminos' => 'Debe aceptar los términos del contrato']);
        }
        $user->estado = "validado";
        $user->save();
        session(['Estado' => $user->estado]);
        $not = new Notification();
        $not->register(1,"Habilitacion", "El usuario " . $user->nombre . " " . $user->apellido." 
        ha aceptado el contratod de exclusividad");
        return redirect("")->with("success","Contrato aceptado, ya puede utilizar la plataforma");
    }
}
