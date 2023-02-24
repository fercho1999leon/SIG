<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMedicalInfoPusersProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_profile', function (Blueprint $table) {           
           $table->text('enfermedad')->nullable();           
           $table->text('observacion')->nullable();           
           $table->string('numero_emergencia')->nullable();           
           $table->string('grupo_sanguineo')->nullable();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_profile', function (Blueprint $table) {
            $table->dropColumn('enfermedad');
            $table->dropColumn('observacion');
            $table->dropColumn('numero_emergencia');
            $table->dropColumn('grupo_sanguineo');
        });
    }
}
