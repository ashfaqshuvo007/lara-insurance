<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportingTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'reporting';

    /**
     * Run the migrations.
     * @table reporting
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('report_id', 45)->nullable();
            $table->string('insurer_id', 45);
            $table->string('policy_id', 45);
            $table->string('claimed_paid', 45)->nullable();
            $table->string('method', 45)->nullable();
            $table->string('insurer_part', 45)->nullable();
            $table->string('our_part', 45)->nullable();
            $table->string('total', 45)->nullable();

            $table->unique(["report_id"], 'report_id_UNIQUE');
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
