<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('becas_descuentos', function (Blueprint $table) {           
            $table->dropColumn('tipo');
        });
		// DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Schema::table('becas_descuentos', function (Blueprint $table) {
            $table->string('tipo')->nullable();
            $table->string('tipo_pago')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('becas_descuentos', function (Blueprint $table) {
			$table->integer('idPago')->unsigned()->change();
			$table->integer('idEstudiante')->unsigned()->change();
			$table->string('tipo')->nullable(false)->change();
			$table->dropColumn('tipo_pago');
        });
    }
}
