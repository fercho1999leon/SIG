<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CodigosInstitucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution', function (Blueprint $table) { 
            $table->integer('coordinacionZonal')->nullable();
            $table->string('distrito', 10)->nullable();
            $table->string('codigoAmie', 10)->nullable();
            //Autoridades
            $table->string('representante3', 100)->nullable();
            $table->string('cargo3', 100)->nullable();
            $table->string('representante4', 100)->nullable();
            $table->string('cargo4', 100)->nullable();
            $table->string('representante5', 100)->nullable();
            $table->string('cargo5', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('institution', function (Blueprint $table) {
			$table->dropColumn('coordinacionZonal');
			$table->dropColumn('distrito');
			$table->dropColumn('codigoAmie');
			$table->dropColumn('representante3');
			$table->dropColumn('cargo3');
			$table->dropColumn('representante4');
			$table->dropColumn('cargo4');
			$table->dropColumn('representante5');
			$table->dropColumn('cargo5');
		});
    }
}
