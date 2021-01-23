<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $primaryKey = 'id';

    protected $dates = ['fechanacimiento'];

    //Un usuario tiene muchas especialidades
    public function specialties()
    {
        return $this->belongsToMany("App\Models\Specialty");
        //Attach(x) agrega dettach(x) saca dettach() saca todos.. 4
        //sync(1) elimina todos y agrega el 1
    }

    //Un usuario(Profesor) tiene muchos días.// días disponibles en los que da clases.
    public function days()
    {
        return $this->belongsToMany("App\Models\Day");
    }
}
