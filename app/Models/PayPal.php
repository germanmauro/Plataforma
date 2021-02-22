<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPal extends Model
{
    use HasFactory;

    protected $table = "paypal";

    protected $primaryKey = 'id';

    public function buy()
    {
        return $this->belongsTo("App\Models\Buy");
    }
}
