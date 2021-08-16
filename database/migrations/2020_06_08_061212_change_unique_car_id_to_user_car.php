<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUniqueCarIdToUserCar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_car', function (Blueprint $table) {
            $table->dropUnique('car_registration_number_UNIQUE');
            $table->unique(["car_id"], 'car_id_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_car', function (Blueprint $table) {
            //
        });
    }
}
