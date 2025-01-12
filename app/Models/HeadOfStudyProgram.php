<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOfStudyProgram extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
