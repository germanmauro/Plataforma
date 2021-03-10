<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $table = "meetings";

    protected $primaryKey = 'id';
    protected $dates = ["fecha"];
    //Usuarios (profesor)
    public function buy()
    {
        return $this->belongsTo("App\Models\Buy");
    }

    public function getEstado()
    {
        $hoy = new DateTime();
        if($this->fecha > $hoy)
        {
            return "Pendiente";
        } else {
            return "Cursada";
        }
    }
}
