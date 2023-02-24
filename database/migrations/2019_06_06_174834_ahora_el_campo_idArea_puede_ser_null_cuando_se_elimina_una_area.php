<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AhoraElCampoIdAreaPuedeSerNullCuandoSeEliminaUnaArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matters', function (Blueprint $table) {
			$table->dropForeign(['idArea']);
			$table->foreign('idArea')->references('id')->on('areas')->onDelete('SET NULL');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('matters', function (Blueprint $table) {
			$table->dropForeign(['idArea']);
			$table->foreign('idArea')->references('id')->on('areas');
		});
    }
}
