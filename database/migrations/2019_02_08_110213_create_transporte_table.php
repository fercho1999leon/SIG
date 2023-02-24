<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('unidad', 100);
			$table->string('ruta', 1000);
			$table->string('placa', 10);
			$table->string('chofer', 255);
			$table->string('correo', 100)->nullable();
			$table->string('celular', 100);
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transportes');
    }
}
