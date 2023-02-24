<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('matters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('nInsumos')->nullable();
            $table->integer('idCurso')->unsigned();
            $table->string('idInsumos',255)->nullable();
            $table->integer('idDocente')->unsigned()->nullable();
            $table->string('p1q1')->nullable();
            $table->string('p2q1')->nullable();
            $table->string('p3q1')->nullable();
            $table->string('p1q2')->nullable();
            $table->string('p2q2')->nullable();
            $table->string('p3q2')->nullable();
            $table->string('exq1')->nullable();
            $table->string('exq2')->nullable();
            $table->string('q1')->nullable();
            $table->string('q2')->nullable();
            $table->string('promedio')->nullable();

            //Foreign keys
            $table->foreign('idCurso')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('idDocente')->references('id')->on('users')->onDelete('cascade');
            
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
          Schema::dropIfExists('matters');
    }
}
