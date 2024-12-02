<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function staffStatus()
    {
        return $this->belongsTo(StaffStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
