<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'documents';

    /**
     * Run the migrations.
     * @table documents
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('document_id', 45)->nullable();
            $table->string('entity_type', 45)->nullable();
            $table->tinyInteger('entity_id')->nullable()->default('1');
            $table->string('document_name', 45)->nullable();

            $table->unique(["document_id"], 'insurer_id_UNIQUE');
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
