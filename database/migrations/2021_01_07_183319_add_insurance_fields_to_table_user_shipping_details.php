<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsuranceFieldsToTableUserShippingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_shipping_details', function (Blueprint $table) {
            $table->string('insurance_id')->nullable();
            $table->string('policy_name')->nullable();
            $table->string('offer_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_shipping_details', function (Blueprint $table) {
            //
        });
    }
}
