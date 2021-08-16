<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTplEntryTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tpl_entry';

    /**
     * Run the migrations.
     * @table tpl_entry
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tpl_entry_id', 45)->nullable();
            $table->string('insurer_id', 45);
            $table->string('tpl_sub_type_id', 45);
            $table->string('price', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->unique(["tpl_entry_id"], 'tpl_entry_id_UNIQUE');
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
