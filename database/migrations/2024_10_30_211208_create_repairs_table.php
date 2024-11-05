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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('building_name')->nullable();
            $table->string('apartment_number')->nullable();
            $table->enum('status', ['Checked In', 'Checked Out']);
            $table->enum('maintenance_type', ['Plumber', 'Electric', 'Structure', 'Other']);
            $table->string('date')->nullable();
            $table->integer('repair_fees')->nullable();
            $table->integer('utensils_fees')->nullable();
            $table->text('repair_details')->nullable();
            $table->integer('monthly_maintenance_fees')->nullable();
            $table->enum('services_included', ['Included', 'Not Included']);
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
        Schema::dropIfExists('repairs');
    }
};
