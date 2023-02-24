<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeModificaTablaDeberesParaBloquearTareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deberes', function (Blueprint $table) {
			$table->boolean('bloqueo')->after('idActividad')->default(true);
			$table->boolean('enviado')->after('idActividad')->default(false);
			$table->boolean('disabled')->after('idActividad')->default(true);
			$table->string('adjunto')->nullable()->change();
		});
        Schema::table('activities', function (Blueprint $table) {
			$table->boolean('recibirTareas')->default(false);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('deberes', function (Blueprint $table) {
			$table->dropColumn('bloqueo');
			$table->dropColumn('enviado');
			$table->dropColumn('disabled');
			$table->string('adjunto')->nullable(false)->change();
		});
		Schema::table('activities', function (Blueprint $table) {
			$table->dropColumn('recibirTareas');
		});
    }
}
