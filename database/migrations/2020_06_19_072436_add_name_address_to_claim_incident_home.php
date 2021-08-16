<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameAddressToClaimIncidentHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim_incident_home', function (Blueprint $table) {
            $table->string('name_address')->nullable()->after('object_damages_can_checked');
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
            //
        });
    }
}
