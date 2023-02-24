<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Fechas;
use App\Student2;
use App\Institution;
use App\Course;
use App\User;
use Sentinel;
use PDF;
use App\Parents;
use App\PeriodoLectivo;
use App\Student2Profile;

class pdfControllerNominaEstudiantesMatriculados extends Controller
{
    public function invoice($id)  {
		$institution = Institution::findOrFail(1);
		$periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
        $curso = Course::findOrFail($id);
        $tutor = User::find($curso->idProfesor);
        $estudiantes = Student2Profile::getStudentsByCourse($curso->id);
        foreach($estudiantes as $s) {
            $fn = Carbon::createFromFormat('Y-m-d',$s->fechaNacimiento);
            $estudiantes_em[$s->id] = $fn->diff($s->created_at)->format('%y años, %m meses y %d dias');
        }
        foreach($estudiantes as $s) {
            $fn = Carbon::createFromFormat('Y-m-d',$s->fechaNacimiento);
            $estudiantes_ef[$s->id] = $fn->diff(Carbon::now())->format('%y años, %m meses y %d dias');
        }
        $edad =0;
        $representantes = Sentinel::getUserRepository()
            ->join('users_profile','users_profile.userid','=','users.id')
            ->join('role_users','role_users.user_id','=','users.id')
            ->where('role_id','=',5)
            ->join('students2','students2.idRepresentante','=','users_profile.id')
            ->join('courses', function ($join) use($id){
                    $join->on('students2.idCurso','=','courses.id')
                     ->where('courses.id', '=', $id);
            })
            ->select('users_profile.*','courses.grado','courses.paralelo','students2.idCurso','students2.id')
            ->get();

        $padres = Parents::padres($id);
        $madres = Parents::madres($id);

        //Fechas
        Carbon::setUtf8(true);
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);

        $count = 1;
        $countDatos = 0;

       
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.nomina-de-estudiantes-matriculados', 
        compact('institution', 'curso', 'tutor' , 'now', 'fechaA', 'count','representantes', 
		'estudiantes', 'edad', 'estudiantes_ef', 'estudiantes_em', 'padres', 'madres', 'periodo'))->setOrientation('landscape');
        
        return $pdf->download('Nómina Estudiantil.pdf');
    }

   
}
