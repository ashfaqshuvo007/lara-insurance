<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurerPolicyTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'insurer_policy';

    /**
     * Run the migrations.
     * @table insurer_policy
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('insurer_policy_id', 45)->nullable();
            $table->string('policy_sub_type_id', 45);
            $table->string('insurer_id', 45);
            $table->string('policy_name', 45)->nullable();
            $table->string('commission', 45)->nullable();
            $table->string('status', 45)->nullable();

            $table->unique(["insurer_policy_id"], 'insurer_policy_id_UNIQUE');
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
