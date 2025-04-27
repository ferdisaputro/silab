<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLossOrDamageDetail extends Model
{
    use HasFactory;
    public function labItem(){
        return $this->belongsTo(LabItem::class);
    }
    protected $fillable = [
        'code',
        'amount_loss_damaged',
        'status',
        'item_loss_or_damage_id',
        'lab_item_id',
    ];

}
