<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $table = "days";
    protected $primayKey = "Id";
    protected $dates = ["fecha"];

    public function course()
    {
        return $this->belongsTo("App\Models\Course");
    }

    public function getEstado()
    {
        $hoy = new DateTime();
        if ($this->fecha > $hoy) {
            return "Pendiente";
        } else {
            return "Cursada";
        }
    }
}
