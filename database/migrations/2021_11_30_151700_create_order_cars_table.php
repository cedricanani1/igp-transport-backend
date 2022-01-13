<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cars', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('car_id');
            $table->integer('days')->nullable();
            $table->integer('price');
            $table->date('to');
            $table->date('from');
            $table->boolean('driver');
            $table->string('other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_cars');
    }
}
