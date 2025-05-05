<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseInstructor extends Model
{
    use HasFactory;
    public function  semesterCourse(){
        return $this->belongsTo(SemesterCourse::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    

    protected $guarded = ['id'];

}
