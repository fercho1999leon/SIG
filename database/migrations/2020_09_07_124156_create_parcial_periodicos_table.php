<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcialPeriodicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcial_periodicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100);
            $table->string('identificador',10)->nullable();
            $table->integer('idUnidad')->unsigned();
            $table->foreign('idUnidad')->references('id')->on('unidad_periodicas')->onDelete('cascade');
            $table->boolean('activo');
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
        Schema::dropIfExists('parcial_periodicos');
    }
}
