<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClaveAccesoToPagosFactura extends Migration
{

    public function up()
    {
        Schema::table('pagos_factura', function (Blueprint $table) {
            $table->string('claveAcceso', 100)->after('numeroFactura')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pagos_factura', function (Blueprint $table) {
            $table->dropColumn('claveAcceso');
        });
    }
}
