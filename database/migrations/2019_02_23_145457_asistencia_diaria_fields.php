<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AsistenciaDiariaFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistencia', function (Blueprint $table) {
            $table->integer('idCurso')->unsigned();
            $table->integer('idMateria')->unsigned();
            $table->integer('idSchedule')->unsigned();
            $table->integer('idEstudiante')->unsigned();
            $table->date('fecha');
            $table->string('estado');
            $table->text('observacion')->nullable();
            
            $table->foreign('idCurso')->references('id')->on('courses')
                ->onDelete('cascade')->nullable();
            $table->foreign('idMateria')->references('id')->on('matters')
                ->onDelete('cascade')->nullable();
            $table->foreign('idSchedule')->references('id')->on('courseschedules')
                ->onDelete('cascade')->nullable();
            $table->foreign('idEstudiante')->references('id')->on('students2')
                ->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistencia', function (Blueprint $table) {
            $table->dropforeign(['idCurso']);
            $table->dropforeign(['idMateria']);
            $table->dropforeign(['idSchedule']);
            $table->dropforeign(['idEstudiante']);
        });

        Schema::table('asistencia', function (Blueprint $table) {
            $table->dropColumn('idCurso');
            $table->dropColumn('idMateria');
            $table->dropColumn('idSchedule');
            $table->dropColumn('idEstudiante');
            $table->dropColumn('fecha');
            $table->dropColumn('estado');
            $table->dropColumn('observacion');
        });
    }
}
