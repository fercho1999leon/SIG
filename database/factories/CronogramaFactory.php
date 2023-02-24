<?php

use Faker\Generator as Faker;

$factory->define(App\Cronograma::class, function (Faker $faker) {
    return [
		'titulo' => $faker->sentence(3),
		'parcial' => 'p1q1',
		'rol' => 'institucion',
    ];
});
