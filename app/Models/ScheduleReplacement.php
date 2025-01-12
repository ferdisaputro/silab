<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleReplacement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function head_of_study_program(){
        return $this->belongsTo(HeadOfStudyProgram::class);
    }
    public function lecturer() {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
    public function labMember() {
        return $this->belongsTo(LabMember::class);
    }
}
