<?php

use App\Institution;
use App\Traits\tablasIdPeriodo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RegularizarATodasLasTablasQueTenganSuIdPeriodoParaElCambioDePeriodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	use tablasIdPeriodo;
    public function up() {
		
		foreach ($this->tablasSinIdPeriodo() as $tabla) {
			Schema::table($tabla, function (Blueprint $table) {
				$table->integer('idPeriodo')->unsigned()->nullable();
				$table->foreign('idPeriodo')->references('id')->on('periodo_lectivo')->onDelete('cascade');
			});
		}

		Schema::table('students2', function (Blueprint $table) {
				$table->dropForeign(['idPeriodo']);
				$table->dropColumn('idPeriodo');
		});
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		
	}
}
