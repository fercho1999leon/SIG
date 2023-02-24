<?php

use App\PeriodoLectivo;
use Faker\Generator as Faker;

$factory->define(App\Cliente::class, function (Faker $faker) {

    return [
		'nombres' => $faker->firstName,
		'apellidos' => $faker->lastName,
		'cedula_ruc' => $faker->isbn10,
		'direccion' => $faker->address,
		'telefono' => $faker->randomNumber(9),
		'correo' => $faker->email,
		'idPeriodo' => PeriodoLectivo::first()->id
    ];
});
