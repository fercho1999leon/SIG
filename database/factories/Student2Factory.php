<?php

use App\Course;
use App\Parents;
use App\Transporte;
use App\User;
use App\Usuario;
use Faker\Generator as Faker;

$factory->define(App\Student2::class, function (Faker $faker) {
	$nombres = $faker->firstNameMale;
	$apellidos = $faker->lastName;
	$sexo = ['Masculino', 'Femenino'];
	$matriculas = ['Ordinaria', 'Extraordinaria', 'Pre Matricula'];
	$transporte = factory(Transporte::class)->create();
	$course = Course::where('grado', 'Segundo')->first();
	$padre = factory(Parents::class)->create();
	$madre = factory(Parents::class)->create();
	$user = factory(Usuario::class)->create();
	$representante = factory(User::class)->create(['userid' => $user->id, 'cargo' => 'Representante']);
	return [
		'ci' => '1234567890',
		'nombres' => $nombres,
		'apellidos' => $apellidos,
		'sexo' => $sexo[rand(0,1)],
		'fechaNacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'ciudad' =>	'Guayaquil',
		'direccion' =>	$faker->address,
		'telefono' => '000000000',
		'nacionalidad' => 'Ecuatoriano',
		'lugarNacimiento' => 'Guayaquil',
		'tipoVivienda' => 'Tipo de vivienda',
		'institucionAnterior' => 'institutcion anterior',
		'razonCambio' => 'Razon del cambio',
		'observaciones' => 'osbervaciones del cambio',
		'clinica' => 'clininca --',
		'indicaciones' => 'indicaciones',
		'tipoSangre' => 'tipo de sangre',
		'contactoEmergencia' => '0999999999',
		'telefonoEmergencia' => '0999999998',
		'matricula' => 'Ordinaria',
		'retirado' => 'NO',
		'seccion' => 'EGB',
		'transporte_id' => $transporte->id,
		'idCurso' => $course->id,
		'idPadre' => $padre->id,
		'idMadre' => $madre->id,
		'idRepresentante' => $representante->id,
		'bloqueado' => 0,
		'numeroMatricula' => '0000-00',
		'provincia' => 'Provincia',
		'canton' => 'Canton',
		'parroquia' => 'parroquia parroquia'
	];
	
});