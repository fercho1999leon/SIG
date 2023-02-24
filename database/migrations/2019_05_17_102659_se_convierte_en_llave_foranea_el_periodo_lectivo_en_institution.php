<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeConvierteEnLlaveForaneaElPeriodoLectivoEnInstitution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('institution', function (Blueprint $table) {
        $table->dropColumn('periodoLectivo');
      });
      
      Schema::table('institution', function (Blueprint $table) {
        $table->integer('periodoLectivo')->unsigned()->nullable();
        $table->foreign('periodoLectivo')->references('id')->on('periodo_lectivo');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('institution', function (Blueprint $table) {
			$table->dropForeign(['periodoLectivo']);
			$table->dropColumn('periodoLectivo');
		});

		Schema::table('institution', function (Blueprint $table) {
			$table->string('periodoLectivo', 12)->nullable();
		});
    }
}
