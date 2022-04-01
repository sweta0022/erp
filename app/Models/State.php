<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class State extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    public function getAllState(){
        return State::get();
    }  
    
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
