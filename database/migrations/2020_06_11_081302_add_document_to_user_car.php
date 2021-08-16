<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentToUserCar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_car', function (Blueprint $table) {
            $table->string('document_image_1')->nullable()->after('production_year');
            $table->string('document_image_2')->nullable()->after('document_image_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_car', function (Blueprint $table) {
            //
        });
    }
}
