<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLectionaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectionaries', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idMateria')->nullable();
            $table->integer('idCurso')->unsigned();
            $table->string('descripcion')->nullable();
            $table->string('observacion')->nullable();
            $table->text('adjuntos')->nullable();
            
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
        Schema::dropIfExists('lectionaries');
    }
}
