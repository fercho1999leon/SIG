<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrative;
use App\Student2;
use Sentinel;
use App\Course;
use App\CourseSchedule;
use App\Matter;
use PDF;
use App\Institution;
use App\QuizSchedule;
use App\User;
use App\PeriodoLectivo;
use App\Student2Profile;
use App\Http\Controllers\BibliotecaReportController;
use App\UnidadPeriodica;
class CourseScheduleController extends Controller
{
    /*
	Metodo para obtener el horario de clases de un curso. En perfil Estudiante
    */
    public function getCourseScheduler($parcial){
		if(session('horaInicio') != null && session('user') != null){
			$sessionHora = new BibliotecaReportController;
			$sessionHora->sessionHora();
		  }
		$unidad = UnidadPeriodica::unidadP();
		$user_profile = User::where('userid', Sentinel::getUser()->id)->first();
		$student = Student2Profile::getStudent($user_profile->profileStudent->id);
		//dd($user_profile->profileStudent->id, $student );
        $course = Course::findOrFail($student->idCurso);
		
		/*$schedules = CourseSchedule::where('idCurso', $course->id)
			//->where('idPeriodo', $this->idPeriodoUser())
			->orderBy('horaInicio')
			->get();
			//dd($schedules);*/
			$schedules = QuizSchedule::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
		  							->where('tipo',$parcial)
									->where('idCurso',$course->id)
									->orderBy('horaInicio')
									->get();
			//dd($course,$schedules,$user_profile,$student);
        $matters = Matter::all();
		//dd($schedules,$course,$matters);
		return view('UsersViews.estudiante.horario.horario', compact('course', 'schedules', 'matters', 'unidad', 'parcial'));
	}
	
	public function downloadScheduleCourse($id) {
		$i = 0;
		$curso = Course::find($id);
        $horarios = CourseSchedule::where('idCurso', $id)->get();
		$docentes = Administrative::where('cargo', 'Docente')->get();
        $materias = Matter::where('idCurso', $curso->id)->get();
		$institution = Institution::find(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$tutor = Administrative::find($curso->idProfesor);
		$pdf = PDF::loadView('pdf.formatoHorarioClases', compact(
			'i', 'tutor', 'curso', 'institution', 'horarios', 'materias', 'docentes',
			'periodo'
            ))->setOrientation('landscape');
		return $pdf->download("horario escolar($curso->grado $curso->especializacion $curso->paralelo).pdf");
	}

	public function descargarHorarioEscolarPorTipo(Course $course, $parcial) {
		if ($parcial == 'clases') {
			$horarios = CourseSchedule::where(['idCurso' => $course->id])->orderBy('horaInicio')->get();
		} else {
			$horarios = QuizSchedule::where(['idCurso' => $course->id, 'tipo' => $parcial])->orderBy('horaInicio')->get();
		}
		$count = 1;
		$materias = Matter::where('idCurso', $course->id)->get();
		$institution = Institution::first();
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
		$docentes = User::where('cargo', 'Docente')->get();
		$pdf = PDF::loadView('pdf.horario-escolar-tipos', compact(
			'institution', 'docentes', 'horarios', 'materias', 'parcial', 'count',
			'periodo'
		));

		return $pdf->download('Horario Escolar.pdf');
	}
}
