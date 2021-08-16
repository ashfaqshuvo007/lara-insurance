<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('MbrId')->nullable();
            $table->string('MerchantID')->nullable();
            $table->string('OrderId')->nullable();
            $table->string('PurchAmount')->nullable();
            $table->string('Currency')->nullable();
            $table->string('PayerTxnId')->nullable();
            $table->string('PayerAuthenticationCode')->nullable();
            $table->string('Lang')->nullable();
            $table->string('BonusAmount')->nullable();
            $table->string('AlphaCode')->nullable();
            $table->string('MrcName')->nullable();
            $table->string('CardHolderName')->nullable();
            $table->string('TxnResult')->nullable();
            $table->string('AuthCode')->nullable();
            $table->string('CardMask')->nullable();
            $table->string('ShippingNameSurname')->nullable();
            $table->string('ShippingEmail')->nullable();
            $table->string('ShippingAddress')->nullable();
            $table->string('ShippingCountry')->nullable();
            $table->string('ShippingCity')->nullable();
            $table->string('ShippingZipCode')->nullable();
            $table->string('BillingNameSurname')->nullable();
            $table->string('BillingEmail')->nullable();
            $table->string('BillingAddress')->nullable();
            $table->string('BillingCountry')->nullable();
            $table->string('BillingCity')->nullable();
            $table->string('BillingZipCode')->nullable();
            $table->string('BillingPhone')->nullable();
            $table->string('TransactionDate')->nullable();
            $table->string('RequestMerchantDomain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
