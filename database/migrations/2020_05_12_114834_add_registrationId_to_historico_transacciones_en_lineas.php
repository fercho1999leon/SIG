<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistrationIdToHistoricoTransaccionesEnLineas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historico_transacciones_en_lineas', function (Blueprint $table) {
    $table->string('registrationId', 50)->nullable();
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
        $table->dropColumn('registrationId');
        });
    }
}
