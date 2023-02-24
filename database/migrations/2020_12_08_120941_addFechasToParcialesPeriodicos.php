<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechasToParcialesPeriodicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcial_periodicos', function (Blueprint $table) {
            $table->date('fechaI');
            $table->date('fechaF');
            $table->integer('idPeriodo')->unsigned()->nullable();
            $table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parcial_periodicos', function (Blueprint $table) {
            $table->dropColumn('fechaI');
            $table->dropColumn('fechaF');
            $table->dropColumn('idPeriodo');
        });
    }
}
