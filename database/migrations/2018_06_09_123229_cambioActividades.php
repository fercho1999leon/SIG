<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('nombre', 100)->change();
            $table->text('descripcion')->change();
            $table->date('fechaInicio')->change();
            $table->date('fechaEntrega')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
			$table->string('nombre',30)->change();
            $table->string('descripcion',200)->nullable()->change();
			$table->datetime('fechaInicio')->nullable()->change();
            $table->datetime('fechaEntrega')->nullable()->change();
        });

    }
}
