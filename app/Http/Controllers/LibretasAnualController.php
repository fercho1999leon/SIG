<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student2;
use App\Course;
use App\Administrative;
use App\CourseAssistance;
use App\Activity;
use App\PeriodoLectivo;
use App\Supply;
use App\Matter;
use App\Institution;
use App\Calificacion;
use Carbon\Carbon;
use App\Fechas;
use App\ConfiguracionSistema;
use App\Student2Profile;
use Sentinel;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use App\Area;
use NumerosEnLetras;
use PDF;
use DB;
use Illuminate\Support\Facades\Redirect;
class LibretasAnualController extends Controller
{
    public function libretaAnual($idCurso){
        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
        $data_q1 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/q1/curso/'.$idCurso)));
        $data_q2 = new \Illuminate\Support\Collection( json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/q2/curso/'.$idCurso)));
         $students = Student2Profile::getStudentsByCourse($idCurso);
        foreach ($students as $estudiante) {
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->idStudent)->first();
            $quimestre1[$estudiante->id]=$data_q1->where('estudianteId', $estudiante->idStudent)->first();
            $quimestre2[$estudiante->id]=$data_q2->where('estudianteId', $estudiante->idStudent)->first();
        }
        $unidades_a = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->get();
        foreach ($unidades_a as $unidades) {
            $parcialP[$unidades->id] = ParcialPeriodico::parcialP($unidades->id);
        }
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
        $curso = Course::find($idCurso);
        $tutor = Administrative::find($curso->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $confDHI = ConfiguracionSistema::configuracionDHI();
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
        $dhi = Matter::where(['idCurso' => $idCurso,
            'area' => 'DESARROLLO HUMANO INTEGRAL',
            'visible' => 0,
            'principal' => 0
        ])->first();
         $allMatters = DB::table('matters')->where([
            ['idCurso', '=', $idCurso],
            ['visible', '=', 1],])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            foreach ($allMatters as $materia) {
                    if($materia->idArea == null){
                    return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
                    }
                }
            $materiasFijas = count($allMatters->where('principal',1));
            $materiasExtra = count($allMatters->where('principal',0));
            $asistenciaCurso = CourseAssistance::query()
                ->where('idCurso', $idCurso)
                ->whereIn('parcial', ["p1q1","p2q1","p3q1","p1q2","p2q2","p3q2"])
                ->get();
            $totalAsistenciaDelCurso = 0;
            $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
            $nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
            foreach ($asistenciaCurso as $asistenciaCurso) {
                $totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
            }
        if($tipo_libreta=='0'){
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual',
                compact('students', 'curso', 'confDHI','dhi','tutor', 'nombre_representante_libreta_parcial','confComportamiento','materiasFijas', 'materiasExtra', 'institution', 'notasMenores','periodo','unidades_a','area_pos','allMatters','anual','quimestre1','quimestre2','PromedioInsumo'
        ))->setOrientation('landscape');
        }elseif($tipo_libreta=='1') {
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual2',
                compact('students', 'curso', 'confDHI','dhi','tutor', 'nombre_representante_libreta_parcial','confComportamiento','materiasFijas', 'materiasExtra', 'institution', 'notasMenores','periodo','count','unidades_a','area_pos','allMatters','anual','quimestre1','quimestre2','PromedioInsumo','totalAsistenciaDelCurso'
            ));
        }else{
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual3',
                compact('students', 'curso', 'confDHI','dhi','tutor', 'nombre_representante_libreta_parcial','confComportamiento','materiasFijas', 'materiasExtra', 'institution', 'notasMenores','periodo','count','unidades_a','area_pos','allMatters','anual','quimestre1','quimestre2','PromedioInsumo','totalAsistenciaDelCurso'
                ));
        }

        return $pdf->download('Libreta Anual.pdf');
    }

    public function libretaAnualEstudiante($idEstudiante){

        $students = Student2Profile::where('id', $idEstudiante)->get();

        $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/anual/'. $this->idPeriodoUser().'/curso/'.$students->first()->idCurso)));
        $data_q1 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/q1/curso/'.$students->first()->idCurso)));
        $data_q2 = new \Illuminate\Support\Collection( json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/q2/curso/'.$students->first()->idCurso)));
        foreach ($students as $estudiante) {
            $anual[$estudiante->id]= $data2->where('estudianteId',$estudiante->idStudent)->first();
            $quimestre1[$estudiante->id]=$data_q1->where('estudianteId', $estudiante->idStudent)->first();
            $quimestre2[$estudiante->id]=$data_q2->where('estudianteId', $estudiante->idStudent)->first();
        }
        $unidades_a = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->get();
        foreach ($unidades_a as $unidades) {
            $parcialP[$unidades->id] = ParcialPeriodico::parcialP($unidades->id);
        }
        $tipo_libreta = ConfiguracionSistema::formatoLibreta();
        $curso = Course::find($students->first()->idCurso);
        $tutor = Administrative::find($curso->idProfesor);
        $notasMenores = ConfiguracionSistema::notasRojo()->valor;
        $confDHI = ConfiguracionSistema::configuracionDHI();
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
        $area_pos = Area::areasBySection($curso->seccion);//orden de las areas en el descargable
        $dhi = Matter::where(['idCurso' => $students->first()->idCurso,
            'area' => 'DESARROLLO HUMANO INTEGRAL',
            'visible' => 0,
            'principal' => 0
        ])->first();
         $allMatters = DB::table('matters')->where([
            ['idCurso', '=', $students->first()->idCurso],
            ['visible', '=', 1],])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderBy('matters.posicion')->get();
            foreach ($allMatters as $materia) {
                    if($materia->idArea == null){
                    return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
                    }
                }
            $materiasFijas = count($allMatters->where('principal',1));
            $materiasExtra = count($allMatters->where('principal',0));
            $asistenciaCurso = CourseAssistance::query()
                ->where('idCurso', $students->first()->idCurso)
                ->whereIn('parcial', ["p1q1","p2q1","p3q1","p1q2","p2q2","p3q2"])
                ->get();
            $totalAsistenciaDelCurso = 0;
            $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
            $nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
            foreach ($asistenciaCurso as $asistenciaCurso) {
                $totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
            }
       // dd($notas->take(1));
        if($tipo_libreta=='0'){
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual',
                compact('students', 'curso', 'confDHI','dhi','tutor', 'nombre_representante_libreta_parcial','confComportamiento','materiasFijas', 'materiasExtra', 'institution', 'notasMenores','periodo','unidades_a','area_pos','allMatters','anual','quimestre1','quimestre2','PromedioInsumo'
            ))->setOrientation('landscape');
        }elseif($tipo_libreta=='1') {
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual2',
                compact('students', 'curso', 'confDHI','dhi','tutor', 'nombre_representante_libreta_parcial','confComportamiento','materiasFijas', 'materiasExtra', 'institution', 'notasMenores','periodo','count','unidades_a','area_pos','allMatters','anual','quimestre1','quimestre2','PromedioInsumo','totalAsistenciaDelCurso'
            ));
        }else{
            $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual3',
                compact('students', 'curso', 'confDHI','dhi','tutor', 'nombre_representante_libreta_parcial','confComportamiento','materiasFijas', 'materiasExtra', 'institution', 'notasMenores','periodo','count','unidades_a','area_pos','allMatters','anual','quimestre1','quimestre2','PromedioInsumo','totalAsistenciaDelCurso'
                ));
        }

        return $pdf->download('Libreta Anual.pdf');
    }

    public function libretaAnual_OLD($idCurso){
            $unidades_a = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->get();
            $nombre_representante_libreta_parcial = ConfiguracionSistema::habilitarNombreRepresentanteLibretaParcial();
			$confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
            $tipo_libreta = ConfiguracionSistema::formatoLibreta();
			$students = Student2Profile::getStudentsByCourse($idCurso);
            $curso = Course::find($idCurso);
            $tutor = Administrative::find($curso->idProfesor);
            $confDHI = ConfiguracionSistema::configuracionDHI();
            $dhi = Matter::where(['idCurso' => $idCurso,
                'area' => 'DESARROLLO HUMANO INTEGRAL',
                'visible' => 0,
                'principal' => 0
			])->first();
			$count = 1;
			$institution = Institution::find(1);
			$periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
            $notasMenores = ConfiguracionSistema::notasRojo()->valor;
            $nota_menor = ConfiguracionSistema::notaMenorRojo();
            $asistenciaCurso = CourseAssistance::query()
                ->where('idCurso', $idCurso)
                ->whereIn('parcial', ["p1q1","p2q1","p3q1","p1q2","p2q2","p3q2"])
                ->get();
            $totalAsistenciaDelCurso = 0;
            foreach ($asistenciaCurso as $asistenciaCurso) {
                $totalAsistenciaDelCurso += $asistenciaCurso->asistencia;
            }
            //Grado Siguiente
            $gradoSiguiente = "";
            switch($curso->grado){
                case "Inicial 1":
                    $gradoSiguiente = "Inicial 2";
                break;
                case "Inicial 2":
                    $gradoSiguiente = "Primer Año de Educación Básica";
                break;
                case "Primero":
                    $gradoSiguiente = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Segundo":
                    $gradoSiguiente = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Tercero":
                    $gradoSiguiente = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
                case "Cuarto":
                    $gradoSiguiente = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Quinto":
                    $gradoSiguiente = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Sexto":
                    $gradoSiguiente = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
                case "Septimo":
                    $gradoSiguiente = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Octavo":
                    $gradoSiguiente = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Noveno":
                    $gradoSiguiente = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
                case "Decimo":
                    $gradoSiguiente = "Primer Año de Bachillerato";
                break;
                case "Primero de Bachillerato":
                    $gradoSiguiente = "Segundo Año de Bachillerato";
                break;
                case "Segundo de Bachillerato":
                    $gradoSiguiente = "Tercer Año de Bachillerato";
                break;
                case "Tercero de Bachillerato":
                    $gradoSiguiente = "Culminando la instrucción Secundaria";
                break;
            }
        #endsection

        #materias
            $matters = Matter::where('idCurso',$idCurso)->orderBy('nombre')->get();

            $materias = [
                'LENGUA Y LITERATURA', 'LENGUA EXTRANJERA', 'MATEMÁTICA',
                'CIENCIAS NATURALES', 'CIENCIAS SOCIALES', 'ESTUDIOS SOCIALES', 'EDUCACIÓN FÍSICA',
                'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'COMPUTACIÓN'
            ];
            $materiasFijas = DB::table('matters')->where([
                ['idCurso', '=', $idCurso],
                ['visible', '=', 1],
                ['principal', '=', 1]
            ])
            ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
            ->select('matters.*', 'areas.nombre AS nombreArea')
            ->orderByRaw("FIELD(nombreArea, 'LENGUA Y LITERATURA', 'MATEMÁTICA', 'CIENCIAS NATURALES', 'ESTUDIOS SOCIALES', 'EDUCACIÓN CULTURAL Y ARTÍSTICA', 'EDUCACIÓN FÍSICA', 'INGLES')");
            $materiasExtra = Matter::where(['idCurso' => $idCurso, 'visible' => 1, 'principal' => 0])
                ->whereNotIn('area', $materias)->where('nombre', 'NOT LIKE', '%PROYECTO%')->get();
            $proyecto = Matter::where(['idCurso' => $idCurso, 'visible' => 1])->where('nombre', 'LIKE', '%PROYECTO%')
                ->whereNotIn('area', $materias)->first();
        #endsection

        #calificaciones
            $pp1q1 = [];
            $pp2q1 = [];
            $pp3q1 = [];
            $pExamenesQ1 = [];
            $pPromediosQ1 = [];
            $faltasJustificadas = [];
            $faltasInjustificadas = [];
            $atrasos = [];

            foreach($students as $student){
                $pp1q1[$student->idStudent] = 0;
                $pp2q1[$student->idStudent] = 0;
                $pp3q1[$student->idStudent] = 0;
                $pExamenesQ1[$student->idStudent] = 0;
                $pPromediosQ1[$student->idStudent] = 0;

                $atrasos[$student->idStudent]["q1"] = $student->p1q1A + $student->p2q1A + $student->p3q1A;
                $atrasos[$student->idStudent]["q2"] = $student->p1q2A + $student->p2q2A + $student->p3q2A;
                $atrasos[$student->idStudent]["total"] = $atrasos[$student->idStudent]["q1"] + $atrasos[$student->idStudent]["q2"];

                $faltasJustificadas[$student->idStudent]["q1"] = $student->p1q1FJ + $student->p2q1FJ + $student->p3q1FJ;
                $faltasJustificadas[$student->idStudent]["q2"] = $student->p1q2FJ + $student->p2q2FJ + $student->p3q2FJ;
                $faltasJustificadas[$student->idStudent]["total"] = $faltasJustificadas[$student->idStudent]["q1"] + $faltasJustificadas[$student->idStudent]["q2"];

                $faltasInjustificadas[$student->idStudent]["q1"] = $student->p1q1FI + $student->p2q1FI + $student->p3q1FI;
                $faltasInjustificadas[$student->idStudent]["q2"] = $student->p1q2FI + $student->p2q2FI + $student->p3q2FI;
                $faltasInjustificadas[$student->idStudent]["total"] = $faltasInjustificadas[$student->idStudent]["q1"] + $faltasInjustificadas[$student->idStudent]["q2"];
            }
            foreach($matters as $matter){
                $unidades = $unidades_a->where('identificador','q1')->first();
                $parcialP = ParcialPeriodico::parcialP($unidades->id);
                foreach ($parcialP as $par) {//creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par->identificador) {
                    case 'p1q1':
                       $promediosP1Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1q1');
                       // dd($promediosP1Q1);
                        break;
                    case 'p2q1':
                         $promediosP2Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2q1');
                        break;
                    case 'p3q1':
                       $promediosP3Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3q1');
                        break;
                    case 'q1':
                        $examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id,'q1');
                        $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q1');
                        break;
                }
            }
                $promediosTotalQ1[$matter->id] = [];
                $promediosFinalQ1[$matter->id] = [];
                $division = count($parcialP)-1;

            $P1=0; $P2=0; $P3=0; $Ex=0;
            $variable ='';

            foreach($students as $s){
                if ((isset($promediosP1Q1)) && ($promediosP1Q1 != [])) {
                    $P1=$promediosP1Q1[$matter->id][$s->idStudent]['promedio'];

                    $variable.= '$P1 !=0 ';
                }else{
                    $promediosP1Q1 = [];
                }
                if ((isset($promediosP2Q1)) && ($promediosP2Q1 != [])) {
                    $P2=$promediosP2Q1[$matter->id][$s->idStudent]['promedio'];
                    $variable.= ' && $P2 !=0 ';
                }else{
                    $promediosP2Q1 = [];
                }
                if ((isset($promediosP3Q1)) && ($promediosP3Q1 != [])) {
                    $P3=$promediosP3Q1[$matter->id][$s->idStudent]['promedio'];
                    $variable.= ' && $P3 !=0 ';
                }else{
                    $promediosP3Q1 = [];
                }
                if (isset($examenesQ1)) {
                    $Ex=$examenesQ1[$matter->id][$s->idStudent];
                    $variable.= ' && $Ex != 0';
                }
                if($variable){// reemplazar los || por && para que si falta un parcial o examen su promedio salga cero
                    $parciales =bcdiv( ($P1 +
                        $P2 +
                        $P3 ) /$division, '1', 2);
                        $promediosTotalQ1[$matter->id][$s->idStudent] =  bcdiv( ($parciales *0.8) + ($examenesQ1[$matter->id][$s->idStudent]*0.2), '1', 2);
                        if($recuperacionQ1[$matter->id][$s->idStudent] > $promediosTotalQ1[$matter->id][$s->idStudent]){
                            $promediosFinalQ1[$matter->id][$s->idStudent] =  bcdiv( $recuperacionQ1[$matter->id][$s->idStudent], '1', 2);
                        }else{
                            $promediosFinalQ1[$matter->id][$s->idStudent] =  $promediosTotalQ1[$matter->id][$s->idStudent];
                        }
                    }else{
                        $promediosTotalQ1[$matter->id][$s->idStudent] = 0;
                        $promediosFinalQ1[$matter->id][$s->idStudent] = 0;
                    }
                }
            }


            $pp1q2 = [];
            $pp2q2 = [];
            $pp3q2 = [];
            $pExamenesQ2 = [];
            $pPromediosQ2 = [];
            $pPromediosTotal = [];
            $pPromediosTotalRecup = [];
            $pPromediosTotalFinal = [];
            foreach($students as $student){
                $pp1q2[$student->idStudent] = 0;
                $pp2q2[$student->idStudent] = 0;
                $pp3q2[$student->idStudent] = 0;
                $pExamenesQ2[$student->idStudent] = 0;
                $pPromediosQ2[$student->idStudent] = 0;
                $pPromediosTotal[$student->idStudent] = 0;
                $pPromediosTotalRecup[$student->idStudent] = 0;
                $pPromediosTotalFinal[$student->idStudent] = 0;
            }

            foreach($matters as $matter){
                $unidades2 = $unidades_a->where('identificador','q2')->first();
                $parcialP2 = ParcialPeriodico::parcialP($unidades2->id);
                foreach ($parcialP2 as $par2) {//creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par2->identificador) {
                    case 'p1q2':
                        $promediosP1Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1q2');
                        break;
                    case 'p2q2':
                          $promediosP2Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2q2');
                        break;
                    case 'p3q2':
                        $promediosP3Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3q2');
                        break;
                    case 'q2':
                        $examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id,'q2');
                        $recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id,'q2');
                        break;
                }
            }
                $promediosTotalQ2[$matter->id] = [];
                $promediosFinalQ2[$matter->id] = [];
                $division2 = count($parcialP2)-1;
            $P1q2=0; $P2q2=0; $P3q2=0; $Exq2=0;
            $variable2 ='';
                foreach($students as $s){
                    if ((isset($promediosP1Q2)) && ($promediosP1Q2 != [])) {
                    $P1q2=$promediosP1Q2[$matter->id][$s->idStudent]['promedio'];
                    $variable2.= '$P1q2 !=0 ';
                }else{
                    $promediosP1Q2 = [];
                }
                if ((isset($promediosP2Q2)) && ($promediosP2Q2 != [])) {
                    $P2q2=$promediosP2Q2[$matter->id][$s->idStudent]['promedio'];
                    $variable2.= ' && $P2q2 !=0 ';
                }else{
                    $promediosP2Q2 = [];
                }
                if ((isset($promediosP3Q2)) && ($promediosP3Q2 != [])) {
                    $P3q2=$promediosP3Q2[$matter->id][$s->idStudent]['promedio'];
                    $variable2.= ' && $P3q2 !=0 ';
                }else{
                    $promediosP3Q2 = [];
                }
                if (isset($examenesQ2)) {
                    $Exq2=$examenesQ2[$matter->id][$s->idStudent];
                    $variable2.= ' && $Exq2 != 0';
                }
                    if($variable){// reemplazar los || por && para que si falta un parcial o examen su promedio salga cero
                    $parciales2 =bcdiv( ($P1q2 +
                        $P2q2 +
                        $P3q2 ) /$division2, '1', 2);
                        $promediosTotalQ2[$matter->id][$s->idStudent] =  bcdiv( ($parciales2 *0.8) + ($examenesQ2[$matter->id][$s->idStudent]*0.2), '1', 2);
                        if($recuperacionQ2[$matter->id][$s->idStudent] > $promediosTotalQ2[$matter->id][$s->idStudent]){
                            $promediosFinalQ2[$matter->id][$s->idStudent] =  bcdiv( $recuperacionQ2[$matter->id][$s->idStudent], '1', 2);
                        }else{
                            $promediosFinalQ2[$matter->id][$s->idStudent] =  $promediosTotalQ2[$matter->id][$s->idStudent];
                        }
                    }else{
                        $promediosTotalQ2[$matter->id][$s->idStudent] = 0;
                        $promediosFinalQ2[$matter->id][$s->idStudent] = 0;
                    }

                }
            }
            foreach($students as $s){

                foreach($matters->where('principal', 1) as $matter){
                $unidades = $unidades_a->where('identificador','q1')->first();
                $parcialP = ParcialPeriodico::parcialP($unidades->id);
                foreach ($parcialP as $par) {//creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par->identificador) {
                    case 'p1q1':
                        $pp1q1[$s->idStudent] += $promediosP1Q1[$matter->id][$s->idStudent]['promedio'];
                        break;
                    case 'p2q1':
                          $pp2q1[$s->idStudent] += $promediosP2Q1[$matter->id][$s->idStudent]['promedio'];
                        break;
                    case 'p3q1':
                         $pp3q1[$s->idStudent] += $promediosP3Q1[$matter->id][$s->idStudent]['promedio'];
                        break;
                    case 'q1':
                        $pExamenesQ1[$s->idStudent] += $examenesQ1[$matter->id][$s->idStudent];
                    $pPromediosQ1[$s->idStudent] += $promediosTotalQ1[$matter->id][$s->idStudent];
                        break;
                }
            }
                $unidades2 = $unidades_a->where('identificador','q2')->first();
                $parcialP2 = ParcialPeriodico::parcialP($unidades2->id);
                foreach ($parcialP2 as $par2) {//creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par2->identificador) {
                    case 'p1q2':
                        $pp1q2[$s->idStudent] += $promediosP1Q2[$matter->id][$s->idStudent]['promedio'];
                        break;
                    case 'p2q2':
                          $pp2q2[$s->idStudent] += $promediosP2Q2[$matter->id][$s->idStudent]['promedio'];
                        break;
                    case 'p3q2':
                          $pp3q2[$s->idStudent] += $promediosP3Q2[$matter->id][$s->idStudent]['promedio'];
                        break;
                    case 'q2':
                       $pExamenesQ2[$s->idStudent] += $examenesQ2[$matter->id][$s->idStudent];
                    $pPromediosQ2[$s->idStudent] += $promediosTotalQ2[$matter->id][$s->idStudent];
                        break;
                }
            }

