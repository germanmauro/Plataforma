<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $primaryKey = 'id';

    public function specialties() {
        return $this->hasMany('App\Models\Specialty',"categoria","id")->where("baja","false")->orderBy("nombre");
    }

    //Para obtener las publicaciones a través de una categoria
    public function publications() {
        return $this->hasManyThrough(Publication::class, Specialty::class,"categoria");
    }

    public function slug()
    {
        return Str::slug($this->nombre, '-');
    }
}
