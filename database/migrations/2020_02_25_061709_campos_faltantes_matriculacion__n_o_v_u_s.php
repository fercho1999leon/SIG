<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposFaltantesMatriculacionNOVUS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_profile', function (Blueprint $table) {
            $table->string('parentezco', 100)->nullable()->after('es_representante');
			$table->string('estudios', 100)->nullable()->after('parentezco');
            $table->string('religion', 100)->nullable()->after('estudios');
        });

        Schema::table('students2_profile_per_year', function (Blueprint $table) {
            $table->string('documentos_informacion', 255)->nullable();
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
            $table->dropColumn('parentezco');
            $table->dropColumn('estudios');
            $table->dropColumn('religion');
        });

        Schema::table('students2_profile_per_year', function (Blueprint $table) {
            $table->dropColumn('documentos_informacion');
        });
    }
}
