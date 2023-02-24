<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            
            $table->integer('idCurso')->unsigned()->nullable();
            $table->integer('idMateria')->unsigned();
            $table->integer('idDocente')->unsigned()->nullable();
            $table->string('p1q1')->nullable();
            $table->string('p2q1')->nullable();
            $table->string('p3q1')->nullable();
            $table->string('p1q2')->nullable();
            $table->string('p2q2')->nullable();
            $table->string('p3q2')->nullable();
            
            //foreign keys
            $table->foreign('idCurso')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('idDocente')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idMateria')->references('id')->on('matters')->onDelete('cascade');

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
        //
          Schema::dropIfExists('supplies');
    }
}

