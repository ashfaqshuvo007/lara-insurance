<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_car', function (Blueprint $table) {
            $table->increments('id');
            $table->string('car_registration_number', 45)->nullable();
            $table->string('car_tpye', 45)->nullable();
            $table->string('car_sub_type', 45)->nullable();
            $table->string('production_year', 45)->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
            $table->unique(["car_registration_number"], 'car_registration_number_UNIQUE');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_car');
    }
}
