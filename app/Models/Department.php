<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    public $fillable = [
        'code',
        'department',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyPrograms()
    {
        return $this->hasMany(StudyProgram::class);
    }
}
