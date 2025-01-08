<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['item_name','item_code','quantity','specification','description','user_id','unit_id','item_type_id'];
    public function unit()
{
    return $this->belongsTo(Unit::class, 'unit_id');
}
}
