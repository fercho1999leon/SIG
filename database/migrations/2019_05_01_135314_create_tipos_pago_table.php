<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_pago', function (Blueprint $table) {
			$table->increments('id');
            
            $table->string('tipo_pago')->nullable();
			$table->string('banco')->nullable();
            $table->string('nombre_tarjeta')->nullable();
			$table->string('numero_descripcion')->nullable();
            $table->integer('idFactura')->unsigned()->nullable();
            $table->integer('idRecibo')->unsigned()->nullable();

            $table->foreign('idFactura')->references('id')->on('pagos_factura')
            ->onDelete('cascade')->nullable();

            $table->foreign('idRecibo')->references('id')->on('abonos')
            ->onDelete('cascade')->nullable();

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
        Schema::dropIfExists('tipos_pago');
    }
}
