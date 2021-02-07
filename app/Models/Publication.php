<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

}
