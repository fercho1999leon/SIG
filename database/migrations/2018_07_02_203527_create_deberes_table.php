<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeberesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deberes', function (Blueprint $table) {            
            $table->increments('id');
            $table->integer('idProfesor')->unsigned();
            $table->integer('idEstudiante')->unsigned();
            $table->integer('idActividad')->unsigned();
            $table->string('adjunto');
            $table->timestamps();

            $table->foreign('idProfesor')->references('id')->on('users_profile')->onDelete('cascade');
            $table->foreign('idActividad')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('idEstudiante')->references('id')->on('students2')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deberes');
    }
}
