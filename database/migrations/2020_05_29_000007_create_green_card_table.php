<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenCardTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'green_card';

    /**
     * Run the migrations.
     * @table green_card
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('green_card_id', 45)->nullable();
            $table->string('green_card_type', 45)->nullable();
            $table->string('insurer_id', 45);
            $table->string('name', 45)->nullable();
            $table->string('15_days_price', 45)->nullable();
            $table->string('30_days_price', 45)->nullable();
            $table->string('45_days_price', 45)->nullable();
            $table->string('3_months_price', 45)->nullable();
            $table->string('6_months_price', 45)->nullable();
            $table->string('12_months_price', 45)->nullable();
            $table->tinyInteger('status')->nullable()->default('1');

            $table->unique(["green_card_id"], 'claims_id_UNIQUE');
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
       Schema::dropIfExists($this->tableName);
     }
}
