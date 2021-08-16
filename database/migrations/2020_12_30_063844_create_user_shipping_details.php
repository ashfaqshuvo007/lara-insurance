<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShippingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('user_shipping_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('shipping_id')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('tax_office')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('address')->nullable();
            $table->string('town')->nullable();
            $table->string('city')->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('shipping_country')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_shipping_details');
    }
}
