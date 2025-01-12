<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function semesterCourses() {
        return $this->hasMany(SemesterCourse::class);
    }

    public function courses() {
        return $this->hasManyThrough(Course::class, SemesterCourse::class, 'semester_id', 'id', 'id', 'course_id');
    }
}
