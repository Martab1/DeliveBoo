<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantTipologyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_tipology', function (Blueprint $table) {
            $table->id();
             // FK RESTAURANT
            $table->foreignId('restaurant_id')
            ->onDelete("cascade")
            ->constrained();
             // FK TIPOLOGY
            $table->foreignId('tipology_id')
            ->onDelete("cascade")
            ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_tipology');
    }
}
