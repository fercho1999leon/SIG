<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeAgregaCamposEnStudents2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
			$table->string('q1C', 2)->nullable();
			$table->string('q2C', 2)->nullable();
			$table->string('q1Obs', 500)->nullable();
			$table->string('q2Obs', 500)->nullable();
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
			$table->dropColumn('q1C');
			$table->dropColumn('q2C');
			$table->dropColumn('q1Obs');
			$table->dropColumn('q2Obs');
		});
    }
}
