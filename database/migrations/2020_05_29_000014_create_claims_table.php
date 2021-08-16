<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'claims';

    /**
     * Run the migrations.
     * @table claims
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('claims_id',45)->nullable();
            $table->string('policy_id', 45);
            $table->string('insurer_id', 45);
            $table->string('claming_type', 45)->nullable();
            $table->string('settled_amount', 45)->nullable();
            $table->string('insurer_part', 45)->nullable();
            $table->string('our_part', 45)->nullable();
            $table->tinyInteger('status')->nullable();

            $table->unique(["claims_id"], 'claims_id_UNIQUE');
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
