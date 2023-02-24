<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreaccionDeProveedoresPagosRealizadosYRetenciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('estado');
            $table->string('tipo', 10);
            $table->boolean('contribuyente_especial');
            $table->string('ruc', 13)->nullable();
            $table->string('cedula', 10)->nullable();
            $table->string('nombres', 100)->nullable();
            $table->string('apellidos', 100)->nullable();
            $table->string('nombre_comercial', 255)->nullable();
            $table->string('telefonos', 255)->nullable();
            $table->string('provincia', 100)->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('email', 100)->nullable();
            $table->boolean('extranjero')->nullable();
            $table->float('descuento')->nullable();
            $table->string('ret_ir', 255)->nullable();
            $table->string('ret_iva', 255)->nullable();
            $table->boolean('cia_relacionada')->nullable();
            $table->boolean('artesano')->nullable();
            $table->timestamps();
        });
        
        Schema::create('pagos_realizados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_de_transaccion', 10)->nullable();
            $table->string('forma_de_pago', 100)->nullable();
            $table->date('fecha_de_emision')->nullable();

            $table->integer('id_proveedor')->unsigned()->nullable();
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade');

            $table->string('cuenta_bancaria', 100)->nullable();
            $table->string('numero_cheque', 100)->nullable();
            $table->string('descripcion', 1000)->nullable();
            $table->timestamps();
        });

        Schema::create('retenciones', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_pagos_realizados')->unsigned();
            $table->foreign('id_pagos_realizados')->references('id')->on('pagos_realizados')->onDelete('cascade');
            
            $table->integer('id_proveedores')->unsigned();
            $table->foreign('id_proveedores')->references('id')->on('proveedores')->onDelete('cascade');

            $table->date('fecha_emision');
            $table->float('neto')->nullable();
            $table->float('retencion_fuente')->nullable();
            $table->float('retencion_iva')->nullable();
            $table->float('total')->nullable();
            $table->float('retenido')->nullable();
            $table->float('saldo')->nullable();
            $table->string('numero_documento', 100)->nullable();
            $table->string('autorizacion', 100)->nullable();
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
        Schema::dropIfExists('retenciones');
        Schema::dropIfExists('pagos_realizados');
        Schema::dropIfExists('proveedores');
    }
}
