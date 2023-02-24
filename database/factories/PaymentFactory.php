<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
	$cantidad = rand(10,100);
    return [
		'mes' => 1,
		'anio' => 2019,
		'tipo' => 'Pension',
		'tipo_emision' => 'FACTURA',
		'anio_lectivo' => App\PeriodoLectivo::first()->nombre,
		'descripcion' => 'Esto es una descripción',
		'valor_autorizado' => $cantidad,
		'valor_cancelar' => $cantidad,
		'idPeriodo' => App\PeriodoLectivo::first()->id,
    ];
});
