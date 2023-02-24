<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\Course;
use App\Institution;
use App\Matter;
use App\Student2;
use Exception;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ListaCotejoController extends Controller
{
    public function index(Matter $materia, $parcial) {
		try {
			$i = 1;
			$institution = Institution::first();
			$course = Course::find($materia->idCurso);
			$profesor = Administrative::find($course->idProfesor);
			$fecha = Carbon::now()->format('Y/m/d');
			$destrezas = DB::table('clasesdestrezas')
			->join('destrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
			->join('matters', 'destrezas.idMateria', '=', 'matters.id')
			->where('clasesdestrezas.parcial', strtoupper($parcial))
			->where('matters.id', $materia->id)
			->select('destrezas.nombre', 'clasesdestrezas.calificacion')
			->get();
			if ($destrezas->isEmpty()) {
				throw new Exception("No hay destrezas creadas.");
			}
			$numeroDeDestrezas = count($destrezas);
			$students = Student2::where('idCurso', $course->id)
				->orderBy('apellidos', 'ASC')
				->get();
			$takeInicial = 4;
			$take = 7;
			$pdf = PDF::loadView('pdf.lista-cotejo', compact(
				'materia', 'institution', 'course', 'profesor', 'fecha', 'students',
				'destrezas', 'i', 'numeroDeDestrezas', 'take', 'takeInicial'
			));
	
			return $pdf->download("Lista de cotejo($course->grado $course->especializacion $course->paralelo).pdf");
		} catch (Exception $e) {
			return Redirect::back()->withErrors(['error' => $e->getMessage()]);
		}
	}
}
