<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LbsUsagePermitDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'qty',
        'lbs_usage_permit_id',
        'lab_item_id',
        'unit_id',
        'stock_card_id',
        // 'academic_year_id',
    ];

    // Relasi ke master/permit
    // public function permitDetails()
    // {
    //     return $this->belongsTo(LbsUsagePermit::class, 'lbs_usage_permit_id');
    // }

    public function labItem()
    {
        return $this->belongsTo(LabItem::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stockCard()
    {
        return $this->belongsTo(StockCard::class);
    }

    // public function academicYear()
    // {
    //     return $this->belongsTo(AcademicYear::class);
    // }
}
