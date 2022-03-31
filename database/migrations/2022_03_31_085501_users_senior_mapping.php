<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersSeniorMapping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_senior_mappings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('senior_id');
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
        Schema::dropIfExists('users_senior_mappings');
    }
}
