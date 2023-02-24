<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeCambiaElTipoDeDatoEnParentezcoDatosPadres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datospadres', function (Blueprint $table) {
            DB::statement("ALTER TABLE `datospadres`
            CHANGE COLUMN `parentezco` `parentezco` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `movil`;");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datospadres', function (Blueprint $table) {
            DB::statement("ALTER TABLE `datospadres`
            CHANGE COLUMN `parentezco` `parentezco` ENUM('Padre','Madres') NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `movil`;");
        });
    }
}
