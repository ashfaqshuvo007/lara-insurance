<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->id();
            $table->string('property_id')->nullable();
            $table->string('policy_id')->nullable();
            $table->string('id_number')->nullable();
            $table->string('property_number')->nullable();
            $table->string('kadastral_number')->nullable();
            $table->string('full_address')->nullable();
            $table->string('inside_image_1')->nullable();
            $table->string('inside_image_2')->nullable();
            $table->string('inside_image_3')->nullable();
            $table->string('outside_image_1')->nullable();
            $table->string('outside_image_2')->nullable();
            $table->string('outside_image_3')->nullable();
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
        Schema::dropIfExists('property');
    }
}
