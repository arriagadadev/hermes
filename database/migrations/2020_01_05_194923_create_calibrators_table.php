<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('function_type_id');
            $table->decimal('a', 18, 6)->nullable();
            $table->decimal('b', 18, 6)->nullable();
            $table->decimal('c', 18, 6)->nullable();
            $table->decimal('d', 18, 6)->nullable();

            $table->foreign('function_type_id')->references('id')->on('function_types');

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
        Schema::dropIfExists('calibrators');
    }
}
