<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $table = "days";

    protected $primaryKey = 'id';

    //Un dia tiene muchos usuarios, con esto puede sacar que días tiene disponible cada uno.
    public function users()
    {
        return $this->belongsToMany("App\Models\User");
    }
}
