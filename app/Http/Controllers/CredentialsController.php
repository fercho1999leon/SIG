<?php

namespace App\Http\Controllers;


use App\Student2;
use App\Institution;
use App\Course;
use App\User;
use PDF;

class CredentialsController extends Controller
{
    public function carnetCurso($idCurso) {

		$institution = Institution::first();
		$course = Course::find($idCurso);
		$students = Student2::getStudentsByCourse($idCurso);
		$pdf = PDF::loadView('partials.carnet.carnet', compact(
			'students', 'course', 'institution'
		));
        return $pdf->inline('Carnet.pdf');
	}
}
