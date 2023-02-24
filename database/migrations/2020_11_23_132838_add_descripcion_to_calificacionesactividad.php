<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescripcionToCalificacionesactividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calificacionesactividad', function (Blueprint $table) {
            $table->string('observacion', 2000)->default('-')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calificacionesactividad', function (Blueprint $table) {
            $table->dropColumn('observacion');
        });
    }
}
