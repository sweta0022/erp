<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'ADMIN',
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        DB::table('roles')->insert([
            'name' => 'COMPANY',
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        DB::table('roles')->insert([
            'name' => 'SUPER STOCKIST',
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
        DB::table('roles')->insert([
            'name' => 'DISTRIBUTER',
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
