<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('insurer_id', 45)->nullable();
            $table->string('policy_name')->nullable();
            $table->string('insurer_policy_id')->nullable();
            $table->string('offer_name')->nullable();
            $table->string('amount_of')->nullable();
            $table->string('percentage_of')->nullable();
            $table->unique(["insurer_policy_id"], 'insurer_id_UNIQUE');
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
        Schema::dropIfExists('offers');
    }
}
