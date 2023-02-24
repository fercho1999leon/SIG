<?php

use App\Institution;
use Faker\Generator as Faker;

$factory->define(App\AdditionalBook::class, function (Faker $faker) {
	$institution = Institution::first();
    return [
		'nombre' => $faker->sentence(3),
		'descripcion' => $faker->sentence(10),
		'enlace' => 'https://www.youtube.com/watch?v=h3caGm-x9Ng',
		'idPeriodo' => $institution->id
    ];
});
