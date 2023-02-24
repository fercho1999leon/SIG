<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProrrogaPagoEstudianteDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pago_estudiante_detalles', function (Blueprint $table) {
            $table->integer('prorroga')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pago_estudiante_detalles', function (Blueprint $table) {
			$table->datetime('prorroga')->nullable()->change();
		});
    }
}
