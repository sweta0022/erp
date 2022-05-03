<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class GstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gst_masters')->insert([
            'value' => 0,
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('gst_masters')->insert([
            'value' => 5,
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('gst_masters')->insert([
            'value' => 12,
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('gst_masters')->insert([
            'value' => 18,
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
