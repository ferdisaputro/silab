<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LbsUsagePermit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function loanDetails()
    {
        return $this->hasMany(LbsUsagePermitDetail::class);
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function memberBorrow()
    {
        return $this->belongsTo(LabMember::class, 'lab_member_id_borrow', 'id');
    }

    public function memberReturn()
    {
        return $this->belongsTo(LabMember::class, 'lab_member_id_return', 'id');
    }

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

}
