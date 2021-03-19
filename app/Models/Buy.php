<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $table = "buys";

    protected $primaryKey = 'id';

    protected $dates = ["fecha","fechavencimiento"];

    public function meetings()
    {
        return $this->hasMany("App\Models\Meeting");
    }

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function course()
    {
        return $this->belongsTo("App\Models\Course");
    }

    public function pay()
    {
        return $this->hasOne("App\Models\PayPal");
    }

    public function teacher_pay()
    {
        return $this->hasOne("App\Models\Teacher_Pay");
    }
}