//                    $pp1q1[$s->idStudent] += $promediosP1Q1[$matter->id][$s->idStudent]['promedio'];
    //                $pp2q1[$s->idStudent] += $promediosP2Q1[$matter->id][$s->idStudent]['promedio'];
      //              $pp3q1[$s->idStudent] += $promediosP3Q1[$matter->id][$s->idStudent]['promedio'];
        //            $pExamenesQ1[$s->idStudent] += $examenesQ1[$matter->id][$s->idStudent];
          //          $pPromediosQ1[$s->idStudent] += $promediosTotalQ1[$matter->id][$s->idStudent];
            //        $pp1q2[$s->idStudent] += $promediosP1Q2[$matter->id][$s->idStudent]['promedio'];
            //        $pp2q2[$s->idStudent] += $promediosP2Q2[$matter->id][$s->idStudent]['promedio'];
            //        $pp3q2[$s->idStudent] += $promediosP3Q2[$matter->id][$s->idStudent]['promedio'];
            //        $pExamenesQ2[$s->idStudent] += $examenesQ2[$matter->id][$s->idStudent];
            //        $pPromediosQ2[$s->idStudent] += $promediosTotalQ2[$matter->id][$s->idStudent];
                }
            }


            $promedioGeneral = [];
            $promedioGeneralRecup = [];
            $supletorios = [];
            $remediales = [];
            $gracias = [];
            $promedioFinalQuimestre =[];
            foreach($matters as $matter){
                $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
                $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
                $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
                foreach($students as $student){

                    if( $promediosTotalQ1[$matter->id][$student->idStudent] != 0 && $promediosTotalQ2[$matter->id][$student->idStudent] != 0 ){
                        $promedioGeneral[$matter->id][$student->idStudent] = bcdiv( ($promediosTotalQ1[$matter->id][$student->idStudent] + $promediosTotalQ2[$matter->id][$student->idStudent])/2, '1', 2);
                        $promedioGeneralRecup[$matter->id][$student->idStudent] = bcdiv( ($promediosFinalQ1[$matter->id][$student->idStudent] + $promediosFinalQ2[$matter->id][$student->idStudent])/2, '1', 2);

                    }else{
                        $promedioGeneral[$matter->id][$student->idStudent] = 0;
                        $promedioGeneralRecup[$matter->id][$student->idStudent] = 0;

                    }

                    if($promedioGeneralRecup [$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent] &&
                            $remediales[$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent] &&
                            $gracias[$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent]){

                        $promedioFinalQuimestre[$matter->id][$student->idStudent] = $supletorios[$matter->id][$student->idStudent];

                    }else if($promedioGeneralRecup [$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent] &&
                            $supletorios[$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent] &&
                            $gracias[$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent]){

                        $promedioFinalQuimestre[$matter->id][$student->idStudent] = $remediales[$matter->id][$student->idStudent];

                    }else if($promedioGeneralRecup [$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent] &&
                            $remediales[$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent] &&
                            $supletorios[$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent]){
                            $promedioFinalQuimestre[$matter->id][$student->idStudent] = $gracias[$matter->id][$student->idStudent];
                    }else{
                        $promedioFinalQuimestre[$matter->id][$student->idStudent] = $promedioGeneralRecup[$matter->id][$student->idStudent];
                    }
                    if($matter->principal == 1){
                        $pPromediosTotal[$student->idStudent] += $promedioGeneral[$matter->id][$student->idStudent];
                        $pPromediosTotalRecup[$student->idStudent] += $promedioGeneralRecup[$matter->id][$student->idStudent];
                        $pPromediosTotalFinal[$student->idStudent] += $promedioFinalQuimestre[$matter->id][$student->idStudent];
                    }

                }
            }
        #endsection
        if($tipo_libreta=='0'){
			$pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual',
				compact('students', 'curso', 'confDHI','dhi','tutor', 'nombre_representante_libreta_parcial',
				'confComportamiento','materiasFijas', 'materiasExtra', 'institution', 'notasMenores',
				'nota_menor','faltasJustificadas', 'faltasInjustificadas', 'atrasos',
				'periodo','count','unidades_a'
            ))->setOrientation('landscape');
        } else {
			$pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual2',
				compact('confComportamiento','students', 'curso', 'confDHI','dhi','totalAsistenciaDelCurso','tutor',
				'materiasFijas', 'nombre_representante_libreta_parcial','materiasExtra', 'institution', 'notasMenores', 'nota_menor',
				'faltasJustificadas', 'faltasInjustificadas', 'atrasos',
				'periodo','count','unidades_a'
            ));
        }

        return $pdf->download('Libreta Anual.pdf');
    }

    public function libretaAnual2() {
        $institution = Institution::first();

        $pdf = PDF::loadView('pdf.reportes-por-curso.cursos.anual.libreta-anual2', compact(
            'institution'
        ));

        return $pdf->download('Libreta Anual 2.pdf');
    }
}
