<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiosTablaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('usuario','nombreEstablecimiento') && Schema::hasColumn('usuario','metodoPago') && Schema::hasColumn('usuario','tipoRegimen') && Schema::hasColumn('usuario','baroRestaurante')) {
            Schema::table('usuario', function (Blueprint $table) {
                $table->dropColumn(['nombreEstablecimiento', 'metodoPago', 'tipoRegimen','baroRestaurante']);
            });
        }
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
