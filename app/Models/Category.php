<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $primaryKey = 'id';

    public function specialties() {
        return $this->hasMany('App\Models\Specialty',"categoria","id")->where("baja","false")->orderBy("nombre");
    }

}
