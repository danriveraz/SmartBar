<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadosVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('venta', function ($table) {
            $table->renameColumn('estado', 'estadoMesero');
            $table->string('estadoBartender')->after('estado');
            $table->string('estadoCajero')->after('estadoBartender');
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
