<?php

use App\Institution;
use App\PeriodoLectivo;
use Faker\Generator as Faker;

$factory->define(App\Parents::class, function (Faker $faker) {
	$sexo = ['Masculino', 'Femenino'];
	$parentezco = ['Padre', 'Madres'];
	$idPeriodos = PeriodoLectivo::pluck('id');
	
    return [
		'ci' => "0{$faker->randomNumber(9)}",
		'nombres' => $faker->firstName,
		'apellidos' => $faker->lastName,
		// 'sexo' => $sexo[rand(0,1)],
		'fNacimiento' => $faker->date('Y-m-d'),
		'correo' => $faker->email,
		'movil' => "0{$faker->randomNumber(9)}",
		'parentezco' => $parentezco[rand(0,1)],
		'bio' => $faker->sentence(5),
		'estudios' => $faker->sentence(5),
		'ciudadDomicilio' => $faker->city,
		'direccionDomicilio' => $faker->address,
		'telefonoDomicilio' => "042{$faker->randomNumber(6)}",
		'ciudadTrabajo' => $faker->city,
		'direccionTrabajo' => $faker->address,
		'telefonoTrabajo' => "0{$faker->randomNumber(9)}",
		'cargoTrabajo' => $faker->sentence(2),
		'lugarTrabajo' => $faker->streetAddress,
		'fallecido' => 0,
		'estado_civil' => 0,
		'autorizadoRetirarEstudiante' => 0,
		'lugarNacimiento' => $faker->city,
		'provincia' => $faker->sentence(2),
		'canton' => $faker->sentence(2),
		'parroquia' => $faker->sentence(3),
		'clinica' => $faker->sentence(2),
		'indicaciones' => $faker->sentence(8),
		'tipoSangre' => 'A+',
		'contactoEmergencia' => "$faker->firstName $faker->lastName",
		'telefonoEmergencia' => "0{$faker->randomNumber(9)}",
		'observacionEmergencia' => $faker->sentence(5),
		'idPeriodo' => $idPeriodos[rand(0,count($idPeriodos)-1)]
    ];
});
