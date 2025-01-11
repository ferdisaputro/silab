<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticumReadiness extends Model
{
    use HasFactory;

    public function courseInstructor()
    {
        return $this->belongsTo(CourseInstructor::class); // 'item_id' adalah foreign key
    }
    public function SemesterCourse()
    {
        return $this->belongsTo(SemesterCourse::class); // 'item_id' adalah foreign key
    }
    public function Staff()
    {
        return $this->belongsTo(Staff::class); // 'item_id' adalah foreign key
    }
    public function labMemberId()
    {
        return $this->belongsTo(LabMember::class); // 'item_id' adalah foreign key
    }
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class); // 'item_id' adalah foreign key
    }
    public function academicWeek()
    {
        return $this->belongsTo(AcademicWeek::class); // 'item_id' adalah foreign key
    }

}
