<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
			$table->increments('id');
			$table->string('seccion', 100);
			$table->integer('idUser')->unsigned();
			$table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
			$table->string('mensaje', 250);
			$table->string('ruta', 100);
			$table->boolean('leido')->default(false);
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
        Schema::dropIfExists('notificaciones');
    }
}
