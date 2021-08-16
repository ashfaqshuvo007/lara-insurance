<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryToPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('policy', function (Blueprint $table) {
            $table->string('delivery_address')->nullable()->after('policy_id');
            $table->date('delivery_date')->nullable()->after('delivery_address');
            $table->time('delivery_time')->nullable()->after('delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policy', function (Blueprint $table) {
            //
        });
    }
}
