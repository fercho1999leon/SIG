<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeAgregaColumnasFaltantesEnArchivosInstitucionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archivos_institucionales', function (Blueprint $table) {
			$table->string('adjunto', 50)->nullable()->after('id');
			$table->string('descripcion', 2000)->nullable()->after('id');
			$table->string('acceso', 20)->after('id');
			$table->string('categoria', 100)->after('id');
			$table->string('nombre', 100)->after('id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archivos_institucionales', function (Blueprint $table) {
			$table->dropColumn('nombre');
			$table->dropColumn('categoria');
			$table->dropColumn('acceso');
			$table->dropColumn('descripcion');
			$table->dropColumn('adjunto');
		});
    }
}
