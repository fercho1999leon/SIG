<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionCampoValorPagosRealizados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos_realizados', function (Blueprint $table) {
            $table->float('total')->nullable()->after('descripcion');
            $table->integer('plazo')->nullable()->after('total');
            $table->string('unidad_tiempo',25)->nullable()->after('plazo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
