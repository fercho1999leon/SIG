<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idFactura')->unsigned();
            $table->integer('idPagoDetalle')->unsigned();
            $table->integer('cantidad');
            
            $table->foreign('idFactura')->references('id')->on('pagos_factura')
            ->onDelete('cascade')->nullable();

            $table->foreign('idPagoDetalle')->references('id')->on('pago_estudiante_detalles')
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
        Schema::dropIfExists('abonos');
    }
}
