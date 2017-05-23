<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumo', function (Blueprint $table) {
            $table->increments('id');
            $table->String('idProveedor');
            $table->String('nombre');
            $table->integer('cantidadUnidad');
            $table->integer('precioUnidad');
            $table->integer('valorCompra');
            $table->integer('cantidadMedida');
            $table->String('tipo');
            $table->String('categoria');
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
        Schema::drop('insumo');
    }
}
