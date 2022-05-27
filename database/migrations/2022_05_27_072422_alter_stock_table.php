<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `stocks` ADD `mrp` DECIMAL(10,2) NOT NULL AFTER `item_price_id`");
        DB::statement("ALTER TABLE `stocks` CHANGE `wastage_quantity` `wastage_quantity` INT(11) NOT NULL DEFAULT '0'");
        DB::statement("ALTER TABLE `stocks` CHANGE `outward_quantity` `outward_quantity` INT(11) NOT NULL DEFAULT '0'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `stocks` DROP `mrp`");
        DB::statement("ALTER TABLE `stocks` CHANGE `wastage_quantity` `wastage_quantity` INT(11) NULL DEFAULT NULL");
        DB::statement("ALTER TABLE `stocks` CHANGE `outward_quantity` `outward_quantity` INT(11) NULL DEFAULT NULL");
        //
    }
}
