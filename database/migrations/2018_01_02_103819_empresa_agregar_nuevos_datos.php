<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmpresaAgregarNuevosDatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('empresa', function (Blueprint $table) {
            $table->string('direccion')->after("telefono");
            $table->integer('nit')->after("nombreEstablecimiento");
            $table->string('nombreRepresentanteLegal')->after("nit");
            $table->string('cedulaRepresentanteLegal')->after("nombreEstablecimiento");
            $table->string('imagenResolucionFacturacion')->after("tipoRegimen");
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
