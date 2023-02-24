<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Certificado extends Model
{
    public static function curso($idCourse){
    	$course = Course::find($idCourse);
    	$grado = '';

    	switch($course->grado){
                case "Inicial 1":
                    $grado = $course->grado." - EDUCACION INICIAL";
                break;
                case "Inicial 2":
                    $grado = $course->grado." - EDUCACION INICIAL";
                break;
                case "Primero":
                    $grado = $course->grado." DE EDUCACIÓN EI - PREPARATORIA";
                break;
                case "Segundo":
                    $grado = $course->grado." - BASICA ELEMENTAL";
                break;
                case "Tercero":
                    $grado = $course->grado." - BASICA ELEMENTAL";
                break;
                case "Cuarto":
                    $grado = $course->grado." - BASICA ELEMENTAL";
                break;
                case "Quinto":
                    $grado = $course->grado." - BASICA MEDIA";
                break;
                case "Sexto":
                    $grado = $course->grado." - BASICA MEDIA";
                break;
                case "Septimo":
                    $grado = $course->grado." - BASICA MEDIA";
                break;
                case "Octavo":
                    $grado = $course->grado." - BASICA SUPERIOR";
                break;
                case "Noveno":
                    $grado = $course->grado." - BASICA SUPERIOR";
                break;
                case "Decimo":
                    $grado = $course->grado." - BASICA SUPERIOR";
                break;
            }

    	return $grado;
    }

    public static function paralelo($idCourse){
    	$paralelo = '';

    	return $paralelo;
    }

    public static function especializacion($idCourse){
    	$especializacion = '';

    	return $especializacion;
    }
}
