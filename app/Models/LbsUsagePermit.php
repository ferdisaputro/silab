<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LbsUsagePermit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'is_staff',
        'name',
        'nim',
        'start_date',
        'end_date',
        'status',
        'staff_id',
        'staff_id_mentor',
        // 'study_program_id',
        'laboratory_id',
        'lab_member_id',
    ];

    // Relasi ke detail
    public function details()
    {
        return $this->hasMany(LbsUsagePermitDetail::class);
    }

    // Relasi opsional lainnya (misal ke User, Staff, dll)
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function staffMentor()
    {
        return $this->belongsTo(User::class, 'staff_id_mentor');
    }

    // public function studyProgram()
    // {
    //     return $this->belongsTo(StudyProgram::class);
    // }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function labMember()
    {
        return $this->belongsTo(LabMember::class);
    }
}
