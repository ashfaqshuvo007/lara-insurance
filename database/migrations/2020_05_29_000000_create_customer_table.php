<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'customer';

    /**
     * Run the migrations.
     * @table customer
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('customer_id', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->string('customer_type', 45)->nullable();
            $table->string('phone', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('address', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('zip', 45)->nullable();
            $table->tinyInteger('status')->nullable()->default('1');

            $table->unique(["customer_id"], 'customer_id_UNIQUE');
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
