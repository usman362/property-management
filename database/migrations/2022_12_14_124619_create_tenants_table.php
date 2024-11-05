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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('partner_first_name')->nullable();
            $table->string('partner_last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cellphone_number')->nullable();
            $table->string('working_place_name')->nullable();
            $table->string('working_place_address')->nullable();
            $table->string('working_place_contact')->nullable();
            $table->string('working_place_email')->nullable();
            $table->string('guarantor_first_name')->nullable();
            $table->string('guarantor_last_name')->nullable();
            $table->string('guarantor_address')->nullable();
            $table->string('guarantor_phone_number')->nullable();
            $table->string('guarantor_cellphone_number')->nullable();
            $table->string('guarantor_working_place_name')->nullable();
            $table->string('guarantor_working_place_address')->nullable();
            $table->string('guarantor_working_place_contact')->nullable();
            $table->string('guarantor_working_place_email')->nullable();
            $table->string('building_name')->nullable();
            $table->string('apartment_number')->nullable();
            $table->string('check_in_date')->nullable();
            $table->string('check_out_date')->nullable();
            $table->string('contract_date')->nullable();
            $table->integer('monthly_fees')->nullable();
            $table->integer('deposit_amount')->nullable();
            $table->enum('deposit_type', ['cash', 'deposit'])->nullable();
            $table->string('monthly_due_date')->nullable();
            $table->integer('late_fees')->nullable();
            $table->string('dob')->nullable();
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
        Schema::dropIfExists('tenants');
    }
};
