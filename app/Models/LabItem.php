<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabItem extends Model
{
    use HasFactory;
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id'); // 'item_id' adalah foreign key
    }
    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class, 'laboratory_id','id'); // 'item_id' adalah foreign key
    }
    protected $fillable = ['code','description','stock','laboratory_id','item_id','is_active'];
}
