<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationPermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_permission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_permission_user');
    }
}
