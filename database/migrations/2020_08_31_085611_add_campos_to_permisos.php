<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposToPermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permisos', function (Blueprint $table) {
            $table->boolean('imprimir')->after('ver')->nullable();
            $table->boolean('eliminar')->after('ver')->nullable();
            $table->boolean('editar')->after('ver')->nullable();
            //
        });
    }
   /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permisos', function (Blueprint $table) {
            $table->dropColumn('editar');
            $table->dropColumn('eliminar');
            $table->dropColumn('imprimir');
            //
        });
    }
}
