<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'city';

    /**
     * Run the migrations.
     * @table city
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('city_id', 45)->nullable();
            $table->string('states_id', 45);
            $table->string('name', 45)->nullable();

            $table->index(["states_id"], 'fk_city_states1_idx');

            $table->unique(["city_id"], 'city_id_UNIQUE');
            $table->nullableTimestamps();


            $table->foreign('states_id', 'fk_city_states1_idx')
                ->references('state_id')->on('states')
                ->onDelete('no action')
                ->onUpdate('no action');
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
