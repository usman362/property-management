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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->integer('building_id')->nullable();
            $table->string('building_name')->nullable();
            $table->string('apartment_name')->nullable();
            $table->string('floor')->nullable();
            $table->string('monthly_rental_price')->nullable();
            $table->string('balcony_area')->nullable();
            $table->string('living_room_area')->nullable();
            $table->string('dining_room_area')->nullable();
            $table->string('kitchen_area')->nullable();
            $table->string('alley_area')->nullable();
            $table->string('main_bedroom_area')->nullable();
            $table->string('second_bedroom_area')->nullable();
            $table->string('third_bedroom_area')->nullable();
            $table->string('bathroom_area')->nullable();
            $table->string('public_area')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('apartments');
    }
};
