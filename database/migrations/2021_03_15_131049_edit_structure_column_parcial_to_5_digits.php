<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditStructureColumnParcialTo5Digits extends Migration
{

    public function up()
    {
        Schema::table('comportamientoMateria', function (Blueprint $table) {
            $table->string('parcial', 5)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('comportamientoMateria', function (Blueprint $table) {
            $table->string('parcial', 4)->nullable()->change();
        });
    }
}
