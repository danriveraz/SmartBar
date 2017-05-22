<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id');
        		$table->string('nombre');
        		$table->string('numeroIdentificacion');
        		$table->string('contraseña');
        		$table->string('sexo');
        		$table->date('fechaNacimiento');
        		$table->boolean('tipoMesero');
        		$table->boolean('tipoBartender');
        		$table->boolean('tipoCajero');
            $table->integer('idAdmin');
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
        Schema::drop('usuario');
    }
}
