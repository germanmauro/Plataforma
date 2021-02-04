<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = "publications";

    protected $primaryKey = 'id';

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

    //Retorna la cantidad de imagenes de la publicación
    // para poder organizar la vista
    public function cantidadImagenes()
    {
        $cantidad = 0;
        if($this->imagen1 != "") {
            $cantidad++;
        }
        if($this->imagen2 != "") {
            $cantidad++;
        }
        if($this->imagen3 != "") {
            $cantidad++;
        }
        return $cantidad;
    }

}
