<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltertableEmpresaImpuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa', function (Blueprint $table) {
            $table->integer('iva')->after("baroRestaurante");
            $table->string('impuesto1',20)->after("iva");
            $table->integer('valorImpuesto1')->after("impuesto1");
            $table->string('impuesto2',20)->after("valorImpuesto1");
            $table->integer('valorImpuesto2')->after("impuesto2");
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
