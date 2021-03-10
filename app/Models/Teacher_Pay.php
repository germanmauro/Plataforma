<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_Pay extends Model
{
    use HasFactory;
    protected  $table = "teachers_pays";
    protected  $primaryKey = "id";

    public function buy()
    {
        return $this->belongsTo("App\Models\Buy");
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
}
