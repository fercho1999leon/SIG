<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasAutorizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas_autorizadas', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nombres');
			$table->string('telefono_domicilio');
			$table->string('telefono_celular');
			$table->string('direccion');
			$table->string('ciudad');
			$table->integer('idPeriodo')->unsigned();
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
            $table->timestamps();
		});
		
		Schema::create('personas_autorizadas_estudiantes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('idPersonaAutorizada')->unsigned();
			$table->foreign('idPersonaAutorizada')->references('id')->on('personas_autorizadas')->onDelete('cascade');
			$table->integer('idEstudiante')->unsigned();
			$table->foreign('idEstudiante')->references('id')->on('students2')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::table('transportes', function (Blueprint $table) {
			$table->boolean('es_privado')->nullable()->default(false)->after('celular');
			$table->string('unidad')->nullable()->change();
			$table->string('ruta')->nullable()->change();
			$table->string('rutaDetalle')->nullable()->change();
			$table->string('placa')->nullable()->change();
		});

		Schema::table('students2_profile_per_year', function (Blueprint $table) {
			$table->boolean('se_va_solo')->nullable()->default(false)->after('retirado');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('personas_autorizadas_estudiantes');
		Schema::dropIfExists('personas_autorizadas');
		Schema::table('transportes', function (Blueprint $table) {
			$table->dropColumn('es_privado');
			$table->string('unidad')->nullable(false)->change();
			$table->string('ruta')->nullable(false)->change();
			$table->string('rutaDetalle')->nullable(false)->change();
			$table->string('placa')->nullable(false)->change();
		});

		Schema::table('students2_profile_per_year', function (Blueprint $table) {
			$table->dropColumn('se_va_solo');
		});
    }
}
