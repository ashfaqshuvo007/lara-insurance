<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlbanianNameToGreenCardType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('green_card_type', function (Blueprint $table) {
            $table->string('eng_name')->nullable()->after('name');
            $table->string('albanian_name')->nullable()->after('eng_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('green_card_type', function (Blueprint $table) {
            //
        });
    }
}
