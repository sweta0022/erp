<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ItemPrice;
use App\Models\Stock;

class ItemMaster extends Model
{
    protected $fillable = [
        'name',
        'item_code',
        'unit_measurement',
        'category_id',
        'type',
        'item_class',
        'pcs_in_box',
        'hsn_code',
        'gst',
        'status',
    ];
    
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function item_price(){
        return $this->hasMany(ItemPrice::class,'item_id');
    }

    public function totalStock($itemId)
    {
        return Stock::where('id',$itemId)->sum('stock_in_quantity');
    }
}
