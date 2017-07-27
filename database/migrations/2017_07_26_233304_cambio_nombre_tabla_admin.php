<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioNombreTablaAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('factura', function (Blueprint $table) {
            $table->dropForeign(['idUsuario']);
        });
        Schema::table('venta', function (Blueprint $table) {
            $table->dropForeign(['idMesero']);
            $table->dropForeign(['idBartender']);
        });
        Schema::drop('usuario');
        Schema::rename('admin', 'usuario');
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
