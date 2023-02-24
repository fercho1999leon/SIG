<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CodigosRetenciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigos_retenciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detalle',300);
            $table->string('porcentajes',100);
            $table->string('campo_formulario',20);
            $table->string('codigo_anexo',5);
            $table->boolean('activo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

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
        Schema::dropIfExists('codigos_retenciones');
    }
}
