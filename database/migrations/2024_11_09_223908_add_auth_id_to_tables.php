<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });

        Schema::table('apartments', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });

        Schema::table('repairs', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });

        Schema::table('buildings', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            //
    }
};
