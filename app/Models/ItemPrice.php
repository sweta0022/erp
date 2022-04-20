<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
