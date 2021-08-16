<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullCascoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'full_casco';

    /**
     * Run the migrations.
     * @table full_casco
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('full_casco_id', 45)->nullable();
            $table->string('insurer_id', 45);
            $table->string('variant', 45)->nullable();
            $table->string('percentage', 45)->nullable();
            $table->string('price', 45)->nullable();
            $table->unique(["full_casco_id"], 'tpl_entry_id_UNIQUE');
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
