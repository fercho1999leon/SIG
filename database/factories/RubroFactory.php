<?php

use Faker\Generator as Faker;

$factory->define(App\Rubro::class, function (Faker $faker) {
	$tiposDeRubro = [
		'Pension' => 'FACTURA',
		'Matricula' => 'FACTURA',
		'Ambiente_Digital' => 'RECIBO',
		'Robotica_Educativa' => 'RECIBO'
	];
	$numberRandom = rand(0, count($tiposDeRubro)-1);
    return [
		'tipo_rubro' => '',
		'tipo_emision' => '',
		'idPeriodo' => App\PeriodoLectivo::first()->id,
    ];
});
