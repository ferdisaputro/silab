<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemesterCourse extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseInstructor()
    {
        return $this->hasOne(CourseInstructor::class);
    }
    public function semester(){
        return $this->belongsTo(Semester::class);
    }
    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}

