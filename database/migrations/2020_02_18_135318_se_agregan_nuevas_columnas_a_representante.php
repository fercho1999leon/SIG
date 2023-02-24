<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeAgreganNuevasColumnasARepresentante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_profile', function (Blueprint $table) {
			$table->string('profesion', 100)->nullable();
			$table->string('lugar_trabajo', 100)->nullable();
			$table->string('telefono_trabajo', 100)->nullable();
			$table->boolean('ex_alumno')->nullable();
			$table->date('fecha_promocion')->nullable();
			$table->date('fecha_ingreso')->nullable();
			$table->date('fecha_estado_migratorio')->nullable();
			$table->date('fecha_exp_pasaporte')->nullable();
			$table->date('fecha_caducidad_pasaporte')->nullable();
			$table->string('nacionalidad')->nullable();
		});
		
		// Retirando el modo estricto cuando un cliente se elimina y esta vinculaado a un estudiante
		DB::statement('ALTER TABLE `students2_profile_per_year`
		DROP FOREIGN KEY `students2_profile_per_year_idcliente_foreign`');
		DB::statement('ALTER TABLE `students2_profile_per_year`
		ADD CONSTRAINT `students2_profile_per_year_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`) ON DELETE SET NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_profile', function (Blueprint $table) {
			$table->dropColumn('profesion');
			$table->dropColumn('lugar_trabajo');
			$table->dropColumn('telefono_trabajo');
			$table->dropColumn('ex_alumno');
			$table->dropColumn('fecha_promocion');
			$table->dropColumn('fecha_ingreso');
			$table->dropColumn('fecha_estado_migratorio');
			$table->dropColumn('fecha_exp_pasaporte');
			$table->dropColumn('fecha_caducidad_pasaporte');
			$table->dropColumn('nacionalidad');
		});
		
		DB::statement('ALTER TABLE `students2_profile_per_year`
		DROP FOREIGN KEY `students2_profile_per_year_idcliente_foreign`');
		DB::statement('ALTER TABLE `students2_profile_per_year`
		ADD CONSTRAINT `students2_profile_per_year_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`) ON DELETE RESTRICT');
	}
}
