<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AjusteLectionary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectionaries', function (Blueprint $table) {
           
            $table->string('nombre', 250)->nullable()->after('idCurso');
            $table->enum('parcial', ['P1Q1', 'P2Q1', 'P3Q1', 'P1Q2', 'P2Q2', 'P3Q2'])->nullable()->after('adjuntos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectionaries', function (Blueprint $table) {
            
            $table->dropColumn('parcial');
            
        });
    }
}
