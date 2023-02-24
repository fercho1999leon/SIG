<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeRenombraElCampoTransporteEnLaTablaStundets2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
            $table->dropColumn('transporte');
			$table->integer('transporte_id')->unsigned()->nullable()->after('seccion');
			$table->foreign('transporte_id')->references('id')->on('transportes');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students2', function (Blueprint $table) {
			$table->dropForeign(['transporte_id']);
			$table->dropColumn('transporte_id');
			$table->integer('transporte')->nullable()->after('seccion');
		});
    }
}
