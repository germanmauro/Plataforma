<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Availability extends Model
{
    use HasFactory;

    protected $table = "availabilities";

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo("App/Models/User");
    }

    public function desde()
    {
        return substr($this->desde,0,5);
    }

    public function hasta()
    {
        return substr($this->hasta,0,5);
    }
}
