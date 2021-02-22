<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $table = "buys";

    protected $primaryKey = 'id';

    public function meetings()
    {
        return $this->hasMany("App\Models\Meeting");
    }

    public function alumno()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function publication()
    {
        return $this->belongsTo("App\Models\Publication");
    }

    public function pay()
    {
        return $this->hasOne("App\Models\PayPal");
    }
}
