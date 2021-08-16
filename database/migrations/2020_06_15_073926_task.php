<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Task extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('assigned_to')->nullable();
            $table->date('date')->nullable();
            $table->string('subject')->nullable();
            $table->string('description')->nullable();
            $table->string('customer_id')->nullable();
            $table->boolean('is_complete')->default(0);
            $table->string('created_by')->nullable();
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

    }
}
