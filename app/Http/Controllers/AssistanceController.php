<?php

namespace App\Http\Controllers;

use App\Administrative;
use App\AsistenciaParcial;
use App\ClassDay;
use App\ConfiguracionSistema;
use App\Course;
use App\CourseAssistance;
use App\Institution;
use App\Matter;
use App\PeriodoLectivo;
use App\Student2;
use App\Student2Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use PDF;

class AssistanceController extends Controller
{

    /*
    A D M I N I S T R A D O R
     */
    public function home()
    {
        $id_carrera = \Session::get('idcarrera');
        $regimen = ConfiguracionSistema::regimen();
        $courses = Course::where('id_career', $id_carrera)->where('estado', 1)->get();
        return view('UsersViews.administrador.asistencia.index', compact(
            'courses', 'regimen'
        ));
    }

    public function getAsistenciaReporte(Course $course, $parcial)
    {             
        $students = Student2Profile::getStudentsByCourse($course->id);
        $count = 1;
        $asistenciaDelCurso = CourseAssistance::query()
            ->where('idCurso', $course->id)
            ->where('parcial', $parcial)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->first();

        if ($asistenciaDelCurso == null) {
            return Redirect::back()->withErrors(['warini' => 'El grado no tiene asistencias registradas']);
        }
        return view('UsersViews.administrador.asistencia.reportes.index', compact(
            'students', 'count', 'course', 'parcial', 'asistenciaDelCurso'
        ));
    }

    public function createAsistenciaReporte(Student2Profile $student, $parcial)
    {
        $dates = ClassDay::all();
        $course = Course::where('id', $student->idCurso)->where('estado', 1)->first();
        return view('UsersViews.administrador.asistencia.reportes.crearReporteStudent', compact('student', 'parcial', 'dates', 'course'));
    }

    public function updateAsistenciaReporte(Student2Profile $student, $parcial)
    {
        $student->asistenciaParcial($parcial)->update([
            'atrasos' => request()->atrasos,
            'faltas_justificadas' => request()->faltas_justificadas,
            'faltas_injustificadas' => request()->faltas_injustificadas,
        ]);
        // $stu
        return redirect()->route('asistenciaReporteCurso', [$student->idCurso, $parcial]);
    }
    /**/

    /*
    T U T O R Í A
     */
    public function editStudent($idEstudiante, $parcial)
    {
        $courses = Course::getAllCourses();
        $student = Student2Profile::findOrFail($idEstudiante);
        return view('UsersViews.docente.tutoria.asistencia.editarAsistencia', compact('student', 'courses', 'parcial'));
    }

    public function updateAsistenciaReporteTutor($id, $parcial)
    {
        $student = Student2Profile::findOrFail($id);
        $student->asistenciaParcial($parcial)->update([
            'atrasos' => request()->atrasos,
            'faltas_justificadas' => request()->faltas_justificadas,
            'faltas_injustificadas' => request()->faltas_injustificadas,
        ]);
        $student->save();

        return redirect()->route('tutoria_Asistencia', [$student->idCurso, $parcial]);
    }
    /**/

