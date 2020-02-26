<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsOfMeasurementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units_of_measurement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('variable_id');
            $table->string('name');
            $table->string('unit');

            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
            
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
        Schema::dropIfExists('units_of_measurement');
    }
}
