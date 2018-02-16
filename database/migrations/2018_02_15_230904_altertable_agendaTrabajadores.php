<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltertableAgendaTrabajadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendatrabajadores', function ($table) {
            $table->dropColumn('fechaTrabajo');
            $table->integer('idEmpresa')->unsigned()->after('idUsuario');
            $table->foreign('idEmpresa')->references('id')->on('empresa')->onDelete('cascade');
            $table->integer('idSemana')->after('idEmpresa');
            $table->integer('lun')->after('idSemana');
            $table->integer('mar')->after('lun');
            $table->integer('mie')->after('mar');
            $table->integer('jue')->after('mie');
            $table->integer('vie')->after('jue');
            $table->integer('sab')->after('vie');
            $table->integer('dom')->after('sab');
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
