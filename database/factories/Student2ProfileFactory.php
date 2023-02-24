<?php

use App\Student2Profile;
use Faker\Generator as Faker;

$factory->define(Student2Profile::class, function (Faker $faker) {
    return [
		'fecha_matriculacion' => '',
		'numero_matriculacion' => '',
		'idCurso' => '',
		'idPeriodo' => '',
		'idRepresentante' => '',
		'idStudent' => '',
		'transporte_id' => '',
		'tipo_matricula' => '',
		'seccion' => '',
		'ciudad_domicilio' => '',
		'direccion_domicilio' => '',
		'telefono_movil' => '',
		'tipo_vivienda' => '',
		'nacionalidad' => '',
		'hospital' => '',
		'indicaciones' => '',
		'nombre_contacto_emergencia' => '',
		'movil_contacto_emergencia' => '',
		'ficha_medica' => '',
		'retirado' => '',
    ];
});
