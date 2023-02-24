<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudents2ProfilePerYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students2_profile_per_year', function (Blueprint $table) {
			$table->increments('id');
			$table->date('fecha_matriculacion')->nullable();
			$table->string('numero_matriculacion')->nullable();

			$table->integer('idCurso')->unsigned()->nullable();
			$table->foreign('idCurso')->references('id')->on('courses')->onDelete('SET NULL');

			$table->integer('idPeriodo')->unsigned();
			$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');

			$table->integer('idRepresentante')->unsigned()->nullable();
			$table->foreign('idRepresentante')->references('id')->on('users_profile')->onDelete('SET NULL');

			$table->integer('idStudent')->unsigned();
			$table->foreign('idStudent')->references('id')->on('students2')->onDelete('cascade');

			$table->integer('transporte_id')->unsigned()->nullable();
			$table->foreign('transporte_id')->references('id')->on('transportes')->onDelete('SET NULL');

			$table->integer('idCliente')->unsigned()->nullable();
			$table->foreign('idCliente')->references('id')->on('clientes');
			
			$table->string('tipo_matricula');
			$table->string('seccion');
			// Domicilio
			$table->string('ciudad_domicilio')->nullable();
			$table->string('direccion_domicilio')->nullable();
			$table->string('telefono_movil')->nullable();
			$table->string('tipo_vivienda')->nullable();
			$table->string('nacionalidad')->nullable();
			// Datos medicos
			$table->string('hospital')->nullable();
			$table->string('indicaciones')->nullable();
			$table->string('nombre_contacto_emergencia')->nullable();
			$table->string('movil_contacto_emergencia')->nullable();
			$table->string('ficha_medica')->nullable();
			$table->string('retirado')->default('NO');
			
            $table->timestamps();
		});
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students2_profile_per_year');
    }
}
