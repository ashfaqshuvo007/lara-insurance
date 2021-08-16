<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LossInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'loss_info';
    public function up()
    {
        //

        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('loss_id')->nullable();
            $table->string('entity')->nullable();
            $table->string('entity_id')->nullable();
            $table->string('loss_location')->nullable();
            $table->text('loss_description')->nullable();
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
        //
        Schema::dropIfExists($this->tableName);
    }
}
