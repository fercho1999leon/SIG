<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institution;
use App\Course;
use App\Matter;
use App\Usuario;
use Sentinel;
use App\Student2;
use App\Administrative;
use App\Supply;
use App\Calificacion;
use PDF;
use Illuminate\Support\Facades\Redirect;
use App\PeriodoLectivo;
use App\Student2Profile;

class PdfControllerListadoDeCalificacionesPendientesPorCurso extends Controller
{
    public function invoice($idCurso, $parcial){
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::findOrFail(Sentinel::getUser()->idPeriodoLectivo);
		$matters = Matter::getMattersByCourse($idCurso);
		$course = Course::find($idCurso);
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $promedios = [];
        $insumos = [];
        foreach($matters as $matter){
            $insumos[$matter->id] = Supply::getSuppliesByMatter($matter->id);               
            $promedios[$matter->id] = Calificacion::getPromedioSupply($matter->id,$idCurso,$parcial);            
        }
        $idDocentes = [];
        $hasStudents = false;
        foreach($matters as $matter) {
            array_push($idDocentes, $matter->idDocente);
            foreach($students as $student) {
                foreach($insumos[$matter->id] as $key => $insumo) {
                    if($promedios[$matter->id][$insumo->id][$student->idStudent]['promedio'] == 0)
                        $hasStudents = true;
                }
            }
        }
        if($hasStudents){
            $docentes = Usuario::whereIn('id', $idDocentes)->get();
            $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.parcial.listado-de-calificaciones-pendientes-por-curso', compact('matters', 'promedios', 'insumos', 
                'docentes', 'parcial', 'students', 'institution', 'course', 'periodo'));
            return $pdf->download('Calificaciones Pendiente.pdf');
        }else{
            return Redirect::back()->withErrors(['login_fail' => 'No existen alumnos con calificaciones pendientes.']);
        }
	}
}
