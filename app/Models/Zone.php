<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function getZones($zone_id){
        return Zone::where('city_id',$zone_id)->get();
    }  
}
