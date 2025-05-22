<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLossOrDamage extends Model
{
    use HasFactory;
    public function LossDamageDetail(){
        return $this->hasMany(ItemLossOrDamageDetail::class);
    }

    public function laboratory() {
        return $this->belongsTo(Laboratory::class);
    }

    public function labMember() {
        return $this->belongsTo(LabMember::class);
    }

    protected $fillable = [
        'code',
        'name',
        'nim',
        'group_class',
        'status',
        'date_replace_agreement', // <--- ini penting!
        'laboratory_id',
        'lab_member_id',
    ];
}
