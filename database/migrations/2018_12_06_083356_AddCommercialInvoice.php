<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommercialInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution', function (Blueprint $table) {
            $table->string('ruc', 100)->nullable();
            $table->string('responsableFactura', 255)->nullable();
            $table->string('autorizacionSRI', 100)->nullable();
            $table->date('fechaAutorizacion')->nullable();       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institution', function (Blueprint $table) {
            $table->dropColumn('ruc');
            $table->dropColumn('responsableFactura');
            $table->dropColumn('autorizacionSRI');
            $table->dropColumn('fechaAutorizacion');
        });
    }
}
