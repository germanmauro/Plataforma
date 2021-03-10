<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
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

    public function teachers_pays()
    {
        return $this->hasMany("App\Models\Teacher_Pay");
    }

    //Cursos del profesor a través de las publicaciones
    public function Cursadas()
    {
        return $this->hasManyThrough(Course::class, Publication::class)->orderBy("inicio","desc");
    }

    //Pertenece a muchos courses
    public function courses()
    {
        return $this->belongsToMany("App\Models\Course");
    }

    public function cursosActivos()
    {
        $hoy = new DateTime();
        $cursosActivos = new Collection();
        foreach ($this->Cursadas as $item) {
            if ($item->inicio > $hoy || ($item->utilmaclase > $hoy && count($item->users) > 0)) {
                $cursosActivos[] = $item;
            }
        }
        return $cursosActivos;
    }

    public function cursosPasados()
    {
        $hoy = new DateTime();
        $cursosActivos = new Collection();
        foreach ($this->Cursadas as $item) {
            if ($item->utilmaclase < $hoy && count($item->users) > 0) {
                $cursosActivos[] = $item;
            }
        }
        return $cursosActivos;
    }

    //Compras(Alumno)
    public function buys()
    {
        return $this->hasMany("App\Models\Buy");
    }

    public function notifications()
    {
        return $this->hasMany("App\Models\Notificarion");
    }

    public function notificacionesSinLeer()
    {
        return $this->notificacionesSinLeer->where("estado","creada");
    }
}
