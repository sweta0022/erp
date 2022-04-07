<?php

namespace App\Models;
use App\Models\ItemMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name',
        'code',
        'status',
    ];

    public function item()
    {
        return $this->hasMany(ItemMaster::class);
    }

  
}
