<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alias');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('unit_of_measurement_id');
            $table->unsignedBigInteger('display_mode_id');
            $table->string('parameter_name');
            $table->boolean('active')->default(true);
            $table->string('title');
            $table->string('color')->default('#336699');

            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('unit_of_measurement_id')->references('id')->on('units_of_measurement');
            $table->foreign('display_mode_id')->references('id')->on('display_modes');

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
        Schema::dropIfExists('slots');
    }
}
