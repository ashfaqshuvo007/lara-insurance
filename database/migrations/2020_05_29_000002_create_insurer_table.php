<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurerTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'insurer';

    /**
     * Run the migrations.
     * @table insurer
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('insurer_id', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->tinyInteger('status')->nullable()->default('1');

            $table->unique(["insurer_id"], 'insurer_id_UNIQUE');
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
