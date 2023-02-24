<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseschedules', function (Blueprint $table) {
            $table->increments('id');

            $table->time('horaInicio')->nullable();
            $table->time('horaFin')->nullable();
            $table->string('dia1')->nullable();
            $table->string('dia2')->nullable();
            $table->string('dia3')->nullable();
            $table->string('dia4')->nullable();
            $table->string('dia5')->nullable();
            $table->string('dia6')->nullable();
            $table->integer('idCurso')->nullable();

            /*Las llaves foraneas con la tabla curso*/
            
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
        Schema::dropIfExists('courseschedules');
    }
}
