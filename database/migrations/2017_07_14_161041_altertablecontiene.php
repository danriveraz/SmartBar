<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Altertablecontiene extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contiene', function ($table) {
            $table->dropColumn('cantidad');
        });

        Schema::table('contiene', function ($table) {
            $table->Double('cantidad')->after('idInsumo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
