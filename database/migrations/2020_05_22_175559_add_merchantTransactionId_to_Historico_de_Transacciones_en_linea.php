<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMerchantTransactionIdToHistoricoDeTransaccionesEnLinea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('historico_transacciones_en_lineas', function (Blueprint $table) {
    $table->string('MerchantTransactionId_DF', 10)->nullable();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('historico_transacciones_en_lineas', function (Blueprint $table) {            
        $table->dropColumn('MerchantTransactionId_DF');
        });
    }
}
