<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksPerAreaGrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_per_area_grade', function (Blueprint $table) {
            $table->increments('id');

            $table->string('grado',100);
            $table->integer('idAdditionalBook')->unsigned();
            $table->foreign('idAdditionalBook')->references('id')->on('additional_books')->onDelete('cascade');
            $table->integer('idArea')->unsigned();
            $table->foreign('idArea')->references('id')->on('areas')->onDelete('cascade');
            $table->integer('idPeriodo')->unsigned();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
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
        Schema::dropIfExists('books_per_area_grade');
    }
}
