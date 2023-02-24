<?php

use App\PeriodoLectivo;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence(2),
        'descripcion' => $faker->sentence(7),
        'idPeriodo' => PeriodoLectivo::first()->id,
        'recibirTareas' => 0,
        'fechaInicio' => Carbon::now(),
        'fechaEntrega' => Carbon::now(),
        'idInsumo' => null,
        'parcial' => null,
        'calificado' => 1
    ];
});
