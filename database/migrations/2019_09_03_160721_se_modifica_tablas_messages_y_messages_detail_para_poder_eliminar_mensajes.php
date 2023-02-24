<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeModificaTablasMessagesYMessagesDetailParaPoderEliminarMensajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
			$table->boolean('eliminado')->after('adjunto')->default(false);
		});
		Schema::table('messages_detail', function (Blueprint $table) {
			$table->boolean('eliminado')->after('visto')->default(false);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
			$table->dropColumn('eliminado');
		});
		Schema::table('messages_detail', function (Blueprint $table) {
			$table->dropColumn('eliminado');
		});
    }
}
