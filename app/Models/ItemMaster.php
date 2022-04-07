<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

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
        'status',
    ];
    
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
