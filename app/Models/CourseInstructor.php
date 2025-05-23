<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseInstructor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function practicumReadiness(){
        return $this->hasMany(PracticumReadiness::class);
    }
    public function semesterCourse(){
        return $this->belongsTo(SemesterCourse::class);
    }
    public function studyPrograms(){
        return $this->belongsTo(StudyProgram::class);
    }
    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    protected $fillable =['semester_course_id','staff_id','user_id'];
}
