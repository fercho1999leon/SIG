<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoTransaccionesEnLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_transacciones_en_lineas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaccion', 50)->nullable();
            $table->string('codigo_error', 15)->nullable();
            $table->string('descripcion_error', 150)->nullable();
            $table->float('total');
            $table->string('AuthCode_DF', 10)->nullable();
            $table->string('ReferenceNbr_DF', 15)->nullable();
            $table->string('ArquirerResponse_DF', 15)->nullable();
            $table->string('customParameters_DF', 150)->nullable();
            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('clientes')->nullable();
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
        Schema::dropIfExists('historico_transacciones_en_lineas');
    }
}
