<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnExamenesQuimestreConfiguracionesparcialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracionesparcial', function (Blueprint $table) {
           
            $table->date('exq1FI')->nullable();
            $table->date('exq1FF')->nullable();
            $table->date('exq2FI')->nullable();
            $table->date('exq2FF')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuracionesparcial', function (Blueprint $table) {
			$table->dropColumn('exq1FI');
			$table->dropColumn('exq1FF');
			$table->dropColumn('exq2FI');
			$table->dropColumn('exq2FF');
		});
    }
}
