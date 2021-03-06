<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    use HasFactory;

    protected $table = "publications";

    protected $primaryKey = 'id';

    //Relaciones
    //Usuarios (profesor)
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    //Usuarios (profesor)
    public function specialty()
    {
        return $this->belongsTo("App\Models\Specialty");
    }

    //Tiene muchas compras
    public function buys()
    {
        return $this->hasMany("App\Models\Buy");
    }

    //Usuarios (alumnos)
    public function alumnos()
    {
        return $this->belongsToMany("App\Models\User");
    }

    //Inicios de Clase
    public function courses()
    {
        
        return $this->hasMany("App\Models\Course");
    }

    public function cursosActivos()
    {
        $hoy = new DateTime();
        $cursosActivos = new Collection();
        foreach ($this->courses as $item) {
            if($item->inicio > $hoy || ($item->utilmaclase > $hoy && count($item->users)>0))
            {
                $cursosActivos[] = $item;
            }
        }
        return $cursosActivos;
    }

    public function cursosEliminar()
    {
        $hoy = new DateTime();
        $cursosActivos = new Collection();
        foreach ($this->courses as $item) {
            if($item->inicio > $hoy && count($item->users) == 0)
            {
                $cursosActivos[] = $item;
            }
        }
        return $cursosActivos;
    }

    //Retorna la primera imagen del curso
    public function firstImage()
    {
        if($this->imagen1 != "") {
            return "1";
        }
        if($this->imagen2 != "") {
            return "2";
        }
        if($this->imagen3 != "") {
            return "3";
        }
        return "";
    }

    public function slug()
    {
        return Str::slug($this->titulo,'-');
    }

    public function esFavorito()
    {
        return $this->alumnos()->where('user_id', session("Id"))->count();
    }
}
