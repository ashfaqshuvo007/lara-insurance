<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnsToHomePolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_policy', function (Blueprint $table) {
            $table->boolean('all')->nullable()->after('home_sub_type_id');
            $table->boolean('home_value')->nullable()->after('all');
            $table->string('price_of_villa')->nullable()->after('home_value');
            $table->string('price_of_aparment')->nullable()->after('price_of_villa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_policy', function (Blueprint $table) {
            //
        });
    }
}
