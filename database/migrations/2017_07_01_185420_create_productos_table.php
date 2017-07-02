<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('idProducto');
            $table->String('nombre');

            $table->integer('idAdmin')->unsigned();
            $table->foreign('idAdmin')->references('id')->on('admin')
            ->onDelete('cascade');

            $table->integer('idCategoria')->unsigned();
            $table->foreign('idCategoria')->references('idCategoria')->on('categoria')
            ->onDelete('cascade');

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
