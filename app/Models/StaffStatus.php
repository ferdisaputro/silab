<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffStatus extends Model
{
    use HasFactory;

    public function staffStatus()
    {
        return $this->hasMany(StaffStatus::class);
    }
}
