<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('customer', function (Blueprint $table) {

            $table->dropColumn('name');
            $table->dropColumn('customer_type');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('status');
            $table->string('usersId')->nullable()->after('id');


         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
