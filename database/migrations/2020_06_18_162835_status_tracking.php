<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'status_tracking';
    public function up()
    {
        //
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('entity')->nullable();
            $table->string('entity_id')->nullable();
            $table->string('status')->nullable();
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
        //
        Schema::dropIfExists($this->tableName);
    }
}
