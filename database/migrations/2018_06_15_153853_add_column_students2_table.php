<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStudents2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students2', function (Blueprint $table) {

            $table->integer('idProfile')->unsigned()->nullable();
            $table->foreign('idProfile')->references('id')->on('users_profile')->onDelete('cascade');
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
			$table->dropForeign(['idProfile']);
			$table->dropColumn('idProfile');
		});
    }
}
