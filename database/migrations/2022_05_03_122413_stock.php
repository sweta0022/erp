<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('item_id'); 
            $table->string('batch_number'); 
            $table->integer('item_price_id'); 
            $table->integer('stock_in_quantity'); 
            $table->integer('wastage_quantity')->nullable();; 
            $table->integer('outward_quantity')->nullable();; 
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
        Schema::dropIfExists('stocks');
    }
}
