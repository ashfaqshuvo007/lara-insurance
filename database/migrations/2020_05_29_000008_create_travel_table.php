<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'travel';

    /**
     * Run the migrations.
     * @table travel
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('travel_id', 45)->nullable();
            $table->string('insurer_id', 45);
            $table->string('age_group', 45)->nullable();
            $table->string('zone', 45)->nullable();
            $table->string('validity', 45)->nullable();
            $table->string('price', 45)->nullable();

            $table->unique(["travel_id"], 'tpl_entry_id_UNIQUE');
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
