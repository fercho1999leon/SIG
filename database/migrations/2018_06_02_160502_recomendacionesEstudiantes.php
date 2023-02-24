<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecomendacionesEstudiantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
            /*
                Recomendaciones
            */
            /*Primer Quimestre*/
            $table->text('p1q1R')->nullable()->after('p2q1FI');
            $table->text('p2q1R')->nullable()->after('p1q1R');
            $table->text('p3q1R')->nullable()->after('p2q1R');
            /*Segundo Quimestre*/
            $table->text('p1q2R')->nullable()->after('p3q1R');
            $table->text('p2q2R')->nullable()->after('p1q2R');
            $table->text('p3q2R')->nullable()->after('p2q2R');
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
            /*
                Recomendaciones
            */
            /*Primer Quimestre*/
            $table->dropColumn('p1q1R');
            $table->dropColumn('p2q1R');
            $table->dropColumn('p3q1R');
            /*Segundo Quimestre*/
            $table->dropColumn('p1q2R');
            $table->dropColumn('p2q2R');
            $table->dropColumn('p3q2R');
        });
    }
}
