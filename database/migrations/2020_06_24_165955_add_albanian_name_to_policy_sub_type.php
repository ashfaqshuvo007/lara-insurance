<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlbanianNameToPolicySubType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('policy_sub_type', function (Blueprint $table) {
            $table->string('albanian_name')->nullable()->after('name');
            $table->string('eng_name')->nullable()->after('albanian_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policy_sub_type', function (Blueprint $table) {
            //
        });
    }
}
