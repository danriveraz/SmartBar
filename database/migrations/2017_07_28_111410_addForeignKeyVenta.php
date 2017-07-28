<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('venta', function (Blueprint $table) {
            $table->integer('idCajero')->unsigned()->after('idBartender');
            $table->foreign('idMesero')->references('id')->on('usuario');
            $table->foreign('idBartender')->references('id')->on('usuario');
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
