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
            $table->renameColumn('building_name','building_id');
            $table->renameColumn('apartment_number','apartment_id');
            $table->renameColumn('dob','date');
        });

        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn('building_name');
        });

        Schema::table('repairs', function (Blueprint $table) {
            $table->renameColumn('building_name','building_id');
            $table->renameColumn('apartment_number','apartment_id');
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
