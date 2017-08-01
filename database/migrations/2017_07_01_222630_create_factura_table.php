<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado');
            $table->integer('total');
            $table->dateTime('fecha');
            $table->integer('idAdmin')->unsigned();
            $table->foreign('idAdmin')->references('id')->on('admin');
            $table->integer('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('id')->on('usuario');
            $table->integer('idMesa')->unsigned();
            $table->foreign('idMesa')->references('id')->on('mesa');
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
        Schema::drop('factura');
    }
}
