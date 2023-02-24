<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NivelIngles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {
           
            $table->enum('nivelDeIngles', ['Regular', 'Intensivo'])->nullable()->after('seccion');

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
            
            $table->dropColumn('nivelDeIngles');
            
        });
    }
}
