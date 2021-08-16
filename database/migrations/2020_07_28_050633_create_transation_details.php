<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transation_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('order_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('transation_details');
    }
}
