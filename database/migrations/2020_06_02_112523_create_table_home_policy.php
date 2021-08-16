<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHomePolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_policy', function (Blueprint $table) {
            $table->increments('id');
            $table->string('home_policy_id', 45)->nullable();
            $table->string('insurer_id', 45);
            $table->string('home_type_id', 45)->nullable();
            $table->string('home_sub_type_id', 45)->nullable();
            $table->string('square', 45)->nullable();
            $table->string('address', 45)->nullable();
            $table->string('unit', 45)->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
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
        Schema::dropIfExists('table_home_policy');
    }
}
