<?php

use Faker\Generator as Faker;
$courses = [
	[
		'grado' => 'Inicial 1',
		'paralelo' => '4 - 5 años',
		'seccion' => 'EI',
	], 
	[
		'grado' => 'Segundo',
		'paralelo' => 'A',
		'seccion' => 'EGB',
	],
	[
		'grado' => 'Tercero',
		'paralelo' => 'A',
		'seccion' => 'EGB',
	],
	[
		'grado' => 'Cuarto',
		'paralelo' => 'A',
		'seccion' => 'EGB',
	],
	[
		'grado' => 'Primero de Bachillerato',
		'paralelo' => 'A',
		'especializacion' => 'Ciencias',
		'seccion' => 'BGU',
	],
	[
		'grado' => 'Segundo de Bachillerato',
		'paralelo' => 'A',
		'especializacion' => 'Ciencias',
		'seccion' => 'BGU',
	],
	[
		'grado' => 'Tercero de Bachillerato',
		'paralelo' => 'A',
		'especializacion' => 'Ciencias',
		'seccion' => 'BGU',
	],

];
$factory->define(App\Course::class, function (Faker $faker) use ($courses) {
	$numberRandom = rand(0, count($courses)-1);
    return [
		'grado' => $courses[$numberRandom]['grado'],
		'paralelo' => $courses[$numberRandom]['paralelo'],
		'cupos' => rand(20,30),
		'idPeriodo' => App\Institution::first()->periodoLectivo
    ];
});
