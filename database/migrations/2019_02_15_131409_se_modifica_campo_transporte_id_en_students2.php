<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeModificaCampoTransporteIdEnStudents2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
			$table->dropForeign(['transporte_id']);
			$table->dropColumn('transporte_id');
		});

        Schema::table('students2', function (Blueprint $table) {
			$table->integer('transporte_id')->unsigned()->nullable()->after('seccion');
			$table->foreign('transporte_id')->references('id')->on('transportes')->onDelete('set null');
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
		});
        Schema::table('students2', function (Blueprint $table) {
			$table->integer('transporte_id')->unsigned()->nullable()->after('seccion');
			$table->foreign('transporte_id')->references('id')->on('transportes');
		});
    }
}
