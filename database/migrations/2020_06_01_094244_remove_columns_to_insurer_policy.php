<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsToInsurerPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurer_policy', function (Blueprint $table) {
            $table->dropColumn('policy_type');
            $table->dropColumn('policy_sub_type');
            $table->dropColumn('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurer_policy', function (Blueprint $table) {
            //
        });
    }
}
