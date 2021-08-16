<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimIncident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_incident', function (Blueprint $table) {
            $table->id();
            $table->string('claim_incident_id')->nullable();
            $table->string('incident_datetime')->nullable();
            $table->string('incident_location')->nullable();
            $table->string('policy_id')->nullable();
            $table->unique(["claim_incident_id"]);
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
        Schema::dropIfExists('claim_incident');
    }
}
