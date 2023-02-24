<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditParcialToClasesdestrezas extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE `clasesdestrezas`
        CHANGE COLUMN `parcial` `parcial` ENUM('P1Q1','P2Q1','P3Q1','EXQ1','P1Q2','P2Q2','P3Q2','EXQ2','Q1','Q2','ANUAL') NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `observacion`;");
    }

    public function down()
    {
        DB::statement("ALTER TABLE `clasesdestrezas`
        CHANGE COLUMN `parcial` `parcial` ENUM('P1Q1','P2Q1','P3Q1','EXQ1','P1Q2','P2Q2','P3Q2','EXQ2') NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `observacion`;");
    }
}
