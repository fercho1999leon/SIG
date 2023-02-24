<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParcialesColumnStudentTable extends Migration
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
                Asistencia
            */
            //Parcial 3 quimestre 1
            $table->integer('p3q1A')->unsigned()->nullable();
            $table->integer('p3q1FJ')->unsigned()->nullable();
            $table->integer('p3q1FI')->unsigned()->nullable();
            //Parcial 1 quimestre 2
            $table->integer('p1q2A')->unsigned()->nullable();
            $table->integer('p1q2FJ')->unsigned()->nullable();
            $table->integer('p1q2FI')->unsigned()->nullable();
            //Parcial 2 quimestre 2
            $table->integer('p2q2A')->unsigned()->nullable();
            $table->integer('p2q2FJ')->unsigned()->nullable();
            $table->integer('p2q2FI')->unsigned()->nullable();
            //Parcial 3 quimestre 2
            $table->integer('p3q2A')->unsigned()->nullable();
            $table->integer('p3q2FJ')->unsigned()->nullable();
            $table->integer('p3q2FI')->unsigned()->nullable();
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
			 //Parcial 3 quimestre 1
			 $table->dropColumn('p3q1A');
			 $table->dropColumn('p3q1FJ');
			 $table->dropColumn('p3q1FI');
			 //Parcial 1 quimestre 2
			 $table->dropColumn('p1q2A');
			 $table->dropColumn('p1q2FJ');
			 $table->dropColumn('p1q2FI');
			 //Parcial 2 quimestre 2
			 $table->dropColumn('p2q2A');
			 $table->dropColumn('p2q2FJ');
			 $table->dropColumn('p2q2FI');
			 //Parcial 3 quimestre 2
			 $table->dropColumn('p3q2A');
			 $table->dropColumn('p3q2FJ');
			 $table->dropColumn('p3q2FI');
		});
    }
}
