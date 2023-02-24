<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierreParcialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracionesparcial', function (Blueprint $table) {
            $table->increments('id');
            /*Primer Quimestre*/
            $table->date('p1q1FI')->nullable();
            $table->date('p1q1FF')->nullable();
            $table->date('p2q1FI')->nullable();
            $table->date('p2q1FF')->nullable();
            $table->date('p3q1FI')->nullable();
            $table->date('p3q1FF')->nullable();

            /*Segundo Quimestre*/
            $table->date('p1q2FI')->nullable();
            $table->date('p1q2FF')->nullable();
            $table->date('p2q2FI')->nullable();
            $table->date('p2q2FF')->nullable();
            $table->date('p3q2FI')->nullable();
            $table->date('p3q2FF')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracionesparcial');
    }
}
