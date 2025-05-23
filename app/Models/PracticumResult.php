<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticumResult extends Model
{
    use HasFactory;
    protected $table = 'practicum_result';

    public function labItem(){
        return $this->belongsTo(LabItem::class);
    }
    public function stockCard() {
        return $this->belongsTo(StockCard::class);
    }

    protected $fillable = [
        'code',
        'qty',
        'description',
        'practicum_result_leftover_handover_id',
        'lab_item_id',
        'stock_card_id',
    ];
}
