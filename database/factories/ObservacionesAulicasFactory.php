<?php

use App\User;
use Faker\Generator as Faker;

$docentes = User::where('cargo', 'Docente')->get();
$docentesId = [];
foreach ($docentes as $docente) {
	array_push($docentesId, $docente->userid);
}
$factory->define(App\ObservacionesAulicas::class, function (Faker $faker) use ($docentesId) {
    return [
		'hora_inicio' => $faker->time,
		'hora_fin' => $faker->time,
		'idAsignatura' => $faker->randomDigitNotNull,
		'grado' => $faker->sentence(3),
		'tema' => $faker->sentence(10),
		'objetivo' => $faker->sentence(10),
		'observaciones' => $faker->sentence(10),
		'recomendaciones' => $faker->sentence(10),
		'status' => rand(0,1),
		'idInstitucion' => 1,
		'idArchivo' => 1,
		'idAsignatura' => $faker->randomDigitNotNull,
		'idDocente' => $docentesId[rand(0,48)],
		'idUsuario' => $faker->randomDigitNotNull,
    ];
});
