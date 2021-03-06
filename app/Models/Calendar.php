<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = "calendars";
    protected $primaryKey = "Id";

    public function days()
    {
        return $this->hasMany("App\Models\Days");
    }
}
