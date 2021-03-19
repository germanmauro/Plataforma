<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_User extends Model
{
    use HasFactory;

    protected $table = "course_user";
    protected $primaryKey = "id";
}
