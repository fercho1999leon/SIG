<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestrezasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destrezas', function (Blueprint $table) {
            $table->increments('id');
            /*Primer Quimestre*/
            $table->string('nombre', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('idMateria')->unsigned();
            $table->enum('grado', ['Inicial 1','Inicial 2','Primero'])->nullable();
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
        Schema::dropIfExists('destrezas');
    }
}
