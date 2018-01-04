<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Agregar un tabla cliente con: Nombre, Telefono, Email, Nit, dirección
         Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('nit');
            $table->string('telefono');
            $table->string('email');
            $table->integer('direccion');
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
