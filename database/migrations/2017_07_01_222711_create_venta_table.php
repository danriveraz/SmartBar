<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->dateTime('hora');
            $table->string('estado');
            $table->integer('idFactura')->unsigned();;
            $table->foreign('idFactura')->references('id')->on('factura');
            $table->integer('idProducto')->unsigned();;
            $table->foreign('idProducto')->references('idProducto')->on('producto');
            $table->integer('idMesero')->unsigned();;
            $table->foreign('idMesero')->references('id')->on('usuario');
            $table->integer('idBartender')->unsigned();;
            $table->foreign('idBartender')->references('id')->on('usuario');
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
        Schema::drop('venta');
    }
}
