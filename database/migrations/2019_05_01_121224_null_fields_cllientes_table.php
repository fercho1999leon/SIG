<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullFieldsCllientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function($table){
            $table->string('correo')->nullable()->change();
            $table->string('direccion')->nullable()->change();
            $table->string('telefono')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
			$table->string('correo')->nullable(false)->change();
            $table->string('direccion')->nullable(false)->change();
            $table->string('telefono')->nullable(false)->change();
		});
    }
}
