<?php

namespace App\Http\Controllers;

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
        $user->cuentabancaria = $request->cuentabancaria;
        $user->fechanacimiento = $request->fechanacimiento;
        $user->direccion = $request->direccion;
        if(session("Perfil")=="profesor") {
            $user->descripcion = $request->descripcion;
            $user->cuentabancaria = $request->cuentabancaria;
            $user->banco = $request->banco;
            $user->alias = $request->alias;
            $user->cbu = $request->cbu;
            $user->titular = $request->titular;
        }
        //Si existe el email
        // if (User::where('email', $request->email)->where('id','!=',$user->id)->count()) {
        //     throw ValidationException::withMessages(['email' => 'El e-mail ya está registrado']);
        // }
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

    public function storecontract(Request $request)
    {
        if (!session()->has('Perfil')) {
            return redirect("");
        }
        
        $user = User::find(session("Id"));
        if ($request->hasFile('contrato')) {
            $nombre = $request->file('contrato')->store("public");
            $nombre = str_replace("public/", "", $nombre);
        }
        $user->contrato = $nombre;
        $user->estado = "contrato a validar";
        $user->save();
        session(['Estado' => $user->estado]);
        return redirect("")->with("success","Contrato cargado correctamente");
    }
}
