<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_masters', function (Blueprint $table) {
            $table->id();
            $table->string('item_code');
            $table->string('name');
            $table->integer('unit_measurement');
            $table->integer('category_id');
            $table->string('type')->nullable();
            $table->integer('item_class');
            $table->integer('pcs_in_box');
            $table->tinyInteger('status')->default(1)->comment('1 AS ACTIVE; 0 AS INACTIVE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_masters');
    }
}
