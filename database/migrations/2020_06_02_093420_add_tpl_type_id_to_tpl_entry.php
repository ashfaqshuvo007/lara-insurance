<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTplTypeIdToTplEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tpl_entry', function (Blueprint $table) {
            $table->string('tpl_type_id')->nullable()->after('insurer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tpl_entry', function (Blueprint $table) {
            //
        });
    }
}
