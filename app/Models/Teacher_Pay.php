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
        return $this->hasOne("App\Models\Buy");
    }
}
