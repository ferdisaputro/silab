<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PracticumResultHandover extends Model
{
    use HasFactory;
    protected $table = 'practicum_result_leftover_handovers';


    public function courseInstructor()
    {
        return $this->belongsTo(CourseInstructor::class);
    }
    public function academicWeek()
    {
        return $this->belongsTo(AcademicWeek::class);
    }
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }
    public function labMember()
    {
        return $this->belongsTo(LabMember::class);
    }
    public function practicumResult()
    {
        return $this->hasMany(PracticumResult::class, 'practicum_result_leftover_handover_id');
    }
    public function practicumResultLeftOver()
    {
        return $this->hasMany(practicumLeftOver::class, 'practicum_result_leftover_handover_id');
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
