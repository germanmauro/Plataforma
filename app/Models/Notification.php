<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function userInvalidated(User $user)
    {
        $this->register($user->id, "Mensaje", "Se ha invalidado su usuario. Quedó inhabilitado para utilizar el sistema");
    }
}
