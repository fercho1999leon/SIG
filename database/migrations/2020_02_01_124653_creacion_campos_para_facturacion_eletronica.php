<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionCamposParaFacturacionEletronica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution', function (Blueprint $table) {
			$table->string('razon_social')->nullable();
			$table->string('nombre_comercial')->nullable();
			$table->string('establecimiento')->nullable();
			$table->string('direccion_matriz')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('institution', function (Blueprint $table) {
			$table->dropColumn('razon_social');
			$table->dropColumn('nombre_comercial');
			$table->dropColumn('establecimiento');
			$table->dropColumn('direccion_matriz');
		});
    }
}
