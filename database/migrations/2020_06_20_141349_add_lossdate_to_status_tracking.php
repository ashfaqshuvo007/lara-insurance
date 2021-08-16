<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLossdateToStatusTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_tracking', function (Blueprint $table) {
            //
            $table->dateTime('loss_date')->nullable()->after('status');
            $table->dateTime('date_submitted_broker')->nullable()->after('loss_date');
            $table->dateTime('settlement_date')->nullable()->after('date_submitted_broker');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('status_tracking', function (Blueprint $table) {
            //
        });
    }
}
