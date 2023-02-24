<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdTransaccionToPagosFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos_factura', function (Blueprint $table) {
            $table->integer('idTransaccion')->unsigned()->nullable();
            $table->foreign('idTransaccion')->references('id')->on('historico_transacciones_en_lineas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos_factura', function (Blueprint $table) {
            $table->dropColumn('idTransaccion');
        });
    }
}
