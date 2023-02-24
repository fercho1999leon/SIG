<?php

use Faker\Generator as Faker;

$factory->define(App\PagoEstudianteDetalle::class, function (Faker $faker) {
    return [
		'prorroga' => null,
		'estado' => 'PENDIENTE'
    ];
});
