<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AhoraLosCamposDeFacturacionANivelDeBasoDeDatosPuedenSerNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
			DB::statement("ALTER TABLE `students2`
			CHANGE COLUMN `identificacion` `identificacion` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `ficha_medica`,
			CHANGE COLUMN `numero_identificacion` `numero_identificacion` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `identificacion`,
			CHANGE COLUMN `facturacion_apellidos` `facturacion_apellidos` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `numero_identificacion`,
			CHANGE COLUMN `facturacion_nombres` `facturacion_nombres` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `facturacion_apellidos`");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('students2', function (Blueprint $table) {
			DB::statement("ALTER TABLE `students2`
			CHANGE COLUMN `identificacion` `identificacion` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `ficha_medica`,
			CHANGE COLUMN `numero_identificacion` `numero_identificacion` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `identificacion`,
			CHANGE COLUMN `facturacion_apellidos` `facturacion_apellidos` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `numero_identificacion`,
			CHANGE COLUMN `facturacion_nombres` `facturacion_nombres` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `facturacion_apellidos`");
		});
    }
}
