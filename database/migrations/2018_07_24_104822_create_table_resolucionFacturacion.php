<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResolucionFacturacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolucionFacturacion', function (Blueprint $table) {
            $table->increments('id');
                
            $table->string('nresolucionFacturacion', 50);
            $table->string('imagenResolucionFacturacion');
            $table->integer('nInicio');
            $table->integer('nFinal');
            $table->string('prefijo', 20);
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
