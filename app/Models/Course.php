<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";
    protected $primaryKey = "id";
    protected $dates = ["inicio","fechaactual","ultimaclase"];

    public function days()
    {
        return $this->hasMany("App\Models\Day");
    }

    public function publication()
    {
        return $this->belongsTo("App\Models\Publication");
    }

    //Pertenece a muchos usuarios
    public function users()
    {
        return $this->belongsToMany("App\Models\User");
    }

    public function diasActuales()
    {
        return $this->days()->whereBetween('fecha',[$this->fechaactual,$this->ultimaclase])->get();
    }
}
