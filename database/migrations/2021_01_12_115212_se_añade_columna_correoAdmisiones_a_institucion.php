<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeAñadeColumnaCorreoAdmisionesAInstitucion extends Migration
{

    public function up()
    {
        Schema::table('institution', function (Blueprint $table) {
            $table->string('correoAdmisiones')->nullable();
        });
    }

    public function down()
    {
        Schema::table('parcial_periodicos', function (Blueprint $table) {
            $table->dropColumn('correoAdmisiones');
        });
    }
}
