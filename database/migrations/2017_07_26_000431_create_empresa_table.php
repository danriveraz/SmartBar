<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreEstablecimiento');
            $table->string('pais');
            $table->string('departamento');
            $table->string('ciudad');
            $table->string('metodoPago');
            $table->string('tipoRegimen');
            $table->string('telefono');
            $table->boolean('estado');
            $table->string('baroRestaurante');
            $table->integer('usuario_id')->unsigned();
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
        Schema::drop('empresa');
    }
}
