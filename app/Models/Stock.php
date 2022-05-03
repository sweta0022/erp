<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;

class Stock extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'batch_number',
        'item_price_id',
        'stock_in_quantity',
        'wastage_quantity',
        'outward_quantity'
    ];

   
}
