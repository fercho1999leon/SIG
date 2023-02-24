<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiasasistenciaCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_assistances', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('idCurso')->unsigned();
			$table->foreign('idCurso')->references('id')->on('courses')->onDelete('cascade');
			$table->string('parcial', 5)->nullable();
			$table->integer('asistencia')->default(0);
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
        Schema::dropIfExists('course_assistances');
    }
}
