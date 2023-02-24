<?php

use Faker\Generator as Faker;

$factory->define(App\Usuario::class, function (Faker $faker) {
    return [
		'email' => $faker->email,
		'password' => bcrypt('password'),
		'idPeriodoLectivo' => App\Institution::first()->periodoLectivo
    ];
});