    /*
    Reporte de Asistencia -  Reportes/Curso
     */
    public function listaAsistencia($id)
    {
        $institution = Institution::findOrFail(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $course = Course::findOrFail($id);
        $students = Student2Profile::getStudentsByCourse($id);
        $studentsM = 0;
        $studentsF = 0;
        $date = date('Y-m-d');
        $invoice = "2222";
        $count = 1;

        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.listado-de-asistencia',
            compact('institution', 'students', 'studentsM', 'studentsM', 'studentsF', 'course', 'count',
                'periodo'
            ));
        return $pdf->download('Reporte Asistencia.pdf');
    }
    public function listaAsistenciageneral(Request $request)
    {
        $institution = Institution::findOrFail(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $course = Course::findOrFail($request->idCurso);
        $matters = Matter::getAllMattersByCourse($request->idCurso);
        if (isset($request->idMateria) && $request->idMateria != '') {
            $matters = Matter::where('id', $request->idMateria)->get();
        }
        $students = Student2Profile::getStudentsByCourse($request->idCurso);
        $studentsM = 0;
        $studentsF = 0;
        $date = date('Y-m-d');
        $count = 1;
        $desde = $request->desde;
        $hasta = $request->hasta;
        $pdf = PDF::loadview('pdf.reportes-por-curso.cursos.anual.listado-de-asistencia-general',
            ['institution' => $institution, 'students' => $students, 'studentsM' => $studentsM, 'studentsF' => $studentsF, 'course' => $course,
                'count' => $count, 'periodo' => $periodo, 'matters' => $matters, 'desde' => $desde, 'hasta' => $hasta])->setOrientation('landscape');
        return $pdf->download('Reporte Asistencia.pdf');
    }

    public function reporteAsistenciaCurso(Course $course, $parcial)
    {
        $i = 1;
        $institution = Institution::first();
        $tutor = Administrative::find($course->idProfesor);
        $students = Student2Profile::getStudentsByCourse($course->id);
        $Quimestre = substr($parcial, 3, 1);
        $Parcial = substr($parcial, 1, 1);
        $nombreReporte = "Reporte de asistencia quimestre {$Quimestre} - parcial {$Parcial}";
        $pdf = PDF::loadView('pdf.reporte-asistencia-quimestral', compact(
            'course', 'tutor', 'institution', 'i', 'students', 'parcial', 'nombreReporte'
        ));

        return $pdf->download("Reporte Asistencia {$course->grado} {$course->paralelo} {$course->especializacion}.pdf");
    }

    public function reporteAsistenciaCursoAnual(Course $course)
    {
        $institution = Institution::first();
        $tutor = Administrative::find($course->idProfesor);
        $parcial = 'anual';
        $students = Student2Profile::getStudentsByCourse($course->id);
        $nombreReporte = "Reporte de asistencia anual";
        $pdf = PDF::loadView('pdf.reporte-asistencia-quimestral', compact(
            'course', 'tutor', 'institution', 'students', 'parcial', 'nombreReporte', 'quimestres'
        ));

        return $pdf->download("Reporte Asistencia Anual.pdf");
    }

    public function reporteAsistenciaCursoQuimestral(Course $course, $parcial)
    {
        $i = 1;
        $institution = Institution::first();
        $tutor = Administrative::find($course->idProfesor);
        $students = Student2Profile::getStudentsByCourse($course->id);
        $Quimestre = substr($parcial, 3, 1);
        $parcial = substr($parcial, 2, 2);
        $nombreReporte = "Reporte de asistencia quimestre {$Quimestre}";
        $pdf = PDF::loadView('pdf.reporte-asistencia-quimestral', compact(
            'course', 'tutor', 'institution', 'i', 'students', 'parcial', 'nombreReporte'
        ));

        return $pdf->download("Reporte Asistencia Quimestral {$course->grado} {$course->paralelo} {$course->especializacion}.pdf");
    }

    public function reporteAsistenciaPorEstudiante(Course $course, Student2 $student, $parcial)
    {
        $i = 1;
        $institution = Institution::first();
        $tutor = Administrative::find($course->idProfesor);
        $Quimestre = substr($parcial, 3, 1);
        $nombreReporte = "Reporte de asistencia por estudiante";
        $pdf = PDF::loadView('pdf.reporte-asistencia-por-estudiante', compact(
            'course', 'tutor', 'institution', 'i', 'student', 'parcial', 'nombreReporte'
        ));

        return $pdf->download("Reporte Asistencia.pdf");
    }

    // Asistencia del curso por parcial
    public function crearAsistenciaCurso($id, $parcial, Request $request)
    {
        $this->validate($request, [
            'asistencia' => 'required|integer',
        ]);
        $asistenciaCurso = CourseAssistance::query()
            ->where('idCurso', $id)
            ->where('parcial', $parcial)
            ->first();
        $asistenciaCurso->asistencia = (int) $request->asistencia;
        $asistenciaCurso->save();

        return back();
    }

}
