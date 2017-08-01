<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyInsumo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insumo', function (Blueprint $table) {
            $table->dropForeign(['idAdmin']);
        });
        Schema::table('insumo', function (Blueprint $table) {
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
