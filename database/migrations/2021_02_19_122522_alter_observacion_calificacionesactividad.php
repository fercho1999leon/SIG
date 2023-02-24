<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterObservacionCalificacionesactividad extends Migration
{

    public function up()
    {
        Schema::table('calificacionesactividad', function (Blueprint $table) {
            $table->string('observacion', 2000)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('calificacionesactividad', function (Blueprint $table) {
            $table->string('observacion', 2000)->default('-')->after('id')->change();
        });
    }
}
