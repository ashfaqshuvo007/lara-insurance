<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolicyTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'policy';

    /**
     * Run the migrations.
     * @table policy
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('policy_id',45)->nullable();
            $table->string('policy_number')->nullable();
            $table->string('policy_name', 45)->nullable();
            $table->string('policy_type')->nullable();
            $table->string('insurer_id', 45);
            $table->string('customer_id', 45);
            $table->string('insured_name', 45)->nullable();
            $table->string('prospect_name', 45)->nullable();
            $table->integer('premium')->nullable();
            $table->integer('premium_paid')->nullable();
            $table->string('offer', 45)->nullable();
            $table->string('object')->nullable();
            $table->date('start_date')->nullable();
            $table->string('validity_period', 45)->nullable();
            $table->string('variant', 45)->nullable();
            $table->string('previous_policy_no', 45)->nullable();
            $table->date('next_followup_date')->nullable();
            $table->integer('claiming_paid')->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('note')->nullable();
            $table->string('document', 45)->nullable();
            $table->binary('status')->nullable();
            $table->unique(["policy_id"], 'policy_id_UNIQUE');
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
