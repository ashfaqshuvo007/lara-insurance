<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncidentDatetimeToClaimIncidentHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim_incident_home', function (Blueprint $table) {
            $table->dropColumn('incident_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_incident_home', function (Blueprint $table) {
            $table->dateTime('incident_datetime')->nullable()->after('claim_incident_id');
        });
    }
}
