<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionesAulicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observaciones_aulicas', function (Blueprint $table) {
			$table->increments('id');
			$table->date('fecha')->nullable();
			$table->time('hora_inicio')->nullable();
			$table->time('hora_fin')->nullable();

			$table->integer('idAsignatura')->unsigned();
			$table->foreign('idAsignatura')->references('id')->on('matters')->onDelete('cascade');

			$table->string('grado',100)->nullable();
			$table->text('tema')->nullable();
			$table->text('objetivo')->nullable();
			$table->text('observaciones')->nullable();
			$table->text('recomendaciones')->nullable();
			$table->boolean('status')->default(false);

			$table->integer('idDocente')->unsigned();
			$table->foreign('idDocente')->references('id')->on('users')->onDelete('cascade');

			$table->integer('idInstitucion')->unsigned();
			$table->foreign('idInstitucion')->references('id')->on('institution')->onDelete('cascade');

			$table->integer('idUsuario')->unsigned();
			$table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade');
			
			$table->integer('idArchivo')->unsigned();
			$table->foreign('idArchivo')->references('id')->on('archivos_institucionales')->onDelete('cascade');
			
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
        Schema::dropIfExists('progreso_formativo');
    }
}
