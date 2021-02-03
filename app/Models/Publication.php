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
}
