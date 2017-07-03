<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContieneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contiene', function (Blueprint $table) {

            $table->integer('idProducto')->unsigned();
            $table->foreign('idProducto')->references('idProducto')->on('producto');

            $table->integer('idInsumo')->unsigned();
            $table->foreign('idInsumo')->references('id')->on('insumo');

            $table->integer('cantidad');

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
