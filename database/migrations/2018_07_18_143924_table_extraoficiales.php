<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableExtraoficiales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extraoficiales', function (Blueprint $table) {
            $table->increments('id');
                
            $table->integer('adelantos');
            $table->integer('descuentos');
            $table->integer('bonificaciones');
            $table->date('fecha');

            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('usuario');

            $table->integer('idEmpresa')->unsigned();
            $table->foreign('idEmpresa')->references('id')->on('empresa');

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
        //
    }
}
