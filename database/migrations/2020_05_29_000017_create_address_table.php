<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'address';

    /**
     * Run the migrations.
     * @table address
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('address_id',45)->nullable();
            $table->string('entity_type', 45)->nullable();
            $table->string('entity_id', 45)->nullable();
            $table->string('address', 45)->nullable();
            $table->string('city_id', 45);
            $table->string('states_id', 45);
            $table->string('country', 45)->nullable();
            $table->string('zip', 45)->nullable();

            $table->index(["states_id"], 'fk_address_states1_idx');

            $table->index(["city_id"], 'fk_address_city1_idx');

            $table->unique(["address_id"], 'address_id_UNIQUE');
            $table->nullableTimestamps();


            $table->foreign('states_id', 'fk_address_states1_idx')
                ->references('state_id')->on('states')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('city_id', 'fk_address_city1_idx')
                ->references('city_id')->on('city')
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
