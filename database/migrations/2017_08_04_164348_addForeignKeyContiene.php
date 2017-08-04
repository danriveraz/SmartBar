<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyContiene extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contiene', function (Blueprint $table) {
            $table->dropForeign(['idAdmin']);
            $table->renameColumn('idAdmin', 'idEmpresa');
            $table->foreign('idEmpresa')->references('id')->on('empresa')
            ->onDelete('cascade');
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
