<?php

use Faker\Generator as Faker;

$user = $factory->define(App\User::class, function (Faker $faker) {
	$email = $faker->email;
	$sexo = ['Masculino', 'Femenino'];
    return [
		'nombres' => $faker->firstName,
		'apellidos' => $faker->lastName,
		'sexo' => $sexo[rand(0,1)],
		'correo' => $email,
	];
});


