<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->increments('idProveedor');
            $table->integer('idAdmin')->unsigned();
            $table->foreign('idAdmin')->references('id')->on('admin')
            ->onDelete('cascade');
            $table->String('nombre');
            $table->String('direccion');
            $table->String('telefono');
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
