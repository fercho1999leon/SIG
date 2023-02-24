<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeAgregoAreaIdEnMatter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matters', function(Blueprint $table) {
			$table->integer('idArea')->unsigned()->nullable();
			$table->foreign('idArea')->references('id')->on('areas');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matters', function(Blueprint $table) {
			$table->dropForeign(['idArea']);
			$table->dropColumn('idArea');
		});
    }
}
