<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('factura', function (Blueprint $table) {
            $table->renameColumn('idAdmin', 'idEmpresa');
            $table->foreign('idEmpresa')->references('id')->on('empresa');
            $table->foreign('idUsuario')->references('id')->on('usuario');
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
