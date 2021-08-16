<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsurerPolicyIdToFullCasco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('full_casco', function (Blueprint $table) {
            $table->string('insurer_policy_id')->nullable()->after('full_casco_id');
            $table->string('variant_coverage')->nullable()->after('variant');
            $table->tinyInteger('status')->nullable()->after('price')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('full_casco', function (Blueprint $table) {
            //
        });
    }
}
