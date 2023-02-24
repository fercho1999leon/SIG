<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeExtiendeCaracteresEnCoportamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comportamiento', function (Blueprint $table) {
			DB::statement("ALTER TABLE `comportamiento`
			CHANGE COLUMN `parcial` `parcial` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `idStudent`");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comportamiento', function (Blueprint $table) {
			DB::statement("ALTER TABLE `comportamiento`
			CHANGE COLUMN `parcial` `parcial` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `idStudent`");
		});
    }
}
