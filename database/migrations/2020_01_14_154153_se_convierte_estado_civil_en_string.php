<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeConvierteEstadoCivilEnString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datospadres', function (Blueprint $table) {
			$table->dropColumn('estado_civil');
		});
        Schema::table('datospadres', function (Blueprint $table) {
			$table->string('estado_civil')->nullable()->after('fallecido');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('datospadres', function (Blueprint $table) {
			$table->dropColumn('estado_civil');
		});
		Schema::table('datospadres', function (Blueprint $table) {
			$table->integer('estado_civil')->default(false);
		});
    }
}
