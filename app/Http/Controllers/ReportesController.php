<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Student2;
use App\Calificacion;
use App\Destreza;
use App\Course;
use App\Matter;
use App\Institution;
use DB;
use App\Administrative;
use App\Student2Profile;
use App\ConfiguracionSistema;
use PDF;
use Carbon\Carbon;
use App\Fechas;
use App\Area;
use App\PeriodoLectivo;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use App\Usuario;
use Sentinel;
use Illuminate\Support\Facades\Redirect;
class ReportesController extends Controller
 
{
    //................................jorge
    public function actapromedio($idCurso){
        $acta = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/ACTA/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $tutor = Administrative::find($course->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
		$institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1],
        	['principal','=',1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            foreach ($students as $estudiante) {
                $anual[$estudiante->id]= $acta->where('estudianteId',$estudiante->id)->first();


            $num_par=0;
            $unidades_a = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->get();
            foreach ($unidades_a as $unidades) {
                $parcialP[$unidades->id] = ParcialPeriodico::parcialP($unidades->id);
                $num_par +=count($parcialP[$unidades->id]);
            }
    
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.reporte-de-promedios',compact(
                    'students', 'course','matters','institution','anual','area_pos','notasMenores','tutor','unidades_a','parcialP','num_par','periodo','confComportamiento'
                ))->setOrientation('landscape');
    
            return $pdf->download('Reporte de Promedio.pdf');
            //.........................................................jorge
}
    /*
	Reporte de Promedio
    */
    public function reportePromedio($idCurso){
    	$sabana = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/sabana/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $area_pos = Area::areasBySection($course->seccion);//orden de las areas en el descargable
        $tutor = Administrative::find($course->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
		$institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1],
        	['principal','=',1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
        foreach ($students as $estudiante) {
            $anual[$estudiante->id]= $sabana->where('estudianteId',$estudiante->id)->first();
        }
        //foreach ($matters as $materia) {
               //if($materia->idArea == null){
                 //    return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
            //}
            //}
        $num_par=0;
        $unidades_a = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->get();
        foreach ($unidades_a as $unidades) {
            $parcialP[$unidades->id] = ParcialPeriodico::parcialP($unidades->id);
            $num_par +=count($parcialP[$unidades->id]);
        }

		$pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.reporte-de-promedios',compact(
				'students', 'course','matters','institution','anual','area_pos','notasMenores','tutor','unidades_a','parcialP','num_par','periodo','confComportamiento'
			))->setOrientation('landscape');

