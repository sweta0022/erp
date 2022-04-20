<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->decimal('mrp',10,2)->default(0); 
            $table->decimal('cost_price',10,2)->default(0);
            $table->decimal('ss_price',10,2)->default(0);
            $table->decimal('distributor_price',10,2)->default(0);
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
        Schema::dropIfExists('item_prices');
    }
}
