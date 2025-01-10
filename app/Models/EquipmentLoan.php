<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentLoan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function loanDetails()
    {
        return $this->hasMany(EquipmentLoanDetail::class);
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function memberBorrow()
    {
        return $this->hasOne(LabMember::class, 'lab_member_id_borrow', 'id');
    }

    public function memberReceive()
    {
        return $this->hasOne(LabMember::class, 'lab_member_id_receive', 'id');
    }

    public function mentor()
    {
        return $this->hasOne(Staff::class, 'staff_id_mentor', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
