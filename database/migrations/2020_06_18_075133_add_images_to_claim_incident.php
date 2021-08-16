<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToClaimIncident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim_incident', function (Blueprint $table) {
            $table->string('image_1')->nullable()->after('incident_location');
            $table->string('image_2')->nullable()->after('image_1');
            $table->string('image_3')->nullable()->after('image_2');
            $table->string('image_4')->nullable()->after('image_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_incident', function (Blueprint $table) {
            //
        });
    }
}
