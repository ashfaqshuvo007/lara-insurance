<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPolicyTypeToInsurerPolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurer_policy', function (Blueprint $table) {
            $table->string('policy_type',45)->after('policy_name')->nullable();
            $table->string('policy_sub_type',45)->after('policy_type')->nullable(); 
            $table->string('country',45)->after('policy_sub_type')->nullable();
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
