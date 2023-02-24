<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNumeromatriculaStudents2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
            $table->dropColumn('numeroMatricula');
		});
        
        Schema::table('students2', function (Blueprint $table) {
			$table->string('numeroMatricula')->nullable();
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
			$table->dropColumn('numeroMatricula');
		});
    }
}
