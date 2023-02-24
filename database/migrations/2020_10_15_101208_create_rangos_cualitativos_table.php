<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangosCualitativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rangos_cualitativos', function (Blueprint $table) {
            $table->increments('id');
            $table->float('rangoI');
            $table->float('rangoF');
            $table->string('nota', 20);
            $table->string('descripcion')->nullable();
            $table->integer('idEstructura')->unsigned();
            $table->foreign('idEstructura')->references('id')->on('estructura_cualitativas')->onDelete('cascade');
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
        Schema::dropIfExists('rangos_cualitativos');
    }
}
