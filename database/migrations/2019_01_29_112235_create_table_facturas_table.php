<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_factura', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('idCliente')->unsigned();
			$table->integer('idUsuario')->unsigned();
			$table->float('subtotal');
			$table->float('total');
			$table->dateTime('fecha')->nullable();
            $table->timestamps();
            
            $table->foreign('idCliente')->references('id')->on('clientes')
            ->onDelete('cascade')->nullable();

            $table->foreign('idUsuario')->references('id')->on('users_profile')
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
        Schema::dropIfExists('pagos_factura');
    }
}
