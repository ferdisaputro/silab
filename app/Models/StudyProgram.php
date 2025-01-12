<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyProgram extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function throughHeadOfDepartments()
    {
        return $this->hasManyThrough(
            Staff::class,
            HeadOfStudyProgram::class,
            'study_program_id',
            'id',
            'id',
            'staff_id'
        );
    }

    public function headOfStudyPrograms()
    {
        return $this->hasMany(HeadOfStudyProgram::class);
    }
}
