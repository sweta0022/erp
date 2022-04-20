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
            'created_at' => date('Ymdhis'), 
            'updated_at' => date('Ymdhis'),
        ]);

        DB::table('gst_masters')->insert([
            'value' => 5,
            'created_at' => date('Ymdhis'), 
            'updated_at' => date('Ymdhis'),
        ]);

        DB::table('gst_masters')->insert([
            'value' => 12,
            'created_at' => date('Ymdhis'), 
            'updated_at' => date('Ymdhis'),
        ]);

        DB::table('gst_masters')->insert([
            'value' => 18,
            'created_at' => date('Ymdhis'), 
            'updated_at' => date('Ymdhis'),
        ]);
    }
}
