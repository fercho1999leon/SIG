<?php

use Faker\Generator as Faker;

$factory->define(App\Institution::class, function (Faker $faker) {
    return [
		'lema' => $faker->sentence(5),
		'nombre' => 'Nombre de la institución',
		'ciudad' => $faker->city,
		'direccion' => $faker->streetAddress,
		'correo' => $faker->email,
		'telefonos' => $faker->tollFreePhoneNumber,
		'jornada' => 'Matutina',
		'horariosDeAtencion' => '08h00 a 14h00',
		'mision' => $faker->sentence(10),
		'vision' => $faker->sentence(10),
		'antecedentes' => $faker->sentence(5),
		'historia' => $faker->sentence(5),
		'ei' => 'Educación Inicial',
		'egb' => 'Educación General Básica',
		'bgu' => 'Bachillerato General Unificado',
		'directiva' => $faker->sentence(5),
		'sitioWeb' => 'https://nombreDelSitioWeb.com',
		'facebook' => 'https://facebook.com',
		'twitter' => 'https://twitter.com',
		'youtube' => 'https://youtube.com',
		'google' => 'https://google.com',
		'instagram' => 'https://instagram.com',
		'representante1' => $faker->name('male'),
		'cargo1' => 'RECTOR',
		'representante2' => $faker->name('female'),
		'cargo2' => 'Secretaria General',
		'coordinacionZonal' => $faker->randomDigit,
		'distrito' => '09D05',
		'codigoAmie' => '09H01463',
		'logo' => null,
		// 'periodoLectivo' => 
    ];
});
