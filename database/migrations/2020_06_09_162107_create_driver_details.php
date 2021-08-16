<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_second_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('id_card_number')->nullable();
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
        Schema::dropIfExists('driver_details');
    }
}
