<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCaracteresToDestrezas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destrezas', function (Blueprint $table) {
             DB::statement("ALTER TABLE destrezas MODIFY nombre VARCHAR(250)");//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destrezas', function (Blueprint $table) {
            //
        });
    }
}
