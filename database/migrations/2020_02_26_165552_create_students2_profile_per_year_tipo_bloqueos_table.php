<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudents2ProfilePerYearTipoBloqueosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students2_profile_per_year_tipo_bloqueos', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('idStudent')->unsigned();
			$table->foreign('idStudent')->references('id')->on('students2_profile_per_year')->onDelete('cascade');
			$table->integer('idBloqueo')->unsigned();
			$table->foreign('idBloqueo')->references('id')->on('tipo_bloqueos');
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
        Schema::dropIfExists('students2_profile_per_year_tipo_bloqueos');
    }
}