		return $pdf->download('Reporte de Promedio.pdf');

    }
    public function OldreportePromedio($idCurso){
        $students = Student2::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 1])->get();
        $institution = Institution::find(1);

        #calificaciones
		foreach ($matters as $matter){
            //Quimestre 1
			$promediosP1Q1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p1q1');
			$promediosP2Q1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p2q1');
			$promediosP3Q1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p3q1');
			$examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q1');
			$promediosTotalQ1[$matter->id] = [];
            //Quimestre 2
			$promediosP1Q2[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p1q2');
			$promediosP2Q2[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p2q2');
			$promediosP3Q2[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id,'p3q2');
			$examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q2');

			$promediosTotalQ2[$matter->id] = [];
			$promedioTotalMateria[$matter->id] = [];

			foreach ($students as $s){
                //Quimestre 1
				if ($promediosP1Q1[$matter->id][$s->id]['promedio'] != 0 ||
					$promediosP2Q1[$matter->id][$s->id]['promedio'] != 0 ||
					$promediosP3Q1[$matter->id][$s->id]['promedio'] != 0 ||
					$examenesQ1[$matter->id][$s->id] != 0) {
					$parcialesq1 = bcdiv(($promediosP1Q1[$matter->id][$s->id]['promedio'] +
						$promediosP2Q1[$matter->id][$s->id]['promedio'] +
						$promediosP3Q1[$matter->id][$s->id]['promedio']) / 3, '1', 2);
					$promediosTotalQ1[$matter->id][$s->id] = bcdiv(($parcialesq1 * 0.8) + ($examenesQ1[$matter->id][$s->id] * 0.2), '1', 2);
				} else {
					$promediosTotalQ1[$matter->id][$s->id] = 0;
				}

                //Quimestre 2
				if ($promediosP1Q2[$matter->id][$s->id]['promedio'] != 0 ||
					$promediosP2Q2[$matter->id][$s->id]['promedio'] != 0 ||
					$promediosP3Q2[$matter->id][$s->id]['promedio'] != 0 ||
					$examenesQ2[$matter->id][$s->id] != 0) {

					$parcialesq2 = bcdiv(($promediosP1Q2[$matter->id][$s->id]['promedio'] +
						$promediosP2Q2[$matter->id][$s->id]['promedio'] +
						$promediosP3Q2[$matter->id][$s->id]['promedio']) / 3, '1', 2);
					$promediosTotalQ2[$matter->id][$s->id] = bcdiv(($parcialesq2 * 0.8) + ($examenesQ2[$matter->id][$s->id] * 0.2), '1', 2);

				} else {
					$promediosTotalQ2[$matter->id][$s->id] = 0;
				}
				$promedioTotalMateria[$matter->id][$s->id] = ($promediosTotalQ1[$matter->id][$s->id] + $promediosTotalQ2[$matter->id][$s->id]) / 2;
			}
		}

		$promediogeneral = [];
		foreach ($students as $s) {
			$promediogeneral[$s->id] = 0;
			foreach ($matters as $matter) {
				$promediogeneral[$s->id] += $promedioTotalMateria[$matter->id][$s->id];
			}
			$promediogeneral[$s->id] = $promediogeneral[$s->id] / count($matters);
		}
        #endsection

		$pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.anual.reporte-de-promedios',
			compact(
				'students', 'course','matters','institution','promediosP1Q1','promediosP2Q1',
				'promediosP3Q1','examenesQ1','promediosTotalQ1','promediosP1Q2','promediosP2Q2',
				'promediosP3Q2','examenesQ2','promediosTotalQ2','promedioTotalMateria','promediogeneral'
			))->setOrientation('landscape');

		return $pdf->download('Reporte de Promedio.pdf');
	}
	/**/
      

	/*
	Reporte de Promedio por Clases
	*/
    public function reportePromedioClases($idCurso){
        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents(
            'http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $area_pos = Area::areasBySection($course->seccion);//orden de las areas en el descargable
        $tutor = Administrative::find($course->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $lista_materias =[];
        $mostrar=[];
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1],
            ['principal','=',1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            //foreach ($matters as $materia) {
              // if($materia->idArea == null){
                    // return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
            //}
            //}
        $profesores = Administrative::whereIn('userid', $matters->pluck('idDocente')->toArray())->get();
        foreach ($students as $estudiante) {
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->id)->first();
            foreach ($matters as $materias) {
                foreach ($anual[$estudiante->id]->materias as $n_m) {
                    if ($n_m->materiaId == $materias->id) {
                        if ($n_m->promedio != $n_m->promedioAnual || $n_m->promedio != $n_m->promedioFinal ) {
                         array_push($mostrar,['nota'=>$n_m,
                                            'idEstudiante'=>$estudiante->id]);
                         array_push($lista_materias,$materias->id);
                        }
                    }
                }
            }
        }
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        $l_materias = new \Illuminate\Support\Collection($lista_materias);
        $l_materias =$l_materias->unique();
        $pdf = PDF::loadView(
            'pdf.reportes-por-curso.cursos.anual.acta-de-calificaciones-recuperacion',
            compact(
                'course','profesores','matters','institution','students','fechaA','notasMenores','mostrar','l_materias','periodo','tutor'
            )
        );
        return $pdf->download('Reporte de promedio por clase.pdf');
    }

    public function reportePromedioDocente($idMateria){
        
        $matter = Matter::find($idMateria);
        $course = Course::find($matter->idCurso);

        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents(
            'http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$course->id)));

        $students = Student2Profile::getStudentsByCourse($course->id);
        $usuario = Usuario::find($matter->idDocente);
        $tutor = $usuario->profile;
        
        $area_pos = Area::areasBySection($course->seccion);//orden de las areas en el descargable
        
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $lista_materias =[];
        $mostrar=[];
        
        //if($matter->idArea == null){
                //return Redirect::back()->withErrors(['error' => 'La materia: '.$matter->nombre.' no tiene area asignada']);
        //}

        foreach ($students as $estudiante) {
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->id)->first();
            foreach ($anual[$estudiante->id]->materias as $n_m) {
                if ($n_m->materiaId == $matter->id) {
                    array_push($mostrar,['nota'=>$n_m, 'idEstudiante'=>$estudiante->id]);
                    array_push($lista_materias,$matter->id);
                }
            }
        }
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);
        $l_materias = new \Illuminate\Support\Collection($lista_materias);
        $l_materias =$l_materias->unique();
        $pdf = PDF::loadView(
            'pdf.reportes-por-curso.cursos.anual.acta-de-calificaciones-docente',
            compact(
                'course','institution','students','fechaA','notasMenores','mostrar','l_materias','periodo','tutor', 'matter'
            )
        );
        return $pdf->download('Reporte de promedio por clase.pdf');
    }

	public function OldreportePromedioClases($idCurso){
		$matters = Matter::where(['idCurso' => $idCurso, 'visible' => 1])->get();
		$promediosQ1 = Calificacion::getPromedioFinalQuimestreCurso($idCurso, 'q1');
		$promediosQ2 = Calificacion::getPromedioFinalQuimestreCurso($idCurso, 'q2');

		$now = Carbon::now();
		$fechaA = Fechas::fechaActual($now);

        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
		$nota_menor = ConfiguracionSistema::notaMenorRojo();

		$institution = Institution::find(1);
		$students = Student2::getStudentsByCourse($idCurso);
		$course = Course::find($idCurso);
		$profesores = Administrative::whereIn('userid', $matters->pluck('idDocente')->toArray())->get();
		$supletorios = [];
		$remediales = [];
		$gracias = [];

		//filtrar materias que no dieron recuperacion
		foreach($matters as $key => $matter){
			$recuperatorio = false;
			foreach($students as $student){
				if($promediosQ1[$matter->id][$student->id] != 0 && $promediosQ2[$matter->id][$student->id] != 0){
					if( ($promediosQ1[$matter->id][$student->id] + $promediosQ2[$matter->id][$student->id])/2 <7)
					{
						$recuperatorio = true;
					}
				}

				//echo ($matter->nombre." - ".($promediosQ1[$matter->id][$student->id] + $promediosQ2[$matter->id][$student->id])/2). "<br/>";
			}
			if (!$recuperatorio){
				$matters->forget($key);
			}
		}

		foreach($matters as $matter){
			$supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
			$remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
			$gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
		}

		$pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.anual.acta-de-calificaciones-recuperacion',
			compact(
				'course', 'supletorios', 'remediales', 'gracias','profesores','matters',
				'institution','students','promediosQ1','promediosQ2','fechaA','notasMenores','nota_menor'
			)
		);

		return $pdf->download('Reporte de promedio por clase.pdf');
	}
	/**/	/*
	Reporte de Recuperación
	*/
    public function reporteRecuperacion($idCurso){
       // return 'reporte';
        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
       // dd($data2);
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
           // foreach ($matters as $materia) {
                //if($materia->idArea == null){
                     //return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
           // }
            //}
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        //$mostrar=[];
        foreach ($students as $estudiante) {
            $promedios_Finales[$estudiante->id]=[];
            $mostrar[$estudiante->id]=[];
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->id)->first();
            foreach ($matters as $materias) {
                foreach ($anual[$estudiante->id]->materias as $n_m) {
                    if ($n_m->materiaId == $materias->id) {
                        if ($n_m->promedio != $n_m->promedioAnual) {
                         array_push($mostrar[$estudiante->id],$n_m);
                         array_push($promedios_Finales[$estudiante->id],$anual[$estudiante->id]->promedioEstudiante);
                        }
                    }
                }
            }
        }
        $pdf =  PDF::loadView('pdf.reportes-por-curso.cursos.anual.reporte-examenes-recuperacion',compact('students', 'course', 'matters', 'institution', 'institution','periodo','mostrar','promedios_Finales','confComportamiento'
            ))->setOrientation('landscape');
        return $pdf->download('Reporte de Recuperacion.pdf');
    }
	public function OldreporteRecuperacion($idCurso){
        #datos basicos
		$students = Student2::getStudentsByCourse($idCurso);
		$course = Course::find($idCurso);
		$matters = Matter::getMattersAllByCourse($idCurso);
		// $mattersF = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 1])->get();
		// $mattersE = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 0])->get();
		$institution = Institution::find(1);
        #endsection

        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($idCurso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($idCurso);
        $promediosQ1 = Calificacion::getPromedioFinalQuimestreCurso($idCurso, 'q1');
        $promediosQ2 = Calificacion::getPromedioFinalQuimestreCurso($idCurso, 'q2');
        $promTotalF = [];
        $promTotalE = [];

        foreach($matters as $matter){
            $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q1');
			$recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q2');

        }

		//filtrar estudiantes que esten supletorio
		if($course->seccion != 'EGB' || $course->grado == 'Octavo' || $course->grado == 'Noveno' || $course->grado == 'Decimo'){

			foreach($students as $key => $student){
				$supletorio = false;
				foreach($matters as $matter){
					if($promediosFinales[$matter->id][$student->id] < 7)
					{
						$supletorio = true;
					}
				}
				if (!$supletorio){
					$students->forget($key);
				}
			}
		}
		//filtrar estudiantes que no dieron recuperacion
        foreach($students as $key => $student){
            $recuperatorio = false;
            foreach($matters as $matter)
            {
                if($recuperacionQ1[$matter->id][$student->id] != 0 || $recuperacionQ2[$matter->id][$student->id] != 0)
                {
                    $recuperatorio = true;
                }
            }
            if (!$recuperatorio){
                $students->forget($key);
            }
		}

        foreach($students as $student){
            $promTotalF[$student->id] = 0;
            $promTotalE[$student->id] = 0;
            foreach($matters->where('principal', 1) as $matter){
                $promTotalF[$student->id] += $promediosFinales[$matter->id][$student->id];
            }
            foreach($matters->where('principal', 0) as $matter){
                $promTotalE[$student->id] += $promediosFinales[$matter->id][$student->id];
            }
            $promTotalF[$student->id] = ( bcdiv($promTotalF[$student->id]/count($matters->where('principal', 1)), '1', 2));
            $promTotalE[$student->id] =  count($matters->where('principal', 0)) == 0 ? 0 : bcdiv($promTotalE[$student->id]/count($matters->where('principal', 0)), '1', 2);
        }
        $pdf =  PDF::loadView(
        	'pdf.reportes-por-curso.cursos.anual.reporte-examenes-recuperacion',
        	compact(
				'students', 'course', 'matters', 'institution', 'promediosQ1', 'promediosQ2',
				'promediosAnuales', 'promediosFinales', 'promTotalF', 'promTotalE', 'recuperacionQ1',
				'recuperacionQ2'
        	))->setOrientation('landscape');

        return $pdf->download('Reporte de Recuperación.pdf');
    }
	/**/


	/*
	Reporte de Supletorio
	*/
    public function reporteSupletorio($idCurso){
        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            //foreach ($matters as $materia) {
                //if($materia->idArea == null){
                  //   return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
            //}
            //}
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();
         foreach ($students as $estudiante) {
            $mostrar[$estudiante->id]=[];
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->id)->first();
            foreach ($matters as $materias) {
                foreach ($anual[$estudiante->id]->materias as $n_m) {
                    if ($n_m->materiaId == $materias->id) {
                        if ($n_m->promedio < 7 || $n_m->supletorio !=0) {
                         array_push($mostrar[$estudiante->id],$n_m);
                        }
                    }
                }
            }
        }
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.reporte-supletorio',compact('students', 'course', 'matters', 'institution', 'promediosAnuales','notasMenores', 'nota_menor','periodo','mostrar', 'promedios_Finales'
            )
        )->setOrientation('landscape');

        return $pdf->download('Reporte Supletorio.pdf');
    }
        public function reporteRemedial($idCurso){
        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            //foreach ($matters as $materia) {
                //if($materia->idArea == null){
                    // return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
           // }
            //}
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();
         foreach ($students as $estudiante) {
            $mostrar[$estudiante->id]=[];
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->id)->first();
            foreach ($matters as $materias) {
                foreach ($anual[$estudiante->id]->materias as $n_m) {
                    if ($n_m->materiaId == $materias->id) {
                        if ($n_m->supletorio >0 && $n_m->supletorio <7 ) {
                         array_push($mostrar[$estudiante->id],$n_m);
                        }
                    }
                }
            }
        }
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.reporte-remedial',compact('students', 'course', 'matters', 'institution', 'promediosAnuales','notasMenores', 'nota_menor','periodo','mostrar', 'promedios_Finales'))->setOrientation('landscape');
        return $pdf->download('Reporte Supletorio.pdf');
    }
    public function reporteGracia($idCurso){
        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1]])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            //foreach ($matters as $materia) {
                //if($materia->idArea == null){
                   //  return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
           //}
            //}
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();
         foreach ($students as $estudiante) {
            $mostrar[$estudiante->id]=[];
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->id)->first();
            foreach ($matters as $materias) {
                foreach ($anual[$estudiante->id]->materias as $n_m) {
                    if ($n_m->materiaId == $materias->id) {
                        if ($n_m->remedial >0 && $n_m->remedial <7 ) {
                         array_push($mostrar[$estudiante->id],$n_m);
                        }
                    }
                }
            }
        }
        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.reporte-gracia',compact('students', 'course', 'matters', 'institution', 'promediosAnuales','notasMenores', 'nota_menor','periodo','mostrar', 'promedios_Finales'))->setOrientation('landscape');
        return $pdf->download('Reporte Supletorio.pdf');
    }
	public function OldreporteSupletorio($idCurso){
		$students = Student2::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = Matter::getMattersAllByCourse($idCurso);
        $institution = Institution::find(1);

        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();

        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($idCurso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($idCurso);

        $supletorios = [];
        foreach($matters as $matter){
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
        }

        foreach($students as $key => $student){
            $supletorio = false;
            foreach($matters as $matter)
            {
                if($promediosAnuales[$matter->id][$student->id] < 7 && $promediosAnuales[$matter->id][$student->id] >=5 && $promediosAnuales[$matter->id][$student->id] > 0)
                {
                    $supletorio = true;
				}
				if($promediosFinales[$matter->id][$student->id] == 0)
					$supletorio = false;
            }
            if (!$supletorio){
                $students->forget($key);
            }
        }
		$pdf = PDF::loadView(
			'pdf.reportes-por-curso.cursos.anual.reporte-supletorio',
			compact(
				'students', 'course', 'matters', 'institution', 'promediosAnuales',
				'promediosFinales', 'supletorios', 'notasMenores', 'nota_menor'
			)
		)->setOrientation('landscape');

		return $pdf->download('Reporte Supletorio.pdf');
	}
	/**/


	/*
	Reporte de Remedial
	*/

	public function OldreporteRemedial($idCurso){
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $students = Student2::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = Matter::where(['idCurso' => $idCurso, 'visible' => 1])->get();
        $institution = Institution::find(1);

        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($idCurso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($idCurso);

        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $nota_menor = ConfiguracionSistema::notaMenorRojo();

		$supletorios = [];
        $remediales = [];
        foreach($matters as $matter){
			$remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
			$supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
        }

        foreach($students as $key => $student){
            $supletorio = false;
            foreach($matters as $matter){
				if(
					($supletorios[$matter->id][$student->id] < 7 &&  $supletorios[$matter->id][$student->id] > 0) ||
					($promediosFinales[$matter->id][$student->id] < 5 && $promediosFinales[$matter->id][$student->id] > 0)
				)
                {
                    $supletorio = true;
				}
				if($promediosFinales[$matter->id][$student->id] == 0)
					$supletorio = false;
            }
            if (!$supletorio){
                $students->forget($key);
            }
        }

        $pdf =  PDF::loadView(
        	'pdf.reportes-por-curso.cursos.anual.reporte-remedial',
			compact(
				'students', 'course', 'matters', 'institution', 'promediosAnuales', 'promediosFinales',
				'notasMenores', 'supletorios', 'nota_menor', 'remediales','periodo'
			))->setOrientation('landscape');

        return $pdf->download('Reporte Remedial.pdf');
    }
	/**/


	/*
	Reporte de Gracia
	*/
	public function OldreporteGracia($idCurso){
        $students = Student2::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = Matter::where(['idCurso' => $idCurso, 'visible' => 1])->get();
        $institution = Institution::find(1);

		$notasMenores = ConfiguracionSistema::notasRojo()->valor;
		$nota_menor = ConfiguracionSistema::notaMenorRojo();

        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($idCurso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($idCurso);
		$gracias = [];
		$remediales = [];
        foreach($matters as $matter){
			$remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
        }

        foreach($students as $key => $student){
            $supletorio = false;
            foreach($matters as $matter){
                if($remediales[$matter->id][$student->id] < 7 && $remediales[$matter->id][$student->id] > 0)
                {
                    $supletorio = true;
				}
				if($promediosFinales[$matter->id][$student->id] == 0)
					$supletorio = false;
            }
            if (!$supletorio){
                $students->forget($key);
            }
        }

        $pdf =  PDF::loadView(
        	'pdf.reportes-por-curso.cursos.anual.reporte-gracia',
        	compact(
				'students', 'course', 'matters', 'institution','promediosAnuales', 'promediosFinales',
				'gracias', 'notasMenores', 'nota_menor', 'remediales'
            ))->setOrientation('landscape');

        return $pdf->download('Reporte Gracia.pdf');
    }
	/**/
}
