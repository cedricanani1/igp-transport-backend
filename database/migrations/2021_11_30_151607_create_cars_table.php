<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('description');
            $table->string('slug');
            $table->string('photo');
            $table->integer('stock')->default(0)->nullable();
            $table->string('price')->nullable();
            $table->integer('discount')->default(0)->nullable();
            $table->string('mileage');
            $table->enum('fuel_type', ['super','gasoil']);
            $table->string('color_exterior');
            $table->string('color_interior');
            $table->string('year')->nullable();
            $table->enum('transmission', ['manuel','automatique']);
            $table->integer('car_type_id');
            $table->integer('car_model_id');
            $table->integer('car_marque_id');
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
        Schema::dropIfExists('cars');
    }
}
