<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PracticumResultHandover extends Model
{
    use HasFactory;

    public function courseInstructor()
    {
        return $this->belongsTo(CourseInstructor::class, 'course_instructor_id', 'id');
    }
    public function academicWeek()
    {
        return $this->belongsTo(AcademicWeek::class, 'academic_week_id', 'id');
    }
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class, 'laboratory_id', 'id');
    }
    public function labMember()
    {
        return $this->belongsTo(LabMember::class, 'lab_member_id', 'id');
    }

    protected $fillable = [
        'code',
        'practicum_event',
        'date',
        'course_instructor_id',
        'academic_week_id',
        'laboratory_id',
        'lab_member_id',
    ];
}
