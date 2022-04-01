<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;

class Role extends Authenticatable
{
   
    // protected $table = 'roles';
    protected $fillable = [
        'name',
        'status',
    ];

    public function getAllRoleExceptAdmin(){
        return Role::where('name','NOT LIKE','ADMIN')->get();
    }   

    public function getSeniors($role_id)
    {
        $roleData = Role::where('id',$role_id)->first();
        $senior_role_id = 0;

        if( $roleData->name === 'COMPANY' )
        {
            $senior_role_id = 1;
        }
        else if( $roleData->name === 'SUPER STOCKIST' )
        {
            $senior_role_id = 2;
        }
        else if( $roleData->name === 'DISTRIBUTER' )
        {
            $senior_role_id = 3;
        }

        return User::where('role_id',$senior_role_id)->get();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }




}
