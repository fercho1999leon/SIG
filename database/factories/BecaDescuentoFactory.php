<?php

use Faker\Generator as Faker;

$factory->define(App\BecaDescuento::class, function (Faker $faker) {
	$porcentaje = ($faker->randomDigit *10) / 2;
	$nombreDescuento = "DESCUENTO {$porcentaje} %";
	$nombreBeca = "SITUACIÓN ECONOMICA {$porcentaje} %";
	$tipoDeBeca = [
		'DESCUENTO' => 'DESCUENTO', 
		'BECA' => 'BECA'
	];
	$tipoDeBeca = array_rand($tipoDeBeca);
	if ($tipoDeBeca == 'BECA') {
		return [
			'nombre' => $nombreBeca,
			'descripcion' => $nombreBeca,
			'tipo' => $tipoDeBeca
		];
	} else {
		return [
			'nombre' => $nombreDescuento,
			'descripcion' => $nombreDescuento,
			'tipo' => $tipoDeBeca
		];
	}
});
