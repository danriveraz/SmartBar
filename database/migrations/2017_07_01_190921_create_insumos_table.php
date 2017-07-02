<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idProveedor')->unsigned();
            $table->foreign('idProveedor')->references('idProveedor')->on('proveedor');

            $table->string('nombre');
            $table->integer('cantidadUnidad');
            $table->integer('precioUnidad');
            $table->integer('valorCompra');
            $table->double('cantidadMedida');
            $table->string('tipo');

            $table->integer('idAdmin')->unsigned();
            $table->foreign('idAdmin')->references('id')->on('admin');
            
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
