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
        'is_returner_staff',
        'name',
        'returner_name',
        'nim',
        'returner_nim',
        'group_class',
        'returner_group_class',
        'start_date',
        'end_date',
        'status',
        'staff_id',
        'staff_id_returner',
        'staff_id_mentor',
        'laboratory_id',
        'lab_member_id_borrow',
        'lab_member_id_return',
    ];


    // Relasi ke detail
    public function details()
    {
        return $this->hasMany(LbsUsagePermitDetail::class);
    }

    // Relasi opsional lainnya (misal ke User, Staff, dll)
    // public function staff()
    // {
    //     return $this->belongsTo(User::class, 'staff_id');
    // }

    public function staffMentor()
    {
        return $this->belongsTo(Staff::class, 'staff_id_mentor', 'id');
    }

    // public function studyProgram()
    // {
    //     return $this->belongsTo(StudyProgram::class);
    // }
    public function memberBorrow()
    {
        return $this->belongsTo(LabMember::class, 'lab_member_id_borrow', 'id');
    }

    public function memberReturn()
    {
        return $this->belongsTo(LabMember::class, 'lab_member_id_return', 'id');
    }

    public function staffBorrower()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function staffReturner()
    {
        return $this->belongsTo(Staff::class, 'staff_id_returner', 'id');
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    // public function labMember()
    // {
    //     return $this->belongsTo(LabMember::class);
    // }
}
