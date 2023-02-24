<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposMatters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matters', function (Blueprint $table) { 
            $table->string('nombre_abreviado', 100)->nullable()->after('area');
            $table->string('observacion', 1000)->nullable()->after('nombre_abreviado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matters', function (Blueprint $table) {
            $table->dropColumn('nombre_abreviado');
            $table->dropColumn('observacion');
        });
    }
}
