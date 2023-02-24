<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeAgregaNuevaColumnaEnLeccionarEstudiantil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leccionario_estudiantil', function (Blueprint $table) {
			$table->string('adjunto', 100)->nullable()->after('parcial');
		});
		Schema::table('lectionaries', function (Blueprint $table) {
			$table->string('linkVideo', 100)->nullable()->after('adjuntos');
		});

		DB::statement("ALTER TABLE `lectionaries`
		CHANGE COLUMN `descripcion` `descripcion` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `nombre`,
		CHANGE COLUMN `observacion` `observacion` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `descripcion`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leccionario_estudiantil', function (Blueprint $table) {
			$table->dropColumn('adjunto');
		});
        Schema::table('lectionaries', function (Blueprint $table) {
			$table->dropColumn('linkVideo');
		});

		DB::statement("ALTER TABLE `lectionaries`
		CHANGE COLUMN `descripcion` `descripcion` VARCHAR(191) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `nombre`,
		CHANGE COLUMN `observacion` `observacion` VARCHAR(191) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `descripcion`");
    }
}
