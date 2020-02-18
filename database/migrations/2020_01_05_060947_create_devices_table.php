<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifier');
            $table->unsignedBigInteger('device_type_id');
            $table->unsignedBigInteger('technology_type_id');
            $table->unsignedBigInteger('organization_id');
            $table->string('alias')->default('NN');
            $table->integer('scope')->default(0);
            $table->boolean('has_gps')->default(false);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('icon_id')->default(1);
            $table->timestamps();

            $table->foreign('device_type_id')->references('id')->on('device_types');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('icon_id')->references('id')->on('icons');
            $table->foreign('technology_type_id')->references('id')->on('technology_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
