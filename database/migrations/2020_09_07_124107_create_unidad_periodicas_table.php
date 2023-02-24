<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadPeriodicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_periodicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100);
            $table->string('identificador',10);
            $table->integer('idPeriodo')->unsigned();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
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
        Schema::dropIfExists('unidad_periodicas');
    }
}
