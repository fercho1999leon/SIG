<?php

use App\PeriodoLectivo;
use Faker\Generator as Faker;

$factory->define(App\Calificacion::class, function (Faker $faker) {
    return [
        'idPeriodo' => PeriodoLectivo::first()->id
    ];
});
