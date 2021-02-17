<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $table = "meetings";

    protected $primaryKey = 'id';

    //Usuarios (profesor)
    public function buy()
    {
        return $this->belongsTo("App\Models\Buy");
    }
}
