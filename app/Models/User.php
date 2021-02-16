<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class User extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $primaryKey = 'id';

    protected $dates = ['fechanacimiento'];

    public function path()
    {
        return Storage::url($this->titulo);
    }

    //Un usuario tiene muchas especialidades
    public function specialties()
    {
        return $this->belongsToMany("App\Models\Specialty");
        //Attach(x) agrega dettach(x) saca dettach() saca todos.. 4
        //sync(1) elimina todos y agrega el 1
    }

    //Un usuario(Profesor) tiene muchos días.// días disponibles en los que da clases.
    public function availabilities()
    {
        return $this->hasMany("App\Models\Availability");
    }

    //Publicaciones(Profesor)
    public function publications()
    {
        return $this->hasMany("App\Models\Publication");
    }

    //Favoritos(Alumno)
    public function favorites()
    {
        return $this->belongsToMany("App\Models\Publication");
    }
}
