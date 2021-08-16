<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsurerPolicyIdToTplEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tpl_entry', function (Blueprint $table) {
            $table->string('insurer_policy_id')->nullable()->after('tpl_entry_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tpl_entry', function (Blueprint $table) {
            //
        });
    }
}
