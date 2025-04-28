<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LbsUsagePermit extends Model
{
    use HasFactory;

    public function LbsUsageDetail(){
        return $this->hasMany(LbsUsagePermitDetail::class);
    }
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    // public function memberBorrow()
    // {
    //     return $this->belongsTo(LabMember::class, 'lab_member_id_borrow', 'id');
    // }

    // public function memberReturn()
    // {
    //     return $this->belongsTo(LabMember::class, 'lab_member_id_return', 'id');
    // }

    public function mentor()
    {
        return $this->belongsTo(Staff::class, 'staff_id_mentor', 'id');
    }

    public function staffBorrower()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function staffReturner()
    {
        return $this->belongsTo(Staff::class, 'staff_id_returner', 'id');
    }

    protected $fillable =['code','is_staff','name','nim','start_date','end_date','status','staff_id','staff_id_mentor','study_program_id','laboratory_id','lab_member_id'];
}
