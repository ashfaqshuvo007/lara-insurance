<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('user_id', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->string('phone', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
            $table->string('remember_token')->nullable();
            $table->string('user_type', 45)->nullable();
            $table->string('profile_image')->nullable();

            $table->unique(["user_id"], 'user_id_UNIQUE');
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
