<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;

use function PHPUnit\Framework\isNull;

class LoginController extends Controller
{
    public function ingreso(Request $request)
    {
        //Si existe el usuario
        $user = User::where('usuario', $request->user)->where('baja', 'false')->first();
        // return $user->nombre;
        if (!$user) {
            throw ValidationException::withMessages(['usuario' => 'El nombre de usuario no existe']);
        }
        $pass = $request->pass;
        $hash = $user->password;
        if (password_verify($pass, $hash)) {
            session([
                'Id'=> $user->id,
                'Usuario'=> $user->usuario,
                'Perfil'=> $user->perfil,
                'Nombre'=> $user->nombre,
                'Apellido'=> $user->apellido,
            ]);
            
            return redirect('');
        } else {
            throw ValidationException::withMessages(['password' => 'La contaseña es incorrecta']);
        }
        
        
    }
}