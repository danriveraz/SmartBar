<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreEstablecimiento');
            $table->string('nombrePersona');
            $table->string('pais');
            $table->string('departamento');
            $table->string('ciudad');
            $table->date('fechaNacimiento');
            $table->string('metodoPago');
            $table->string('cedula')->unique();
            $table->string('sexo');
            $table->string('tipoRegimen');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('password');
            $table->boolean('estado');
            $table->boolean('confirmoEmail');
            $table->string('confirm_token', 100);
            $table->string('baroRestaurante');
            $table->rememberToken();
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
        Schema::drop('admin');
    }
}
