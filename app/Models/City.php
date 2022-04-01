<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function getCities($stateid){
        return City::where('state_id',$stateid)->get();
    }  

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
