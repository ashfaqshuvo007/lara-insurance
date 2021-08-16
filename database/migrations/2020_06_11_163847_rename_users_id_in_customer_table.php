<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUsersIdInCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            Schema::table('customer', function (Blueprint $table) {
                //
                $table->renameColumn('userId', 'user_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            //
            Schema::table('customer', function (Blueprint $table) {
                //
                $table->renameColumn('user_id', 'userId');

            });
        });
    }
}
