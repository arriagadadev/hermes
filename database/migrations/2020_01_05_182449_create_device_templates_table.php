<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('scope')->default(0);
            $table->unsignedBigInteger('device_type_id');
            $table->unsignedBigInteger('technology_type_id');
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->json('slots');

            $table->foreign('device_type_id')->references('id')->on('device_types');
            $table->foreign('technology_type_id')->references('id')->on('technology_types');
            $table->foreign('icon_id')->references('id')->on('icons');
            $table->foreign('organization_id')->references('id')->on('organizations');

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
        Schema::dropIfExists('device_templates');
    }
}
