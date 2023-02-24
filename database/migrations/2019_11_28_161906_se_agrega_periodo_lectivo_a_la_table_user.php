<?php

use App\Institution;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeAgregaPeriodoLectivoALaTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
			$table->integer('idPeriodoLectivo')->unsigned()->nullable();
			$table->foreign('idPeriodoLectivo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
		Schema::table('users', function (Blueprint $table) {
			$table->dropForeign(['idPeriodoLectivo']);
			$table->dropColumn(['idPeriodoLectivo']);
		});
    }
}
