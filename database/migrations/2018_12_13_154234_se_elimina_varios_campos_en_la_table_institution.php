<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeEliminaVariosCamposEnLaTableInstitution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution', function (Blueprint $table) {
			$table->dropColumn('areaDelRepresentante');
			$table->dropColumn('areaDeFirma');
			$table->dropColumn('etiqueta');
			$table->dropColumn('cabecera1');
			$table->dropColumn('cabecera2');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->string('areaDelRepresentante')->nullable();
			$table->string('areaDeFirma')->nullable();
			$table->string('etiqueta')->nullable();
			$table->string('cabecera1')->nullable();
			$table->string('cabecera2')->nullable();
		});
    }
}
