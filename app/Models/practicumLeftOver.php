<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class practicumLeftOver extends Model
{
    use HasFactory;

    protected $table = 'practicum_leftover';

    public function labItem(){
        return $this->belongsTo(LabItem::class);
    }
    public function stockCard() {
        return $this->belongsTo(StockCard::class);
    }

    protected $fillable = [
        'code',
        'qty',
        'lab_item_id',
        'stock_card_id',
        'practicum_result_leftover_handover_id',
        'unit_id',
    ];
}
