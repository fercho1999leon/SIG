<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Student::class, function (Faker\Generator $faker) {
	
    return [
        'ci'			=>	$faker->isbn10,
        'nombres'		=>	$faker->firstNameMale,
        'apellidos'		=>  $faker->lastName,
        'sexo'			=>	'Masculino',
        'fNacimiento'	=>	$faker->streetAddress,
        'ciudad'		=>	'Guayaquil',
        'direccion'		=>	$faker->address,
        'curso'			=>	'Décimo Grado',
        'paralelo'		=>	'A',
        'matricula'		=> 'Ordinaria',
    ];
});