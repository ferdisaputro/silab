<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabMember extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Staff::class, 'id', 'id', 'staff_id', 'user_id');
    }

    public function laboratory() {
        return $this->belongsTo(Laboratory::class);
    }

    public function stockCards()
    {
        return $this->hasMany(StockCard::class);
    }

    public function scopeOnlyActive($query) {
        return $query->where('is_active', 1);
    }
}
