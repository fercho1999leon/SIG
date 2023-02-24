<?php

use App\PeriodoLectivo;
use Faker\Generator as Faker;
use App\Transporte;

$factory->define(Transporte::class, function (Faker $faker) {
	$idPeriodos = PeriodoLectivo::pluck('id');
    return [
		'unidad' => $faker->randomDigit,
		'ruta' => $faker->streetName,
		'rutaDetalle' => $faker->address,
		'placa' => '000-000',
		'chofer' => $faker->name,
		'correo' => $faker->email,
		'celular' => '0000000000',
		'idPeriodo' => $idPeriodos[rand(0,count($idPeriodos)-1)],
    ];
});
