<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimIncidentHome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_incident_home', function (Blueprint $table) {
            $table->id();
            $table->string('claim_incident_id')->unique()->nullable();
            $table->string('incident_datetime')->nullable();
            $table->string('policy_id')->nullable();
            $table->longText('object_destroyed')->nullable();
            $table->string('object_damages_can_checked')->nullable();
            $table->boolean('insured_objects_altered')->nullable();
            $table->boolean('did_alarm_worked')->nullable();
            $table->longText('meassure_to_minimise_damage')->nullable();
            $table->longText('claim_event_history_description')->nullable();
            $table->integer('repair_cost_building')->nullable();
            $table->integer('repair_cost_equipments')->nullable();
            $table->integer('total_indemnification_pretended')->nullable();
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
        Schema::dropIfExists('claim_incident_home');
    }
}
