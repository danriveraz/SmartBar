<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropHorariosEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa', function (Blueprint $table) {

            $table->dropColumn('diurno');
            $table->dropColumn('inicioDiurno');
            $table->dropColumn('finDiurno');

            $table->dropColumn('nocturno');
            $table->dropColumn('inicioNocturno');
            $table->dropColumn('finNocturno');

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
