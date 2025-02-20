<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticumReadiness extends Model
{
    use HasFactory;
    public function courseInstructor()
    {
        return $this->belongsTo(CourseInstructor::class);
    }
    public function semesterCourse(){
        return $this->belongsTo(SemesterCourse::class);
    }
    // public function laboratory()
    // {
    //     return $this->belongsTo(Laboratory::class);
    // }

    protected $fillable = ['recomendation','date','course_instructor_id','semester_course_id','staff_id','lab_member_id','laboratory_id','academic_week_id'];
}
