<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActDesdeAdmisionesToStudents2ProfilePerYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2_profile_per_year', function (Blueprint $table) {
            $table->integer('actDesdeAdmisiones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students2_profile_per_year', function (Blueprint $table) {
            $table->dropColumn('actDesdeAdmisiones');
        });
    }
}
