<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PracticumResultHandover extends Model
{
    use HasFactory;
    public function courseInstructor(){
        return $this->belongsTo(CourseInstructor::class);
    }
    public function academicWeek(){
        return $this->belongsTo(AcademicWeek::class);
    }
    public function laboratory(){
        return $this->belongsTo(Laboratory::class);
    }
    

    protected $table = 'practicum_result_leftover_handovers';
}
