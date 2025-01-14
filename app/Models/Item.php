<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['item_name','item_code','quantity','specification','description','user_id','unit_id','item_type_id'];
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function labItems() {
        return $this->hasMany(LabItem::class);
    }
}
