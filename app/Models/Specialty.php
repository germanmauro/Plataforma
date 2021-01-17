<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $table = "specialties";

    protected $primaryKey = 'id';
    
    //Tiene una categoria
    public function category() {
        return $this->belongsTo("App\Models\Category","categoria","id");
    }
    
    //Pertenece a muchos usuarios
    public function usuarios() {
        return $this->belongsToMany("App\Models\User");
    }

}
