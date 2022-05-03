<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = DB::table('roles')->where('name','LIKE','ADMIN')->first();
        $role_id = $role->id;
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => date('Ymdhis'),
            'password' => Hash::make('Admin@123'),
            'role_id' => $role_id,
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
