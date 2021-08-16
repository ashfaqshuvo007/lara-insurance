<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillingFieldToUserShippingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_shipping_details', function (Blueprint $table) {
            $table->string('billing_id')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_surname')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone_number')->nullable();
            $table->string('billing_national_id')->nullable();
            $table->string('billing_company_name')->nullable();
            $table->string('billing_tax_office')->nullable();
            $table->string('billing_tax_no')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_town')->nullable();
            $table->string('billing_city')->nullable();
            $table->integer('billing_zipcode')->nullable();
            $table->string('billing_country')->nullable();
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
