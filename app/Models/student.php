<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable=['name','email','phone','address'];

    public function student_course_map()
    {
        return $this->hasMany(student_course_map::class);
    }
}
