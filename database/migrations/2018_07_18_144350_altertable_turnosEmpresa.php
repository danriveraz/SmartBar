<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltertableTurnosEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa', function (Blueprint $table) {

            $table->boolean('diurno')->after("nFinal");
            $table->string('inicioDiurno', 20)->after("diurno");
            $table->string('finDiurno', 20)->after("inicioDiurno");

            $table->boolean('nocturno')->after("finDiurno");
            $table->string('inicioNocturno', 20)->after("nocturno");
            $table->string('finNocturno', 20)->after("inicioNocturno");

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
