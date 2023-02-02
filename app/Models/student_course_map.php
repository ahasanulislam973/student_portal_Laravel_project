<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_course_map extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(student::class);
    }
    public function course()
    {
        return $this->belongsTo(courselist::class);
    }
}
