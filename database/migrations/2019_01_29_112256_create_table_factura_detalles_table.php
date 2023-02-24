<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFacturaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_detalles', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('idCliente')->unsigned();
            $table->integer('idPagoDetalle')->unsigned();
            $table->integer('idEstudiante')->unsigned();
			$table->integer('idFactura')->unsigned();
			$table->float('subtotal');
			$table->float('total');
            $table->timestamps();
            
            $table->foreign('idCliente')->references('id')->on('clientes')
            ->onDelete('cascade')->nullable();

            $table->foreign('idPagoDetalle')->references('id')->on('pago_estudiante_detalles')
            ->onDelete('cascade')->nullable();

            $table->foreign('idEstudiante')->references('id')->on('students2')
            ->onDelete('cascade')->nullable();

            $table->foreign('idFactura')->references('id')->on('pagos_factura')
            ->onDelete('cascade')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_detalles');
    }
}
