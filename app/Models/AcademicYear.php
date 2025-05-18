<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    // public function permitDetails()
    // {
    //     return $this->hasMany(LbsUsagePermitDetail::class);
    // }
}
