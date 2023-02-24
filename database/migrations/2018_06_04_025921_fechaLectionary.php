<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FechaLectionary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectionaries', function (Blueprint $table) {
           
            $table->date('fecha')->nullable()->after('idCurso');

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
            
            $table->dropColumn('fecha');
            
        });
    }
}
