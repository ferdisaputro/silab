<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function members()
    {
        return $this->hasMany(LabMember::class);
    }

    public function labItems()
    {
        return $this->hasMany(LabItem::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function equipmentLoans() {
        return $this->hasMany(EquipmentLoan::class);
    }
}
