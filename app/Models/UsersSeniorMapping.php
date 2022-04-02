<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersSeniorMapping extends Model
{
    protected $fillable = [
        'user_id',
        'senior_id',
        'status',
    ];

    public function getSeniors()
    {

    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function username($id)
    {
        
        return User::where('id',$id)->first(['name','id']);
    }

  

}
