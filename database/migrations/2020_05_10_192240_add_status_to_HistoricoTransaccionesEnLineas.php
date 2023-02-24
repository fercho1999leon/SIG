<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToHistoricoTransaccionesEnLineas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('historico_transacciones_en_lineas', function (Blueprint $table) {
    $table->string('shopper_interes_DF', 50)->nullable();
    $table->string('shopper_gacia_DF', 50)->nullable();
    $table->string('numero_diferido_DF', 50)->nullable();
    $table->string('status', 50)->nullable();
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
            $table->dropColumn('shopper_interes_DF');
            $table->dropColumn('shopper_gacia_DF');
            $table->dropColumn('numero_diferido_DF');
            $table->dropColumn('status');
        });
    }
}
