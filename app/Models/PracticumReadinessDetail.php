<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PracticumReadinessDetail extends Model
{
    use HasFactory;

    public function labItem()
    {
        return $this->belongsTo(LabItem::class);
    }
    public function stockCard() {
        return $this->belongsTo(StockCard::class);
    }

    protected $fillable = [
        'code',
        'qty',
        'description',
        'practicum_readiness_id',
        'lab_item_id',
        'stock_card_id'
    ];
}
