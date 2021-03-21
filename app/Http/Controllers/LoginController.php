<?php

namespace App\Http\Controllers;

use App\Mail\mailResetpass;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isNull;

class LoginController extends Controller
{
    public function ingreso(Request $request)
    {
        //Si existe el usuario
        $user = User::where('email', $request->email)->where('baja', 'false')->first();
        // return $user->nombre;
        if (!$user) {
            throw ValidationException::withMessages(['usuario' => 'El e-mail ingresado no existe']);
        }
        $pass = $request->pass;
        $hash = $user->password;
        if (password_verify($pass, $hash)) {
            session([
                'Id'=> $user->id,
                // 'Usuario'=> $user->usuario,
                'Email'=> $user->email,
                'Perfil'=> $user->perfil,
                'Estado'=> $user->estado,
                'Nombre'=> $user->nombre,
                'Apellido'=> $user->apellido,
                // 'PrimeraClase'=> $user->primeraclase,
            ]);
            
            return redirect('');
        } else {
            throw ValidationException::withMessages(['password' => 'La contaseña es incorrecta']);
        }
    }

    public function resetear(Request $request)
    {
        //Si existe el usuario
        $user = User::where('email', $request->email)->where('baja', 'false')->first();
        // return $user->nombre;
        if (!$user) {
            throw ValidationException::withMessages(['email' => 'El e-mail ingresado no existe']);
        }
        $newpass = $this->generateRandomString();
        $pass = password_hash($newpass, PASSWORD_DEFAULT);
        $user->password = $pass;
        $user->save();  
        //Acá va el envío de email
        Mail::to($user->email)->send(new mailResetpass($user,$newpass));
        return redirect('/Login')->with("success","Password reseteado con éxito, el mismo fue enviado a su casilla de correo");
    }

    //Funcion para generar un nuevo password
    public function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}