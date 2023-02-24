<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NuevosCamposParaTablaInstitutionYStudent2PearYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution', function (Blueprint $table) {
			$table->string('seguro_institucional_EI', 100)->nullable();
			$table->string('seguro_institucional_EGB', 100)->nullable();
			$table->string('seguro_institucional_BGU', 100)->nullable();
		});
		Schema::table('students2_profile_per_year', function (Blueprint $table) {
			$table->float('porcentaje_discapacidad')->nullable();
			$table->string('tipo_bloqueo', 100)->nullable();
			$table->string('codigo_empresa_electrica', 100)->nullable();
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
			$table->dropColumn('seguro_institucional_EI');
			$table->dropColumn('seguro_institucional_EGB');
			$table->dropColumn('seguro_institucional_BGU');
		});
		Schema::table('students2_profile_per_year', function (Blueprint $table) {
			$table->dropColumn('porcentaje_discapacidad');
			$table->dropColumn('tipo_bloqueo');
			$table->dropColumn('codigo_empresa_electrica');
		});
    }
}
