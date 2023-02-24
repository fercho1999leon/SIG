<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AjustesEstudiantes extends Migration
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
                Comportamiento
            */
            //Primer Quimestre
            $table->enum('p1q1C', ['A', 'B', 'C', 'D', 'E'])->nullable()->after('idRepresentante');
            $table->enum('p2q1C', ['A', 'B', 'C', 'D', 'E'])->nullable()->after('p1q1C');
            $table->enum('p3q1C', ['A', 'B', 'C', 'D', 'E'])->nullable()->after('p2q1C');
            //Segundo Quimestre
            $table->enum('p1q2C', ['A', 'B', 'C', 'D', 'E'])->nullable()->after('p3q1C');
            $table->enum('p2q2C', ['A', 'B', 'C', 'D', 'E'])->nullable()->after('p1q2C');
            $table->enum('p3q2C', ['A', 'B', 'C', 'D', 'E'])->nullable()->after('p2q2C');


            /*
                Observaciones
            */
            //Primer Quimestre
            $table->text('p1q1O')->nullable()->after('p3q2C');
            $table->text('p2q1O')->nullable()->after('p1q1O');
            $table->text('p3q1O')->nullable()->after('p2q1O');
            //Segundo Quimestre
            $table->text('p1q2O')->nullable()->after('p3q1O');
            $table->text('p2q2O')->nullable()->after('p1q2O');
            $table->text('p3q2O')->nullable()->after('p2q2O');


            /*
                Asistencia
            */
            //Parcial 1
            $table->integer('p1q1A')->unsigned()->nullable()->after('p3q2O');
            $table->integer('p1q1FJ')->unsigned()->nullable()->after('p1q1A');
            $table->integer('p1q1FI')->unsigned()->nullable()->after('p1q1FJ');
            //Parcial 2
            $table->integer('p2q1A')->unsigned()->nullable()->after('p1q1FI');
            $table->integer('p2q1FJ')->unsigned()->nullable()->after('p2q1A');
            $table->integer('p2q1FI')->unsigned()->nullable()->after('p2q1FJ');
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
                Comportamiento
            */
            //Primer Quimestre
            $table->dropColumn('p1q1C');
            $table->dropColumn('p2q1C');
            $table->dropColumn('p3q1C');
            //Segundo Quimestre
            $table->dropColumn('p1q2C');
            $table->dropColumn('p2q2C');
            $table->dropColumn('p3q2C');


            /*
                Observaciones
            */
            //Primer Quimestre
            $table->dropColumn('p1q1O');
            $table->dropColumn('p2q1O');
            $table->dropColumn('p3q1O');
            //Segundo Quimestre
            $table->dropColumn('p1q2O');
            $table->dropColumn('p2q2O');
            $table->dropColumn('p3q2O');


            /*
                Asistencia
            */
            //Parcial 1
            $table->dropColumn('p1q1A');
            $table->dropColumn('p1q1FJ');
            $table->dropColumn('p1q1FI');
            //Parcial 2
            $table->dropColumn('p2q1A');
            $table->dropColumn('p2q1FJ');
            $table->dropColumn('p2q1FI');

        });
    }
}
