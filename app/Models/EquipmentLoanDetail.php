<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentLoanDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function stockCard() {
        return $this->belongsTo(StockCard::class);
    }

    // public function stockCardReturn() {
    //     return $this->belongsTo(StockCard::class, 'stock_card_id_return', 'id');
    // }

    public function labItem() {
        return $this->belongsTo(LabItem::class);
    }
}
