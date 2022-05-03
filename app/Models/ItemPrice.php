<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemMaster;

class ItemPrice extends Model
{
    protected $fillable = [
        'item_id',
        'mrp',
        'cost_price',
        'ss_price',
        'distributor_price',
        'status',
    ];

    public function Item_master()
    {
        return $this->belongsTo(ItemMaster::class,'item_id');
    }

    
}
