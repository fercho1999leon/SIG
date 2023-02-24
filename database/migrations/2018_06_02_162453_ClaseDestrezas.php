<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClaseDestrezas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasesdestrezas', function (Blueprint $table) {
            $table->increments('id');
            /*Primer Quimestre*/
            $table->integer('idDestrezas')->unsigned();
            $table->text('calificacion')->nullable();
            $table->text('observacion')->nullable();
            $table->enum('parcial', ['P1Q1', 'P2Q1', 'P3Q1', 'P1Q2', 'P2Q2', 'P3Q2'])->nullable();
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
        Schema::dropIfExists('clasesdestrezas');
    }
}
