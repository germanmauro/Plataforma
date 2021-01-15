<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $table = "specialties";

    protected $primaryKey = 'id';
    
    public function category() {
        return $this->belongsTo("App\Models\Category","categoria","id");
    }
}
