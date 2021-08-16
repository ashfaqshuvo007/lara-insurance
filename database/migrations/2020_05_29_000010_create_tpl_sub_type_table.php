<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTplSubTypeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tpl_sub_type';

    /**
     * Run the migrations.
     * @table tpl_sub_type
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tpl_sub_type_id', 45)->nullable();
            $table->string('tpl_type_id', 45);
            $table->string('name', 45)->nullable();

            $table->index(["tpl_type_id"], 'fk_tpl_sub_type_tpl_type1_idx');

            $table->unique(["tpl_sub_type_id"], 'policy_sub_type_id_UNIQUE');
            $table->nullableTimestamps();


            $table->foreign('tpl_type_id', 'fk_tpl_sub_type_tpl_type1_idx')
                ->references('tpl_type_id')->on('tpl_type')
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
