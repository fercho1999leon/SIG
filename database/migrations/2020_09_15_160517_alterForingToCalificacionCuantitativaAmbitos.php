<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForingToCalificacionCuantitativaAmbitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::table('calificacion_cualitativa_ambitos', function (Blueprint $table) {
                $table->dropForeign('calificacion_cualitativa_ambitos_idstudent_foreign');
                
                $table->foreign('idStudent')->references('id')->on('students2_profile_per_year')->onDelete('cascade');
             });
             DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calificacion_cualitativa_ambitos', function (Blueprint $table) {
                $table->foreign('idStudent')->references('id')->on('students2')->onDelete('cascade');
             });
    }
}
