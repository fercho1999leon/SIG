<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForeignMessageDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages_detail', function (Blueprint $table) {
            Schema::table('messages_detail', function (Blueprint $table) {
				$table->dropForeign('messages_detail_id_from_foreign');
				$table->dropForeign('messages_detail_id_to_foreign');

				$table->foreign('id_from')->references('id')->on('users_profile')->onDelete('cascade')->change();
				$table->foreign('id_to')->references('id')->on('users_profile')->onDelete('cascade')->change();
			 });
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages_detail', function (Blueprint $table) {
		});
    }
}
