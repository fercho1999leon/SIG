<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('activities', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre',30);
            $table->string('descripcion',200)->nullable();
            $table->text('adjuntos')->nullable();
            $table->datetime('fechaInicio')->nullable();
            $table->datetime('fechaEntrega')->nullable();

            $table->integer('idInsumo')->unsigned();
            $table->foreign('idInsumo')->references('id')->on('supplies')->onDelete('cascade');
            $table->text('calificaciones')->nullable();

            $table->timestamps();
        });


      /*   Schema::create('activitystudent', function (Blueprint $table) {
            $table->integer('idStudent')->unsigned();
            $table->integer('idActivity')->unsigned();
            $table->decimal('calificacion')->nullable();

            $table->foreign('idStudent')->references('id')->on('students2')->onDelete('cascade');
            $table->foreign('idActivity')->references('id')->on('Activities')->onDelete('cascade');
            $table->nullableTimestamps();
            $table->engine = 'InnoDB';
            $table->primary(['idStudent', 'idActivity']);
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
        //Schema::dropIfExists('activitystudent');
    }
}
