<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsAndConditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_and_condition', function (Blueprint $table) {
            $table->id();
            $table->string('insurer_id')->nullable();
            $table->string('policy_name')->nullable();
            $table->string('insurer_policy_id')->nullable();
            $table->string('policy_file')->nullable();
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
        Schema::dropIfExists('terms_and_condition');
    }
}
