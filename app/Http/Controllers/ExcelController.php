<?php

namespace App\Http\Controllers;

use App\Student2Profile;
use Maatwebsite\Excel\Facades\Excel;
use App\Course;
use App\Activity;
use App\Area;
use App\Institution;
use Sentinel;
use Exception;
use App\PeriodoLectivo;
use App\Student2;
use App\Administrative;
use App\Calificacion;
use App\ConfiguracionSistema;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use App\Cliente;
use App\Parents;
use App\AsistenciaParcial;
use App\Supply;
use App\User;
use App\Payment;
use App\Usuario;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use Chumper\Zipper\Facades\Zipper;
use DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\MatriculaController;
use App\Http\Requests\StudentRequest;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class ExcelController extends Controller
{
    public function index()
    {
        Excel::create('Datos Alumnos', function ($excel) {
            $data = Student2Profile::getStudentAll();

            $excel->setTitle('Datos Alumnos');

            $excel->setCreator('José Ramírez')->setCompany('PINED');

            $excel->setDescription('Exportable de estudiantes por curso');

            $excel->sheet('Datos Alumnos', function ($sheet) use ($data) {
                $sheet->setOrientation('landscape');
                $sheet->fromArray($data, null, 'A1');
            });
        })->export('xls');
    }


    public function show($idCurso)
    {
        Excel::create('Datos Alumnos', function ($excel) use ($idCurso) {
            $course = Course::findOrFail($idCurso);

            $institution = Institution::first();
            $students = Student2Profile::getStudentsByCourseUser($idCurso);
            $periodoLectivo= PeriodoLectivo::findOrFail(Sentinel::getUser()->idPeriodoLectivo);
            $excel->setTitle($course->grado.' '.$course->paralelo.' '.$periodoLectivo->nombre.' '.$course->especializacion);
            $excel->setCreator('José Ramírez')->setCompany('ISTRED');
            $excel->setDescription('Exportable de estudiantes por curso');
            $pValue = substr($course->grado.' '.$course->paralelo.' '.$periodoLectivo->nombre.' '.$course->especializacion, 0, 31);
            if ($course->grado=='Segundo' || $course->grado=='Tercero' || $course->grado=='Cuarto' || $course->grado=='Quinto' || $course->grado=='Sexto' || $course->grado=='Septimo' || $course->grado=='Octavo' || $course->grado=='Noveno' || $course->grado=='Decimo' || $course->grado=='SEGUNDO' || $course->grado=='Tercero' || $course->grado=='Cuarto' || $course->grado=='Quinto'|| $course->grado=='SEGUNDO' || $course->grado=='TERCERO' || $course->grado=='CUARTO' || $course->grado=='QUINTO' || $course->grado=='SEXTO' || $course->grado=='SEPTIMO' || $course->grado=='OCTAVO' || $course->grado=='NOVENO' || $course->grado=='DECIMO') {
                $titulo=['username','password','firstname', 'lastname','email','course1','course2','course3','course4', 'course5','course6'];
                $caso=1;
            } elseif ($course->grado=='Primero de Bachillerato' || $course->grado=='Segundo de Bachillerato' || $course->grado=='Tercero de Bachillerato'||$course->grado=='PRIMERO DE BACHILLERATO' || $course->grado=='SEGUNDO DE BACHILLERATO' || $course->grado=='TERCERO DE BACHILLERATO') {
                $titulo=['username','password','firstname', 'lastname','email','course1','course2','course3','course4', 'course5','course6','course7','course8'];
                $caso=2;
            } else {
                $titulo=['username','password','firstname', 'lastname','email'];
                $caso=3;
            }
            $excel->sheet($pValue, function ($sheet) use ($students, $course, $titulo, $caso) {
                $sheet->row(1, $titulo);

                if ($caso ==1) {
                    foreach ($students as $index => $student) {
                        $sheet->row($index+2, [
                    $student->correo, '12345' , $student->nombres, $student->apellidos,$student->correo, 'LENGUA Y LITERATURA',' MATEMATICAS', 'CIENCIAS SOCIALES', 'CIENCIAS NATURALES','INGLES','COMPLEMENTARIA']);
                    }
                } elseif ($caso==2) {
                    foreach ($students as $index => $student) {
                        $sheet->row($index+2, [
                    $student->correo, '12345' , $student->nombres, $student->apellidos,$student->correo, 'LENGUA Y LITERATURA' ,' MATEMATICAS', 'HISTORIA', 'FISICA', 'QUIMICA','BIOLOGIA','INGLES','COMPLEMENTARIA']);
                    }
                } else {
                    foreach ($students as $index => $student) {
                        $sheet->row($index+2, [
                        $student->correo, '12345' , $student->nombres, $student->apellidos,$student->correo]);
                    }
                }
            });
        })->export('xls');
    }


    public function envioMensajes(Request $request)
    {
        $AnioDesde = (int)date("Y", strtotime($request->desde));
        $AnioHasta = (int)date("Y", strtotime($request->hasta));
        if ($AnioDesde>$AnioHasta) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error con las fechas.']);
        }
      
        Excel::create('Datos Alumnos', function ($excel) use ($request) {
            $array[]=array("curso" => "Curso","Apellidos"=>"Apellidos (Estudiante)","Nombres"=> "Nombres (Estudiante)","Total"=>"Valor total de deuda","Rubro"=>"Rubro/Mes","Telefono"=>"Celular del representante","Domicilio"=>"Telefono Domicilio");
            $fDesde = (int)date("m", strtotime($request->desde));
            $fHasta = (int)date("m", strtotime($request->hasta));
            $AnioDesde = (int)date("Y", strtotime($request->desde));
            $AnioHasta = (int)date("Y", strtotime($request->hasta));

            if ($AnioDesde == $AnioHasta) {
                $facturas = DB::table('pago_estudiante_detalles')
            ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
            ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
            ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
            ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->select(
                'students2.nombres',
                'students2.id AS idEstudiante',
                'students2.apellidos',
                'pago_estudiante_detalles.estado',
                'pago_estudiante_detalles.id AS idPagoDetalle',
                'modulo_pagos.mes',
                'pago_estudiante_detalles.updated_at',
                'courses.paralelo',
                'courses.grado',
                'courses.especializacion',
                'modulo_pagos.tipo',
                'modulo_pagos.tipo_emision',
                'modulo_pagos.valor_cancelar',
                'rubros.tipo_rubro'
            )
            ->where([
                ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                ['modulo_pagos.mes', '<=', $fHasta],
                ['modulo_pagos.mes', '>=', $fDesde],
                ['modulo_pagos.anio', '<=', $AnioHasta],
                ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                ['students2_profile_per_year.retirado', '<>', 'SI']
            ])
            ->get();
            } elseif ($AnioDesde < $AnioHasta) {
                // return 'aqui';
                $fDesde_desde = 1;
                $fHasta_hasta = 12;
                $facturas_desde = DB::table('pago_estudiante_detalles')
            ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
            ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
            ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
            ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->select(
                'students2.nombres',
                'students2.id AS idEstudiante',
                'students2.apellidos',
                'pago_estudiante_detalles.estado',
                'pago_estudiante_detalles.id AS idPagoDetalle',
                'modulo_pagos.mes',
                'pago_estudiante_detalles.updated_at',
                'courses.paralelo',
                'courses.grado',
                'courses.especializacion',
                'modulo_pagos.tipo',
                'modulo_pagos.tipo_emision',
                'modulo_pagos.valor_cancelar',
                'rubros.tipo_rubro'
            )
            ->where([
                ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                ['modulo_pagos.mes', '<=', $fHasta_hasta],
                ['modulo_pagos.mes', '>=', $fDesde],
                ['modulo_pagos.anio', '<=', $AnioDesde],
                ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                ['students2_profile_per_year.retirado', '<>', 'SI']
            ])
            ->get();
                $facturas_hasta = DB::table('pago_estudiante_detalles')
            ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
            ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
            ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
            ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
            ->select(
                'students2.nombres',
                'students2.id AS idEstudiante',
                'students2.apellidos',
                'pago_estudiante_detalles.estado',
                'pago_estudiante_detalles.id AS idPagoDetalle',
                'modulo_pagos.mes',
                'pago_estudiante_detalles.updated_at',
                'courses.paralelo',
                'courses.grado',
                'courses.especializacion',
                'modulo_pagos.tipo',
                'modulo_pagos.tipo_emision',
                'modulo_pagos.valor_cancelar',
                'rubros.tipo_rubro'
            )
            ->where([
                ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                ['modulo_pagos.mes', '<=', $fHasta],
                ['modulo_pagos.mes', '>=', $fDesde_desde],
                ['modulo_pagos.anio', '<=', $AnioHasta],
                ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                ['students2_profile_per_year.retirado', '<>', 'SI']
            ])
            ->get();
                $facturas = $facturas_desde->merge($facturas_hasta);
            }
            $becas =  DB::table('becas_descuentos')
                ->join('becas_detalle', 'becas_descuentos.id', '=', 'becas_detalle.idBeca')
                ->select(
                    'becas_detalle.idEstudiante',
                    'becas_descuentos.valor AS valor_beca',
                    'becas_descuentos.tipo AS tipo_beca',
                    'becas_descuentos.tipo_pago AS tipo_pago_beca'
                )
                ->get();
            $detallesId = $facturas->pluck('idPagoDetalle');
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->select(
                    'pago_estudiante_detalles.estado',
                    'pago_estudiante_detalles.id AS idPagoDetalle',
                    'pago_estudiante_detalles.updated_at',
                    'pagos_factura.total AS subtotal',
                    'modulo_pagos.valor_cancelar',
                    'modulo_pagos.mes',
                    'modulo_pagos.tipo',
                    'modulo_pagos.tipo_emision',
                    'modulo_pagos.mes',
                    'abonos.cantidad',
                    'abonos.id',
                    'pagos_factura.numeroFactura',
                    'pagos_factura.id AS idFactura',
                    'pagos_factura.tipo_pago',
                    'pagos_factura.estatus AS estado_factura'
                )
                ->where([
                    //['pagos_factura.estatus', '!=', 'BAJA'],
                    ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                    ['modulo_pagos.mes', '>=', $fDesde],
                    ['modulo_pagos.mes', '<=', $fHasta],
                // ['modulo_pagos.anio', '>=', $AnioDesde],
                    ['modulo_pagos.anio', '<=', $AnioHasta]
                ])
                ->whereIn('pago_estudiante_detalles.id', $detallesId)
                ->get();
            $TsumValorTotal = 0;
            $TsumPagos = 0;
            $TsumDeudaRubros = 0;
            $TsumDeudaSaldos = 0;
            $TsumDeudaTotal = 0;
            $c = 1;
            foreach ($facturas->groupBy('grado') as $key => $grado) {
                foreach ($grado->groupBy('paralelo') as $p => $paralelo) {
                    $sumValorTotal = 0;
                    $sumPagos = 0;
                    $sumDeudaRubros = 0;
                    $sumDeudaSaldos = 0;
                    $sumDeudaTotal = 0;
                    $rubro = "";
                    $mes = "";
                    foreach ($paralelo->groupBy('idEstudiante') as $x => $item) {
                        $c++;
                        $beca = $becas->where('idEstudiante', $item->first()->idEstudiante);
                        $totalCancelar = 0;
                        foreach ($item as $llave => $data) {
                            $valor = $data->valor_cancelar;
                            if (count($beca) > 0 && strtoupper($data->tipo_rubro) == 'PENSION') {
                                foreach ($beca->where('tipo_beca', 'BECA') as $llave => $b) {
                                    if ($b->tipo_pago_beca == "USD") {
                                        $valor = $valor - $b->valor_beca;
                                    }
                                    if ($b->tipo_pago_beca == "PORCENTAJE") {
                                        $valor = $valor - ($valor*($b->valor_beca/100));
                                    }
                                }
                                foreach ($beca->where('tipo_beca', 'DESCUENTO') as $llave => $b) {
                                    if ($b->tipo_pago_beca == "USD") {
                                        $valor = $valor - $b->valor_beca;
                                    }
                                    if ($b->tipo_pago_beca == "PORCENTAJE") {
                                        $valor = $valor - ($valor*($b->valor_beca/100));
                                    }
                                }
                            }
                            $totalCancelar += $valor;
                            switch ($data->mes) {
                                case 1:$mes="Enero";break;
                                case 2:$mes="Febrero";break;
                                case 3:$mes="Marzo";break;
                                case 4:$mes="Abril";break;
                                case 5:$mes="Mayo";break;
                                case 6:$mes="Junio";break;
                                case 7:$mes="Julio";break;
                                case 8:$mes="Agosto";break;
                                case 9:$mes="Septiembre";break;
                                case 10:$mes="Octubre";break;
                                case 11:$mes="Noviembre";break;
                                case 12:$mes="Diciembre";break;
                            }
                            $mes = $data->tipo_rubro."-".$mes.", ";
                            $rubro = $rubro.$mes;
                        }
                        $abono = $abonos->whereIn('idPagoDetalle', $item->pluck('idPagoDetalle'))->sum('cantidad');
                        $deudaSaldos = ($abono == 0) ? 0 : $totalCancelar - $abono;
                        $valorFinal = $deudaSaldos == 0 ? $totalCancelar : $deudaSaldos;
                        $sumValorTotal += $totalCancelar;
                        $sumPagos += $abono;
                        $sumDeudaRubros += ($abono == 0) ? $totalCancelar : 0;
                        $sumDeudaSaldos += $deudaSaldos;
                        $sumDeudaTotal += $valorFinal;
                        //llamo el movil del representante
                        $hijo = Student2Profile::findOrFail($item->first()->idEstudiante);
                        $domicilio = $hijo->telefono_movil;
                        $representante=$hijo->representante;
                        // Se condiciona que no aparezcan estudiantes con deudas en 0 (becas 100%)
                        if ($sumDeudaTotal != 0) {
                            $array[]= array("curso" => $paralelo->first()->grado.' '.$p,"Apellidos"=>$item->first()->apellidos,"Nombres"=> $item->first()->nombres,"Total"=> $sumDeudaTotal,"Rubro"=> $rubro,"Telefono"=>$representante->movil,"Domicilio"=>$domicilio);
                        }
                        $sumValorTotal = 0;
                        $sumPagos = 0;
                        $sumDeudaRubros = 0;
                        $sumDeudaSaldos = 0;
                        $sumDeudaTotal = 0;
                        $rubro = "";
                        $mes = "";
                    }
                }
            }
            $excel->sheet('Enviar Mensaje', function ($sheet) use ($facturas, $becas, $detallesId, $abonos, $array) {
                foreach ($array as $key => $a) {
                    $sheet->row($key+1, [$a['curso'], $a['Apellidos'] , $a['Nombres'], $a['Total'],$a['Rubro'],$a['Telefono'],$a['Domicilio']]);
                }
            });
        })->export('xls');
    }


    public function deudaCurso($curso)
    {
        Excel::create('Datos Alumnos', function ($excel) use ($curso) {
            $array[]=array("curso" => "Curso","Apellidos"=>"Apellidos (Estudiante)","Nombres"=> "Nombres (Estudiante)","Total"=>"Valor total de deuda","Telefono"=>"Celular del representante");
            $curso = Course::findOrFail($curso);
            $date = Carbon::now();
            $AnioHasta = (int)$date->format('Y');
            $fHasta = (int)$date->format('m');
            $students = Student2Profile::getStudentsByCourseUser($curso)->pluck('idStudent');
            $facturas = DB::table('pago_estudiante_detalles')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->select(
                    'students2.nombres',
                    'students2.id AS idEstudiante',
                    'students2.apellidos',
                    'pago_estudiante_detalles.estado',
                    'pago_estudiante_detalles.id AS idPagoDetalle',
                    'modulo_pagos.mes',
                    'pago_estudiante_detalles.updated_at',
                    'courses.paralelo',
                    'courses.grado',
                    'courses.especializacion',
                    'modulo_pagos.tipo',
                    'modulo_pagos.tipo_emision',
                    'modulo_pagos.valor_cancelar',
                    'rubros.tipo_rubro',
                    'courses.id as idCurso'
                )
                ->where([
                    ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                    ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                    ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                    ['modulo_pagos.mes', '<=', $fHasta],
                    ['modulo_pagos.anio', '<=', $AnioHasta],
                    ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                    ['students2_profile_per_year.retirado', '<>', 'SI'],
                    ['courses.id',$curso->id]
                ])
                ->get();
            $becas =  DB::table('becas_descuentos')
                ->join('becas_detalle', 'becas_descuentos.id', '=', 'becas_detalle.idBeca')
                ->select(
                    'becas_detalle.idEstudiante',
                    'becas_descuentos.valor AS valor_beca',
                    'becas_descuentos.tipo AS tipo_beca',
                    'becas_descuentos.tipo_pago AS tipo_pago_beca'
                )
                ->get();
            $detallesId = $facturas->pluck('idPagoDetalle');
            $abonos = DB::table('abonos')
                ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->select(
                    'pago_estudiante_detalles.estado',
                    'pago_estudiante_detalles.id AS idPagoDetalle',
                    'pago_estudiante_detalles.updated_at',
                    'pagos_factura.total AS subtotal',
                    'modulo_pagos.valor_cancelar',
                    'modulo_pagos.mes',
                    'modulo_pagos.tipo',
                    'modulo_pagos.tipo_emision',
                    'modulo_pagos.mes',
                    'abonos.cantidad',
                    'abonos.id',
                    'pagos_factura.numeroFactura',
                    'pagos_factura.id AS idFactura',
                    'pagos_factura.tipo_pago',
                    'pagos_factura.estatus AS estado_factura'
                )
                ->where([
                    //['pagos_factura.estatus', '!=', 'BAJA'],
                    //['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                    //['modulo_pagos.mes', '>=', $fDesde],
                    ['modulo_pagos.mes', '<=', $fHasta],
                    //['modulo_pagos.anio', '>=', $AnioDesde],
                    ['modulo_pagos.anio', '<=', $AnioHasta]
                ])
                ->whereIn('pago_estudiante_detalles.id', $detallesId)
                ->get();
            $TsumValorTotal = 0;
            $TsumPagos = 0;
            $TsumDeudaRubros = 0;
            $TsumDeudaSaldos = 0;
            $TsumDeudaTotal = 0;
            $c = 1;
            foreach ($facturas->groupBy('grado') as $key => $grado) {
                foreach ($grado->groupBy('paralelo') as $p => $paralelo) {
                    $sumValorTotal = 0;
                    $sumPagos = 0;
                    $sumDeudaRubros = 0;
                    $sumDeudaSaldos = 0;
                    $sumDeudaTotal = 0;
                    foreach ($paralelo->groupBy('idEstudiante') as $x => $item) {
                        $c++;
                        $beca = $becas->where('idEstudiante', $item->first()->idEstudiante);
                        $totalCancelar = 0;
                        foreach ($item as $llave => $data) {
                            $valor = $data->valor_cancelar;
                            if (count($beca) > 0 && strtoupper($data->tipo_rubro) == 'PENSION') {
                                foreach ($beca->where('tipo_beca', 'BECA') as $llave => $b) {
                                    if ($b->tipo_pago_beca == "USD") {
                                        $valor = $valor - $b->valor_beca;
                                    }
                                    if ($b->tipo_pago_beca == "PORCENTAJE") {
                                        $valor = $valor - ($valor*($b->valor_beca/100));
                                    }
                                }
                                foreach ($beca->where('tipo_beca', 'DESCUENTO') as $llave => $b) {
                                    if ($b->tipo_pago_beca == "USD") {
                                        $valor = $valor - $b->valor_beca;
                                    }
                                    if ($b->tipo_pago_beca == "PORCENTAJE") {
                                        $valor = $valor - ($valor*($b->valor_beca/100));
                                    }
                                }
                            }
                            $totalCancelar += $valor;
                        }
                        $abono = $abonos->whereIn('idPagoDetalle', $item->pluck('idPagoDetalle'))->sum('cantidad');
                        $deudaSaldos = ($abono == 0) ? 0 : $totalCancelar - $abono;
                        $valorFinal = $deudaSaldos == 0 ? $totalCancelar : $deudaSaldos;
                        $sumValorTotal += $totalCancelar;
                        $sumPagos += $abono;
                        $sumDeudaRubros += ($abono == 0) ? $totalCancelar : 0;
                        $sumDeudaSaldos += $deudaSaldos;
                        $sumDeudaTotal += $valorFinal;
                        //llamo el movil del representante
                        $hijo = Student2Profile::findOrFail($item->first()->idEstudiante);
                        $representante=$hijo->representante;
                        $array[]= array("curso" => $paralelo->first()->grado.' '.$p,"Apellidos"=>$item->first()->apellidos,"Nombres"=> $item->first()->nombres,"Total"=> $sumDeudaTotal,"Telefono"=>$representante->movil);
                        $sumValorTotal = 0;
                        $sumPagos = 0;
                        $sumDeudaRubros = 0;
                        $sumDeudaSaldos = 0;
                        $sumDeudaTotal = 0;
                    }
                }
            }
            $excel->sheet('Enviar Mensaje', function ($sheet) use ($facturas, $becas, $detallesId, $abonos, $array) {
                foreach ($array as $key => $a) {
                    $sheet->row($key, [$a['curso'], $a['Apellidos'] , $a['Nombres'], $a['Total'],$a['Telefono']]);
                }
            });
        })->export('xls');
    }

    public function FacturasCobradas(Request $request)
    {
        try {
            Excel::create('Deudas por Mes', function ($excel) use ($request) {
                $institution = Institution::first();
                $facturas = DB::table('pago_estudiante_detalles')
                ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                ->join('factura_detalles', 'pago_estudiante_detalles.id', '=', 'factura_detalles.idPagoDetalle')
                ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                ->select(
                    'students2.nombres',
                    'students2.id AS idEstudiante',
                    'students2.apellidos',
                    'students2_profile_per_year.idCliente',
                    'pago_estudiante_detalles.estado',
                    'pago_estudiante_detalles.updated_at',
                    'courses.paralelo',
                    'courses.grado',
                    'courses.especializacion',
                    'modulo_pagos.tipo',
                    'modulo_pagos.tipo_emision',
                    'pagos_factura.total AS subtotal',
                    'modulo_pagos.mes',
                    'modulo_pagos.idRubro',
                    'rubros.tipo_emision AS tipo_emision',
                    'factura_detalles.total',
                    'pagos_factura.id AS idFactura',
                    'pagos_factura.numeroFactura',
                    'pagos_factura.tipo_pago',
                    'pagos_factura.idUsuario AS idUsuario',
                    'pagos_factura.estatus',
                    'pagos_factura.claveAcceso',
                    'modulo_pagos.id as idPayment'
                )
                ->where('rubros.tipo_emision', '!=', 'RECIBO')
                ->where('pagos_factura.estatus', null)
                ->where('pago_estudiante_detalles.estado', 'PAGADO')
                ->where('pagos_factura.idPeriodo', $this->idPeriodoUser())
                ->whereDate('pago_estudiante_detalles.updated_at', '>=', $request->desde)
                ->whereDate('pago_estudiante_detalles.updated_at', '<=', $request->hasta)
                ->orderBy('idFactura')
                ->get();

                $array[]=array( "Orden"=>"ORDEN", "FechaE" => "FECHA / HORA DE EMISION", "Cedula"=>"RUC / CEDULA",
                    "Nombres"=> "NOMBRES DEL CLIENTES", "Alumno"=>"ALUMNO (A)", "Serie"=>"SERIE N°", "Factura"=>"FACTURA N°",
                    "Auth"=>"AUTORIZACION", "FechaC"=>"FECHA DE CADUCIDAD", "Estado"=>"ESTADO DE LA FACTURA", "Valor"=>"VALOR DE LA FACTURA",
                    "Cajero"=>"CAJERO (A)", "Anular"=>"MOTIVO DE ANULACION" );
                
                $nombreHoja = 'FACTURAS';
                $c = 1;

                foreach ($facturas as $factura) {
                    $auth = $factura->claveAcceso;
                    $cliente = Cliente::where('id', $factura->idCliente)->first();
                    $cajero = Administrative::find($factura->idUsuario);
                    $caja = $cajero->caja()->first();
                    if ($caja == null) {
                        $caja = '001';
                    }
                    $array[]=array( "Orden"=>$c, "FechaE" => " ", "Cedula"=>$cliente->cedula_ruc,
                        "Nombres"=> $cliente->nombres." ".$cliente->apellidos, "Alumno"=> $factura->nombres." ".$factura->apellidos,
                        "Serie"=> $institution->establecimiento."-".$caja, "Factura"=> $factura->numeroFactura,
                        "Auth"=> $auth, "FechaC"=>" ", "Estado"=> $factura->estado, "Valor"=> $factura->subtotal,
                        "Cajero"=> $cajero->nombres." ".$cajero->apellidos, "Anular"=>" " );
                    $c++;
                }
                $excel->sheet($nombreHoja, function ($sheet) use ($array) {
                    foreach ($array as $key => $a) {
                        $sheet->row($key+1, [ $a['Orden'], $a['FechaE'], $a['Cedula'] , $a['Nombres'], $a['Alumno'], $a['Serie'], $a['Factura'],$a['Auth'],$a['FechaC'],$a['Estado'],$a['Valor'],$a['Cajero'],$a['Anular'] ]);
                    }
                });
            })->export('xls');
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    public function InsumoInstitucion(Request $request)
    {
        try {
            Excel::create('Deudas por Mes', function ($excel) use ($request) {
                switch ($request->mes_insumo) {
                    case 1:$nombreMes = 'ENERO';break;
                    case 2:$nombreMes = 'FEBRERO';break;
                    case 3:$nombreMes = 'MARZO';break;
                    case 4:$nombreMes = 'ABRIL';break;
                    case 5:$nombreMes = 'MAYO';break;
                    case 6:$nombreMes = 'JUNIO';break;
                    case 7:$nombreMes = 'JULIO';break;
                    case 8:$nombreMes = 'AGOSTO';break;
                    case 9:$nombreMes = 'SEPTIEMBRE';break;
                    case 10:$nombreMes = 'OCTUBRE';break;
                    case 11:$nombreMes = 'NOVIEMBRE';break;
                    case 12:$nombreMes = 'DICIEMBRE';break;
                }
                $array[]=array("curso" => "Curso","Apellidos"=>"Apellidos (Estudiante)","Nombres"=> "Nombres (Estudiante)","Total"=>"Valor total de deuda","Telefono"=>"Celular del representante","Mes"=>"Mes de deuda","Rubro"=>"Rubro adeudado");
                $facturas = DB::table('pago_estudiante_detalles')
                    ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                    ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                    ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                    ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                    ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                    ->select(
                        'students2.nombres',
                        'students2.id AS idEstudiante',
                        'students2.apellidos',
                        'pago_estudiante_detalles.estado',
                        'pago_estudiante_detalles.id AS idPagoDetalle',
                        'modulo_pagos.mes',
                        'pago_estudiante_detalles.updated_at',
                        'courses.paralelo',
                        'courses.grado',
                        'courses.especializacion',
                        'modulo_pagos.tipo',
                        'modulo_pagos.tipo_emision',
                        'modulo_pagos.valor_cancelar',
                        'rubros.tipo_rubro'
                    )
                    ->where([
                        ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                        ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                        ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                        ['modulo_pagos.mes', $request->mes_insumo],
                        ['modulo_pagos.idRubro', $request->rubro_insumo],
                        ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                        ['students2_profile_per_year.retirado', '<>', 'SI']
                    ])
                    ->get();
                $becas =  DB::table('becas_descuentos')
                    ->join('becas_detalle', 'becas_descuentos.id', '=', 'becas_detalle.idBeca')
                    ->select(
                        'becas_detalle.idEstudiante',
                        'becas_descuentos.valor AS valor_beca',
                        'becas_descuentos.tipo AS tipo_beca',
                        'becas_descuentos.tipo_pago AS tipo_pago_beca'
                    )
                    ->get();
                $detallesId = $facturas->pluck('idPagoDetalle');
                $abonos = DB::table('abonos')
                    ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                    ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                    ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                    ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                    ->select(
                        'pago_estudiante_detalles.estado',
                        'pago_estudiante_detalles.id AS idPagoDetalle',
                        'pago_estudiante_detalles.updated_at',
                        'pagos_factura.total AS subtotal',
                        'modulo_pagos.valor_cancelar',
                        'modulo_pagos.mes',
                        'modulo_pagos.tipo',
                        'modulo_pagos.tipo_emision',
                        'modulo_pagos.mes',
                        'abonos.cantidad',
                        'abonos.id',
                        'pagos_factura.numeroFactura',
                        'pagos_factura.id AS idFactura',
                        'pagos_factura.tipo_pago',
                        'pagos_factura.estatus AS estado_factura'
                    )
                    ->where([
                            ['modulo_pagos.mes', $request->mes_insumo],
                            ['modulo_pagos.idRubro', $request->rubro_insumo],
                    ])
                    ->whereIn('pago_estudiante_detalles.id', $detallesId)
                    ->get();

                $TsumValorTotal = 0;
                $TsumPagos = 0;
                $TsumDeudaRubros = 0;
                $TsumDeudaSaldos = 0;
                $TsumDeudaTotal = 0;
                $c = 1;
                foreach ($facturas->groupBy('grado') as $key => $grado) {
                    foreach ($grado->groupBy('paralelo') as $p => $paralelo) {
                        $sumValorTotal = 0;
                        $sumPagos = 0;
                        $sumDeudaRubros = 0;
                        $sumDeudaSaldos = 0;
                        $sumDeudaTotal = 0;
                        foreach ($paralelo->groupBy('idEstudiante') as $x => $item) {
                            $c++;
                            $beca = $becas->where('idEstudiante', $item->first()->idEstudiante);
                            $totalCancelar = 0;
                            foreach ($item as $llave => $data) {
                                $valor = $data->valor_cancelar;
                                if (count($beca) > 0 && strtoupper($data->tipo_rubro) == 'PENSION') {
                                    foreach ($beca->where('tipo_beca', 'BECA') as $llave => $b) {
                                        if ($b->tipo_pago_beca == "USD") {
                                            $valor = $valor - $b->valor_beca;
                                        }
                                        if ($b->tipo_pago_beca == "PORCENTAJE") {
                                            $valor = $valor - ($valor*($b->valor_beca/100));
                                        }
                                    }
                                    foreach ($beca->where('tipo_beca', 'DESCUENTO') as $llave => $b) {
                                        if ($b->tipo_pago_beca == "USD") {
                                            $valor = $valor - $b->valor_beca;
                                        }
                                        if ($b->tipo_pago_beca == "PORCENTAJE") {
                                            $valor = $valor - ($valor*($b->valor_beca/100));
                                        }
                                    }
                                }
                                $totalCancelar += $valor;
                            }
                            $abono = $abonos->whereIn('idPagoDetalle', $item->pluck('idPagoDetalle'))->sum('cantidad');
                            $deudaSaldos = ($abono == 0) ? 0 : $totalCancelar - $abono;
                            $valorFinal = $deudaSaldos == 0 ? $totalCancelar : $deudaSaldos;
                            $sumValorTotal += $totalCancelar;
                            $sumPagos += $abono;
                            $sumDeudaRubros += ($abono == 0) ? $totalCancelar : 0;
                            $sumDeudaSaldos += $deudaSaldos;
                            $sumDeudaTotal += $valorFinal;
                            //llamo el movil del representante
                            $hijo = Student2Profile::findOrFail($item->first()->idEstudiante);
                            $representante=$hijo->representante;
                            if ($sumDeudaTotal>0) {//se quitan estudiantes con deuda cero o cuya deuda sea un valor negativo
                                $array[]= array("curso" => $paralelo->first()->grado.' '.$p,"Apellidos"=>$item->first()->apellidos,"Nombres"=> $item->first()->nombres,"Total"=> bcdiv($sumDeudaTotal, '1', 2),"Telefono"=>$representante->movil,"Mes"=>$nombreMes,"Rubro"=>$facturas[0]->tipo_rubro);
                            }
                            $sumValorTotal = 0;
                            $sumPagos = 0;
                            $sumDeudaRubros = 0;
                            $sumDeudaSaldos = 0;
                            $sumDeudaTotal = 0;
                        }
                    }
                }
                $excel->sheet($facturas[0]->tipo_rubro.' '.$nombreMes, function ($sheet) use ($facturas, $becas, $detallesId, $abonos, $array) {
                    foreach ($array as $key => $a) {
                        $sheet->row($key+1, [$a['curso'], $a['Apellidos'] , $a['Nombres'], $a['Total'],$a['Telefono'],$a['Mes'],$a['Rubro']]);
                    }
                });
            })->export('xls');
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    public function reporteDeudoresCursoExcel(Request $request)
    {
        try {
            Excel::create('Deudas por Mes', function ($excel) use ($request) {
                $fDesde = (int)date("m", strtotime($request->desde));
                $fHasta = (int)date("m", strtotime($request->hasta));
                $AnioDesde = (int)date("Y", strtotime($request->desde));
                $AnioHasta = (int)date("Y", strtotime($request->hasta));
                if ($AnioDesde == $AnioHasta) {
                    $facturas = DB::table('pago_estudiante_detalles')
                    ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                    ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                    ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                    ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                    ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                    ->select(
                        'students2.nombres',
                        'students2.id AS idEstudiante',
                        'students2.apellidos',
                        'pago_estudiante_detalles.estado',
                        'pago_estudiante_detalles.id AS idPagoDetalle',
                        'modulo_pagos.mes',
                        'pago_estudiante_detalles.updated_at',
                        'courses.paralelo',
                        'courses.grado',
                        'courses.especializacion',
                        'modulo_pagos.tipo',
                        'modulo_pagos.tipo_emision',
                        'modulo_pagos.valor_cancelar',
                        'rubros.tipo_rubro'
                    )
                    ->where([
                        ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                        ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                        ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                        ['modulo_pagos.mes', '<=', $fHasta],
                        ['modulo_pagos.mes', '>=', $fDesde],
                        ['modulo_pagos.anio', '<=', $AnioHasta],
                        ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                        ['students2_profile_per_year.retirado', '<>', 'SI']
                    ])
                    ->get();
                } elseif ($AnioDesde < $AnioHasta) {
                    $fDesde_desde = 1;
                    $fHasta_hasta = 12;
                    $facturas_desde = DB::table('pago_estudiante_detalles')
                        ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                        ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                        ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                        ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                        ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                        ->select(
                            'students2.nombres',
                            'students2.id AS idEstudiante',
                            'students2.apellidos',
                            'pago_estudiante_detalles.estado',
                            'pago_estudiante_detalles.id AS idPagoDetalle',
                            'modulo_pagos.mes',
                            'pago_estudiante_detalles.updated_at',
                            'courses.paralelo',
                            'courses.grado',
                            'courses.especializacion',
                            'modulo_pagos.tipo',
                            'modulo_pagos.tipo_emision',
                            'modulo_pagos.valor_cancelar',
                            'rubros.tipo_rubro'
                        )
                        ->where([
                            ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                            ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                            ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                            ['modulo_pagos.mes', '<=', $fHasta_hasta],
                            ['modulo_pagos.mes', '>=', $fDesde],
                            ['modulo_pagos.anio', '<=', $AnioDesde],
                            ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                            ['students2_profile_per_year.retirado', '<>', 'SI']
                        ])
                        ->get();
                    $facturas_hasta = DB::table('pago_estudiante_detalles')
                        ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                        ->join('rubros', 'modulo_pagos.idRubro', '=', 'rubros.id')
                        ->join('students2', 'pago_estudiante_detalles.idEstudiante', '=', 'students2.id')
                        ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                        ->join('courses', 'students2_profile_per_year.idCurso', '=', 'courses.id')
                        ->select(
                            'students2.nombres',
                            'students2.id AS idEstudiante',
                            'students2.apellidos',
                            'pago_estudiante_detalles.estado',
                            'pago_estudiante_detalles.id AS idPagoDetalle',
                            'modulo_pagos.mes',
                            'pago_estudiante_detalles.updated_at',
                            'courses.paralelo',
                            'courses.grado',
                            'courses.especializacion',
                            'modulo_pagos.tipo',
                            'modulo_pagos.tipo_emision',
                            'modulo_pagos.valor_cancelar',
                            'rubros.tipo_rubro'
                        )
                        ->where([
                            ['pago_estudiante_detalles.estado', '!=', 'PAGADO'],
                            ['modulo_pagos.idPeriodo', '=', $this->idPeriodoUser()],
                            ['students2_profile_per_year.idPeriodo', '=', $this->idPeriodoUser()],
                            ['modulo_pagos.mes', '<=', $fHasta],
                            ['modulo_pagos.mes', '>=', $fDesde_desde],
                            ['modulo_pagos.anio', '<=', $AnioHasta],
                            ['students2_profile_per_year.tipo_matricula', '<>', 'Pre Matricula'],
                            ['students2_profile_per_year.retirado', '<>', 'SI']
                        ])
                        ->get();
                    $facturas = $facturas_desde->merge($facturas_hasta);
                }

                $becas =  DB::table('becas_descuentos')
                    ->join('becas_detalle', 'becas_descuentos.id', '=', 'becas_detalle.idBeca')
                    ->select(
                        'becas_detalle.idEstudiante',
                        'becas_descuentos.valor AS valor_beca',
                        'becas_descuentos.tipo AS tipo_beca',
                        'becas_descuentos.tipo_pago AS tipo_pago_beca'
                    )
                    ->get();
                $detallesId = $facturas->pluck('idPagoDetalle');

                // Se coloca en otro if y no en el mismo por la variable $detallesId
                if ($AnioDesde == $AnioHasta) {
                    $abonos = DB::table('abonos')
                        ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                        ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                        ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                        ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                        ->select(
                            'pago_estudiante_detalles.estado',
                            'pago_estudiante_detalles.id AS idPagoDetalle',
                            'pago_estudiante_detalles.updated_at',
                            'pagos_factura.total AS subtotal',
                            'modulo_pagos.valor_cancelar',
                            'modulo_pagos.mes',
                            'modulo_pagos.tipo',
                            'modulo_pagos.tipo_emision',
                            'modulo_pagos.mes',
                            'abonos.cantidad',
                            'abonos.id',
                            'pagos_factura.numeroFactura',
                            'pagos_factura.id AS idFactura',
                            'pagos_factura.tipo_pago',
                            'pagos_factura.estatus AS estado_factura'
                        )
                        ->where([
                            ['modulo_pagos.mes', '>=', $fDesde],
                            ['modulo_pagos.mes', '<=', $fHasta],
                            ['modulo_pagos.anio', '>=', $AnioDesde],
                            ['modulo_pagos.anio', '<=', $AnioHasta]
                        ])
                        ->whereIn('pago_estudiante_detalles.id', $detallesId)
                        ->get();
                } elseif ($AnioDesde < $AnioHasta) {
                    $fDesde_desde = 1;
                    $fHasta_hasta = 12;
                    $abonos_desde = DB::table('abonos')
                        ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                        ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                        ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                        ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                        ->select(
                            'pago_estudiante_detalles.estado',
                            'pago_estudiante_detalles.id AS idPagoDetalle',
                            'pago_estudiante_detalles.updated_at',
                            'pagos_factura.total AS subtotal',
                            'modulo_pagos.valor_cancelar',
                            'modulo_pagos.mes',
                            'modulo_pagos.tipo',
                            'modulo_pagos.tipo_emision',
                            'modulo_pagos.mes',
                            'abonos.cantidad',
                            'abonos.id',
                            'pagos_factura.numeroFactura',
                            'pagos_factura.id AS idFactura',
                            'pagos_factura.tipo_pago',
                            'pagos_factura.estatus AS estado_factura'
                        )
                        ->where([
                            ['modulo_pagos.mes', '<=', $fHasta_hasta],
                            ['modulo_pagos.mes', '>=', $fDesde],
                            ['modulo_pagos.anio', '<=', $AnioDesde]
                        ])
                        ->whereIn('pago_estudiante_detalles.id', $detallesId)
                        ->get();
                    $abonos_hasta = DB::table('abonos')
                        ->join('pago_estudiante_detalles', 'pago_estudiante_detalles.id', '=', 'abonos.idPagoDetalle')
                        ->join('modulo_pagos', 'pago_estudiante_detalles.idPago', '=', 'modulo_pagos.id')
                        ->join('factura_detalles', 'abonos.idPagoDetalle', '=', 'factura_detalles.idPagoDetalle')
                        ->join('pagos_factura', 'pagos_factura.id', '=', 'factura_detalles.idFactura')
                        ->select(
                            'pago_estudiante_detalles.estado',
                            'pago_estudiante_detalles.id AS idPagoDetalle',
                            'pago_estudiante_detalles.updated_at',
                            'pagos_factura.total AS subtotal',
                            'modulo_pagos.valor_cancelar',
                            'modulo_pagos.mes',
                            'modulo_pagos.tipo',
                            'modulo_pagos.tipo_emision',
                            'modulo_pagos.mes',
                            'abonos.cantidad',
                            'abonos.id',
                            'pagos_factura.numeroFactura',
                            'pagos_factura.id AS idFactura',
                            'pagos_factura.tipo_pago',
                            'pagos_factura.estatus AS estado_factura'
                        )
                        ->where([
                            ['modulo_pagos.mes', '<=', $fHasta],
                            ['modulo_pagos.mes', '>=', $fDesde_desde],
                            ['modulo_pagos.anio', '<=', $AnioHasta]
                        ])
                        ->whereIn('pago_estudiante_detalles.id', $detallesId)
                        ->get();
                    $abonos = $abonos_desde->merge($abonos_hasta);
                }

                $array[]=array("curso" => "Curso","Apellidos"=>"Apellidos (Estudiante)","Nombres"=> "Nombres (Estudiante)","Total"=>"Valor total de deuda", "Abril" => "Deudas de Abril", "Mayo" => "Deudas de Mayo", "Junio" => "Deudas de Junio", "Julio" => "Deudas de Julio", "Agosto" => "Deudas de Agosto", "Septiembre" => "Deudas de Septiembre", "Octubre" => "Deudas de Octubre", "Noviembre" => "Deudas de Noviembre", "Diciembre" => "Deudas de Diciembre","Enero" => "Deudas de Enero", "Febrero" => "Deudas de Febrero",);

                $c = 1;
                foreach ($facturas->groupBy('grado') as $key => $grado) {
                    foreach ($grado->groupBy('especializacion') as $spec) {
                        foreach ($spec->groupBy('paralelo') as $p => $paralelo) {
                            $sumValorTotal = 0;
                            $sumPagos = 0;
                            $sumDeudaRubros = 0;
                            $sumDeudaSaldos = 0;
                            $sumDeudaTotal = 0;
                            $rubro = "";
                            $mes = "";
                            foreach ($paralelo->groupBy('idEstudiante') as $x => $item) {
                                $c++;
                                $beca = $becas->where('idEstudiante', $item->first()->idEstudiante);
                                $totalCancelar = 0;
                                $enero = $febrero = $marzo = $abril = $mayo = $junio = $julio = $agosto = $septiembre = $octubre = $noviembre = $diciembre = 0;
                                foreach ($item as $llave => $data) {
                                    $valor = $data->valor_cancelar;
                                    if (count($beca) > 0 && strtoupper($data->tipo_rubro) == 'PENSION') {
                                        foreach ($beca->where('tipo_beca', 'BECA') as $llave => $b) {
                                            if ($b->tipo_pago_beca == "USD") {
                                                $valor = $valor - $b->valor_beca;
                                            }
                                            if ($b->tipo_pago_beca == "PORCENTAJE") {
                                                $valor = $valor - ($valor*($b->valor_beca/100));
                                            }
                                        }
                                        foreach ($beca->where('tipo_beca', 'DESCUENTO') as $llave => $b) {
                                            if ($b->tipo_pago_beca == "USD") {
                                                $valor = $valor - $b->valor_beca;
                                            }
                                            if ($b->tipo_pago_beca == "PORCENTAJE") {
                                                $valor = $valor - ($valor*($b->valor_beca/100));
                                            }
                                        }
                                    }
                                    $totalCancelar += $valor;
                                    $abo = $abonos->where('idPagoDetalle', $data->idPagoDetalle)->sum('cantidad');
                                    $valor1 = $valor - $abo;
                                    switch ($data->mes) {
                                        case 1:$mes="Enero";$enero+=$valor1;break;
                                        case 2:$mes="Febrero";$febrero+=$valor1;break;
                                        case 3:$mes="Marzo";$marzo+=$valor1;break;
                                        case 4:$mes="Abril";$abril+=$valor1;break;
                                        case 5:$mes="Mayo";$mayo+=$valor1;break;
                                        case 6:$mes="Junio";$junio+=$valor1;break;
                                        case 7:$mes="Julio";$julio+=$valor1;break;
                                        case 8:$mes="Agosto";$agosto+=$valor1;break;
                                        case 9:$mes="Septiembre";$septiembre+=$valor1;break;
                                        case 10:$mes="Octubre";$octubre+=$valor1;break;
                                        case 11:$mes="Noviembre";$noviembre+=$valor1;break;
                                        case 12:$mes="Diciembre";$diciembre+=$valor1;break;
                                    }
                                    $mes = $data->tipo_rubro."-".$mes.", ";
                                    $rubro = $rubro.$mes;
                                }
                                $abono = $abonos->whereIn('idPagoDetalle', $item->pluck('idPagoDetalle'))->sum('cantidad');
                                $deudaSaldos = ($abono == 0) ? 0 : $totalCancelar - $abono;
                                $valorFinal = $deudaSaldos == 0 ? $totalCancelar : $deudaSaldos;
                                $sumValorTotal += $totalCancelar;
                                $sumPagos += $abono;
                                $sumDeudaRubros += ($abono == 0) ? $totalCancelar : 0;
                                $sumDeudaSaldos += $deudaSaldos;
                                $sumDeudaTotal += $valorFinal;
                                //llamo el movil del representante
                                $hijo = Student2Profile::findOrFail($item->first()->idEstudiante);
                                $domicilio = $hijo->telefono_movil;
                                $representante=$hijo->representante;
                                // Se condiciona que no aparezcan estudiantes con deudas en 0 (becas 100%)
                                if ($sumDeudaTotal != 0) {
                                    $array[]= array("curso" => $paralelo->first()->grado.' '.$paralelo->first()->especializacion.' '.$p, "Apellidos"=>$item->first()->apellidos, "Nombres"=> $item->first()->nombres, "Total"=> $sumDeudaTotal, "Abril"=> $abril, "Mayo"=> $mayo, "Junio"=> $junio, "Julio"=> $julio, "Agosto"=> $agosto, "Septiembre"=> $septiembre, "Octubre"=> $octubre, "Noviembre"=> $noviembre, "Diciembre"=> $diciembre, "Enero"=> $enero, "Febrero"=> $febrero);
                                }
                                $sumValorTotal = 0;
                                $sumPagos = 0;
                                $sumDeudaRubros = 0;
                                $sumDeudaSaldos = 0;
                                $sumDeudaTotal = 0;
                                $rubro = "";
                                $mes = "";
                            }
                        }
                    }
                }

                $excel->sheet($facturas[0]->tipo_rubro, function ($sheet) use ($facturas, $becas, $detallesId, $abonos, $array) {
                    foreach ($array as $key => $a) {
                        $sheet->row($key+1, [$a['curso'], $a['Apellidos'] , $a['Nombres'], $a['Total'], $a['Abril'], $a['Mayo'], $a['Junio'], $a['Julio'], $a['Agosto'], $a['Septiembre'], $a['Octubre'], $a['Noviembre'], $a['Diciembre'], $a['Enero'], $a['Febrero']]);
                    }
                });
            })->export('xls');
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    public function importaractividades(Request $request)
    {
        $this->validate($request, [
               'excel*' => 'required|mimes:xls,xlsx|max:5000',
                ]);
        try {
            $nuevo = Excel::load($request->excel);
            $excelData = $nuevo->all();
            //dd($excelData);
            $numero = $excelData->first()->count();
            $encabezados = (($excelData->first())->keys());
            for ($i=6; $i < $numero - 1 ; $i++) {
                $nombreActividad =  str_replace('_', " ", str_replace('real', "", $encabezados[$i]));
                $nombreActividad = substr($nombreActividad, 0, 5)." : ".substr($nombreActividad, 5);
                $newactivity = Activity::where(['nombre'=>  $nombreActividad, 'idInsumo' => $request->idInsumo2,
                    'parcial' => $request->parcialCOD2])->first();
                if ($newactivity == null) {
                    $newactivity = new Activity;
                }

                $newactivity->nombre    =  $nombreActividad;
                $newactivity->descripcion   =  "Actividad Importada desde plataforma EVA";
                $newactivity->fechaInicio   =  Carbon::now();
                $newactivity->fechaEntrega  =  Carbon::now();
                $newactivity->idPeriodo   =  $this->idPeriodoUser();
                $newactivity->idInsumo = $request->idInsumo2;
                $newactivity->parcial = $request->parcialCOD2;
                $newactivity->recibirTareas = 0;
                $newactivity->calificado =  1;
                $newactivity->save();
                foreach ($excelData as $data) {
                    if ($data['direccion_de_correo']!= null) {
                        $usuario = Administrative::where('correo', 'like', "%{$data['direccion_de_correo']}%")->first();
                        $estudiante = Student2::where('idProfile', $usuario->id)->first();

                        $idEstudiante =$estudiante->profilePerYear->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first();

                        $calificacion = Calificacion::where(['idActividad'=> $newactivity->id, 'idEstudiante' => $idEstudiante->idStudent])->first();
                        if ($calificacion == null) {
                            $calificacion = new Calificacion;
                        }
                        if ($data[$encabezados[$i]] != '-' &&  $data[$encabezados[$i]] != '') {
                            $calificacion->idActividad = $newactivity->id;
                            $calificacion->idEstudiante = $idEstudiante->idStudent;
                            $calificacion->nota = $data[$encabezados[$i]];
                            $calificacion->idPeriodo = $this->idPeriodoUser();
                            $calificacion->idInsumo = $request->idInsumo2;
                            $calificacion->save();
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['error' => $e]);
        }
        return Redirect::back()->with('message', ['type' => 'success', 'text' => 'El archivo con actividades fue importado correctamente']);
    }
    /**
     * IMPORTAR ESTUDIANTES
     * NUEVA MATRIZ
     * @AUTOR FERNANDO LEON
     */
    public function importarestudiantes2(Request $request){
        $this->validate($request, [
            'excel*' => 'required|mimes:xls,xlsx|max:5000',
        ]);
        $errors_headers_matriz = array();
        $errors_matriz_code = array();
        $errors_student_exists = array();
        $errors_date_matriz = array();
        $excelData = Excel::selectSheetsByIndex(0)->load($request->excel)->all();
        //dd($excelData);
        $encabezados = (($excelData->first())->keys());

        foreach($excelData as $data){
            //dd(response($data,200));
            $respuesta_headers = $this->ValidateHeadersMatriz($encabezados);
            $respuesta_headers?array_push($errors_headers_matriz,['numeroidentificacion' => $data['numeroidentificacion'],'msg' => 'cabeceras invalidas','data' => json_encode($respuesta_headers)]):null;
            if(!$respuesta_headers){
                $respuesta_matriz = $this->ValidateMatrizStudent($data);
                $respuesta_student_exists = $this->ValidateStudentExists($data);
                $respuesta_student_exists?array_push($errors_student_exists,['numeroidentificacion' => $data['numeroidentificacion'],'msg' => 'existe en plataforma y en el periodo','data' => $respuesta_student_exists]):null;
                $respuesta_matriz?array_push($errors_matriz_code,['numeroidentificacion' => $data['numeroidentificacion'],'msg' => 'codigo no coincide','data' => json_encode($respuesta_matriz)]):null;
            }
        }
        //dd($errors_student_exists,$errors_matriz_code,$errors_student_exists);
        if(!empty($errors_headers_matriz) && isset($errors_headers_matriz)){
            //dd($errors_headers_matriz);
            return Redirect::back()->withErrors($errors_headers_matriz,'import');
        }elseif((!empty($errors_matriz_code) && isset($errors_matriz_code))){
            //dd($errors_matriz_code);
            return Redirect::back()->withErrors($errors_matriz_code,'import');
        }elseif(!empty($errors_student_exists) && isset($errors_student_exists)){
            //dd($errors_student_exists);
            return Redirect::back()->withErrors($errors_student_exists,'import');
        }else{
            $matricula = new MatriculaController();
            /**
             * Carrera
             * Paralelo
             */
            foreach($excelData as $data){
                try{
                    $dataimport = array();
                    $resq = new StudentRequest();
                    //$resq->request->add($data->all());
                    $dataimport['curso'] = $request->carrera; //carrera //si
                    $dataimport['paralelo'] = $request->paralelo; //si
                    $dataimport['n_identificacion'] = $data->numeroidentificacion;
                    $dataimport['tipoBecaId'] = intval($data->tipobecaid);
                    $dataimport['haRealizadoPracticasPreprofesionales'] = intval($data->harealizadopracticaspreprofesionales);
                    $dataimport['sectorEconomicoPracticaProfesional'] = intval($data->sectoreconomicopracticaprofesional);
                    $dataimport['nroHorasPracticasPreprofesionalesPorPeriodo'] = intval($data->nrohoraspracticaspreprofesionalesporperiodo);
                    $dataimport['entornoInstitucionalPracticasProfesionales'] = intval($data->entornoinstitucionalpracticasprofesionales);
                    $dataimport['participaEnProyectoVinculacionSociedad'] = intval($data->participaenproyectovinculacionsociedad);
                    $dataimport['tipoAlcanceProyectoVinculacionId'] = intval($data->tipoalcanceproyectovinculacionid);
                    $dataimport['ci'] = intval($data->tipodocumentoid);
                    $dataimport['nombres'] = $data->primernombre.' '.$data->segundonombre;
                    $dataimport['apellidos'] = $data->primerapellido.' '.$data->segundoapellido;
                    $dataimport['sexo'] = intval($data->sexoid);
                    
                    $dataimport['ciudad'] = $data->ciudad; //si
                    $dataimport['direccion'] = $data->direccion; //si
                    $dataimport['telefono'] = $data->telefono; //si
                    $dataimport['pais'] = $data->paisnacionalidadid;
                    $dataimport['matricula'] = 'Pre Matricula'; //si
                    $dataimport['institucionAnterior'] = $data->institucionanterior; //si
                    $dataimport['razonCambio'] = $data->razoncambio; //si
                    $dataimport['observaciones'] = $data->observaciones; //si
                    $dataimport['contactoEmergencia'] = $data->contactoemergencia; //si
                    $dataimport['telefonoEmergencia'] = $data->telefonoemergencia;//si
                    $dataimport['parentezco_contacto_emergencia'] = $data->parentezco_contacto_emergencia;//si
                    $dataimport['contactoEmergencia2'] = $data->contactoemergencia2;//si
                    $dataimport['telefonoEmergencia2'] = $data->telefonoemergencia2;//si
                    $dataimport['parentezco_contacto_emergencia2'] = $data->parentezco_contacto_emergencia2;//si
                    $dataimport['bloqueado'] = 0; //si
                    $dataimport['actDesdeAdmisiones'] = 0; //si
                    $dataimport['condicionado'] = 'No'; //si
                    $dataimport['observacion_retirado'] = null; //si
                    $dataimport['documentos_informacion'] = null; //si
                    $dataimport['tipoColegioId'] = intval($data->tipocolegioid);
                    $dataimport['modalidadCarrera'] = intval($data->modalidadcarrera);
                    $dataimport['jornadaCarrera'] = intval($data->jornadacarrera);
                    
                    $dataimport['tipo_matricula'] = intval($data->tipomatriculaid);
                    $dataimport['nivelAcademicoQueCursa'] = intval($data->nivelacademicoquecursa);
                    $dataimport['duracionPeriodoAcademico'] = intval($data->duracionperiodoacademico);
                    $dataimport['haRepetidoAlMenosUnaMateria'] = intval($data->harepetidoalmenosunamateria);
                    $dataimport['haPerdidoLaGratuidad'] = intval($data->haperdidolagratuidad);
                    $dataimport['recibePensionDiferenciada'] = intval($data->recibepensiondiferenciada);
                    $dataimport['estudianteocupacionId'] = intval($data->estudianteocupacionid);
                    $dataimport['ingresosestudianteId'] = intval($data->ingresosestudianteid);
                    $dataimport['bonodesarrolloId'] = intval($data->bonodesarrolloid);
                    $dataimport['ingresoTotalHogar'] = $data->ingresototalhogar;
                    $dataimport['cantidadMiembrosHogar'] = intval($data->cantidadmiembroshogar);
                    $dataimport['nivelFormacionPadre'] = intval($data->nivelformacionpadre);
                    $dataimport['nivelFormacionMadre'] = intval($data->nivelformacionmadre);
                    $dataimport['correo_personal'] = $data->correoelectronico;
                    $dataimport['primeraRazonBecaId'] = intval($data->primerarazonbecaid);
                    $dataimport['segundaRazonBecaId'] = intval($data->segundarazonbecaid);;
                    $dataimport['cuartaRazonBecaId'] = intval($data->cuartarazonbecaid);;
                    $dataimport['quintaRazonBecaId'] = intval($data->quintarazonbecaid);;
                    $dataimport['sextaRazonBecaId'] = intval($data->sextarazonbecaid);;
                    $dataimport['porcientoBecaCoberturaArancel'] = $data->porcientobecacoberturaarancel;
                    $dataimport['porcientoBecaCoberturaManuntencion'] = $data->porcientobecacoberturamanuntencion;
                    $dataimport['financiamientoBeca'] = $data->financiamientobeca;
                    $dataimport['montoAyudaEconomica'] = $data->montoayudaeconomica;
                    $dataimport['montoCreditoEducativo'] = $data->montocreditoeducativo;
                    $dataimport['Tiene_Discapacidad'] = intval($data->discapacidad);
                    $dataimport['Carnet_CONADIS'] = $data->numcarnetconadis;
                    $dataimport['porcentaje_discapacidad'] = $data->porcentajediscapacidad;
                    $dataimport['Tipo_discapacidad'] = intval($data->tipodiscapacidad);
                    $dataimport['Tipo_enfermedad_catastrófica'] = intval($data->Tipo_enfermedad_catastrófica);
                    $dataimport['genero'] = intval($data->generoid);
                    $dataimport['celular_estudiante'] = $data->numerocelular;
                    $dataimport['Estado_Civil'] = intval($data->estadocivilid);
                    $dataimport['Tipos_Sangre'] = intval($data->tiposangre);
                    $dataimport['Etnia_Estudiante'] = intval($data->etniaid);
                    $dataimport['pueblo_nacionalidad'] = intval($data->pueblonacionalidadid);
                    $dataimport['provincia_nacimiento'] = $data->provincianacimientoid;
                    $dataimport['canton_nacimiento'] = $data->canton_nacimiento;
                    $dataimport['pais_recidencia'] = intval($data->paisresidenciaid);
                    $dataimport['provincia_recidencia'] = $data->provinciaresidenciaid;
                    $dataimport['canton_recidencia'] = $data->cantonresidenciaid;
                    $dataimport['tipo_ivienda'] = 'PROPIA'; //si

                    $dataimport['tipoVivienda'] = 'PROPIA'; //si
                    $dataimport['clinica'] = null; //si
                    $dataimport['indicaciones'] = null; //si
                    $dataimport['tipoSangre'] = null; //si
                    $dataimport['transporte'] = null; //si
                    $dataimport['nivelEstudiante'] = null; //si
                    $dataimport['idPadre'] = null; //si
                    $dataimport['idMadre'] = null; //si
                    $dataimport['idRepresentante'] = null; //si
                    $dataimport['provincia'] = null; //si
                    $dataimport['canton'] = null; //si
                    $dataimport['parroquia'] = null; //si
                    $dataimport['actividad_artistica'] = null; //si
                    $dataimport['disciplina_practica'] = null; //si
                    $dataimport['con_quien_vive'] = null; //si
                    $dataimport['nacionalidad'] = null; //si
                    $dataimport['se_va_solo'] = null; //si
                    $dataimport['ingreso_familiar'] = null; //si
                    $dataimport['discapacidad'] = null; //si
                    $dataimport['seguro_institucional'] = null; //si
                    $dataimport['nombre_seguro'] = null; //si
                    $dataimport['inclusion'] = null; //si
                    $dataimport['alergias'] = null; //si
                    $dataimport['enfermedad'] = null; //si
                    $dataimport['fecha_expiracion_pasaporte'] = null; //si
                    $dataimport['fecha_caducidad_pasaporte'] = null; //si
                    $dataimport['fecha_ingreso_pais'] = null; //si
                    $dataimport['celular_estudiante'] = $data->numerocelular; //si
                    $dataimport['estado_civil_padres'] = null; //si
                    $dataimport['idCliente'] = null; //si
                    $dataimport['Estado_Civil'] = null; //si
                    $dataimport['beca'] = null; //si
                    $dataimport['descuentos'] = null; //si
                    $dataimport['tipo_bloqueo'] = null; //si
                    $dataimport['clinica'] = null; //si
                    $dataimport['clinica'] = null; //si
                    $dataimport['clinica'] = null; //si


                    $dataimport['lugarNacimiento'] = $data->canton_nacimiento;

                    try{
                        //dd($data,Carbon::parse($data->fechanacimiento)->format('Y-m-d'));
                        
                        $dataimport['fechaNacimiento'] = $data->fechanacimiento->format('Y-m-d');
                        $dataimport['fechaInicioCarrera'] = $data->fechainiciocarrera->format('Y-m-d');
                        $dataimport['fecha_matriculacion'] = $data->fechamatricula->format('Y-m-d');
                        
                        //Agrega al request
                        $resq->request->add($dataimport);
                        //dd($resq);
                        $matricula->import_excel_all($resq);
                    }catch(Throwable $e){
                        try{
                            $dataimport['fechaNacimiento'] = Carbon::parse($data->fechanacimiento)->format('Y-m-d');
                            $dataimport['fechaInicioCarrera'] = Carbon::parse($data->fechainiciocarrera)->format('Y-m-d');
                            $dataimport['fecha_matriculacion'] = Carbon::parse($data->fechamatricula)->format('Y-m-d');
                            $resq->request->add($dataimport);
                            //dd($resq);
                            $matricula->import_excel_all($resq);
                        }catch(Throwable $e){
                            array_push($errors_date_matriz,['numeroidentificacion' => $data->numeroidentificacion,'error_fechas' => 'error => ','data' => $e->getMessage()]);
                        }
                    }
                }catch(Throwable $e){
                    array_push($errors_date_matriz,['numeroidentificacion' => $data->numeroidentificacion,'msg' => 'error => ','data' => $e->getMessage()]);
                }
            }
            return empty($errors_date_matriz)?Redirect::back():Redirect::back()->withErrors($errors_date_matriz,'import');;
        }
    }

    private function ValidateMatrizStudent($datos){
        $file = json_decode(Storage::disk('local')->get("configuraciones/CODE_MATRIZ.json"));
        $errors = null;
        //dd($datos->numeroidentificacion);
        foreach($datos as $key => $dat){
            foreach($file->matricula as $keyP => $valueP){
                
                if($keyP == $key){
                    $flat = null;
                    foreach($valueP as $valueS){
                        
                        if(intval($dat) === $valueS){
                            $flat = true;
                            continue;
                        }
                    }
                    $msg = 'No coincide el valor: ' . strval($dat);
                    if(!$flat){
                        $errors["numeroidentificacion"] = $datos['numeroidentificacion'];
                        $errors[$keyP] = $msg;
                        
                    }
                }
            }
        }
        return $errors;
    }

    private function ValidateHeadersMatriz($headers){
        $file = json_decode(Storage::disk('local')->get("configuraciones/CODE_MATRIZ.json"));
        $count = 0;
        $errors = array();
        foreach($file->matricula as $key => $data){
            $flat = null;
            foreach($headers as $header){
                if($header == $key){
                    $count++;
                    $flat = true;
                    //$errors[key]
                }
            }
            if(!$flat){
                $errors[$key] = $data;
            }
        }
        if($count == count((array)$file->matricula)){
            return false;
        }
        return $errors;
    }

    private function ValidateStudentExists($datos){  
        $student = Student2::where('ci',$datos['numeroidentificacion'])->first();	
        //dd($student);
        if($student){
            $existeEnPeriodo = Student2Profile::where('idPeriodo', $this->idPeriodoUser())
                                        ->where('idStudent', $student->id)->exists();
            if($existeEnPeriodo)return $arry['numeroidentificacion']=$datos['numeroidentificacion'];
        }
        return null;
    }

    public function importarestudiantes(Request $request)
    {
        $this->validate($request, [
               'excel*' => 'required|mimes:xls,xlsx|max:5000',
                ]);
        DB::beginTransaction();
        $cont =0;
        $cont_act = 0;
        $nuevo = Excel::load($request->excel);
        $excelData = $nuevo->all();
        //dd($excelData);
        foreach ($excelData as $row) {
            if ($row->nombres!='') {
                $cont ++;
                //echo $cont;
                //creación del padre:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                if ($row->ci_padre!=null) {
                    $padre_n = Parents::where('ci', $row->ci_padre)->first();
                    if ($padre_n==null) {
                        $padre_n = new Parents;
                    }
                    $padre_n->ci                   =      $row->ci_padre;
                    $padre_n->nombres              =      $row->nombres_padre;
                    $padre_n->apellidos            =      $row->apellidos_padre;
                    $padre_n->sexo                 =      'Masculino';
                    $padre_n->fNacimiento          =      $row->fnacimiento_padre!= null ? $row->fnacimiento_padre->format('Y-m-d') : '2000-01-01';
                    $padre_n->nacionalidad         =      $row->nacionalidad_padre;
                    $padre_n->correo               =      $row->correo_padre;
                    $padre_n->movil                =      $row->movil_padre;
                    $padre_n->parentezco           =      'Padre';
                    $padre_n->estudios             =      $row->estudios_padre;
                    $padre_n->religion             =      $row->religion_padre;
                    $padre_n->ciudadDomicilio      =      $row->ciudaddomicilio_padre;
                    $padre_n->direccionDomicilio   =      $row->direcciondomicilio_padre;
                    $padre_n->telefonoDomicilio    =      $row->telefonodomicilio_padre;
                    $padre_n->ciudadTrabajo        =      $row->ciudadtrabajo_padre;
                    $padre_n->direccionTrabajo     =      $row->direcciontrabajo_padre;
                    $padre_n->telefonoTrabajo      =      $row->telefonotrabajo;
                    $padre_n->cargoTrabajo         =      $row->cargotrabajo_padre;
                    $padre_n->lugarTrabajo         =      $row->lugartrabajo_padre;
                    $padre_n->fallecido            =      $row->fallecido_padre;
                    $padre_n->estado_civil         =      $row->estado_civil_padre;
                    $padre_n->lugarNacimiento      =      $row->lugarnacimiento_padre;
                    $padre_n->provincia            =      $row->provincia_padre;
                    $padre_n->canton               =      $row->canton_padre;
                    $padre_n->parroquia            =      $row->parroquia_padre;
                    $padre_n->clinica              =      $row->clinica_padre;
                    $padre_n->indicaciones         =      $row->indicaciones_padre;
                    $padre_n->tipoSangre           =      $row->tiposangre_padre;
                    $padre_n->contactoEmergencia   =      $row->contactoemergencia_padre;
                    $padre_n->telefonoEmergencia   =      $row->telefonoemergencia_padre;
                    $padre_n->profesion            =      $row->profesion_padre;
                    $padre_n->idPeriodo            =      Sentinel::getUser()->idPeriodoLectivo;
                    $padre_n->save();
                }

                //creación de la Madre:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

                if ($row->ci_madre!=null) {
                    $madre_n = Parents::where('ci', $row->ci_madre)->first();
                    if ($madre_n==null) {
                        $madre_n = new Parents;
                    }
                    $madre_n->ci                   =      $row->ci_madre;
                    $madre_n->nombres              =      $row->nombres_madre;
                    $madre_n->apellidos            =      $row->apellidos_madre;
                    $madre_n->sexo                 =      'Femenino';
                    $madre_n->fNacimiento          =      $row->fnacimiento_madre!= null ? $row->fnacimiento_madre->format('Y-m-d') : '2000-01-01';
                    $madre_n->nacionalidad         =      $row->nacionalidad_madre;
                    $madre_n->correo               =      $row->correo_madre;
                    $madre_n->movil                =      $row->movil_madre;
                    $madre_n->parentezco           =      'Madre';
                    $madre_n->estudios             =      $row->estudios_madre;
                    $madre_n->religion             =      $row->religion_madre;
                    $madre_n->ciudadDomicilio      =      $row->ciudaddomicilio_madre;
                    $madre_n->direccionDomicilio   =      $row->direcciondomicilio_madre;
                    $madre_n->telefonoDomicilio    =      $row->telefonodomicilio_madre;
                    $madre_n->ciudadTrabajo        =      $row->ciudadtrabajo_madre;
                    $madre_n->direccionTrabajo     =      $row->direcciontrabajo_madre;
                    $madre_n->telefonoTrabajo      =      $row->telefonotrabajo;
                    $madre_n->cargoTrabajo         =      $row->cargotrabajo_madre;
                    $madre_n->lugarTrabajo         =      $row->lugartrabajo_madre;
                    $madre_n->fallecido            =      $row->fallecido_madre;
                    $madre_n->estado_civil         =      $row->estado_civil_madre;
                    $madre_n->lugarNacimiento      =      $row->lugarnacimiento_madre;
                    $madre_n->provincia            =      $row->provincia_madre;
                    $madre_n->canton               =      $row->canton_madre;
                    $madre_n->parroquia            =      $row->parroquia_madre;
                    $madre_n->clinica              =      $row->clinica_madre;
                    $madre_n->indicaciones         =      $row->indicaciones_madre;
                    $madre_n->tipoSangre           =      $row->tiposangre_madre;
                    $madre_n->contactoEmergencia   =      $row->contactoemergencia_madre;
                    $madre_n->telefonoEmergencia   =      $row->telefonoemergencia_madre;
                    $madre_n->profesion            =      $row->profesion_madre;
                    $madre_n->idPeriodo            =      Sentinel::getUser()->idPeriodoLectivo;
                    $madre_n->save();
                }

                //creación del Cliente:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                if ($row->cedula_ruc_cliente!=null) {
                    $cliente_n = Cliente::where('cedula_ruc', $row->cedula_ruc_cliente)->first();
                    if ($cliente_n==null) {
                        $cliente_n = new Cliente;
                    }
                    $cliente_n->cedula_ruc             =      $row->cedula_ruc_cliente;
                    $cliente_n->nombres                =      $row->nombres_cliente;
                    $cliente_n->apellidos              =      $row->apellidos_cliente;
                    $cliente_n->direccion              =      $row->direccion_cliente;
                    $cliente_n->telefono               =      $row->telefono_cliente;
                    $cliente_n->correo                 =      $row->correo_cliente;
                    $cliente_n->parentezco             =      $row->parentezco_cliente != null ? $row->parentezco_cliente : 'Otro';
                    $cliente_n->fecha_nacimiento       =      $row->fecha_nacimiento!= null ? $row->fecha_nacimiento->format('Y-m-d') : '2000-01-01';
                    $cliente_n->telefono_domicilio     =      $row->telefono_domicilio_cliente;
                    $cliente_n->profesion              =      $row->profesion_cliente;
                    $cliente_n->lugar_trabajo          =      $row->lugar_trabajo_cliente;
                    $cliente_n->telefono_trabajo       =      $row->telefono_trabajo_cliente;
                    $cliente_n->nacionalidad           =      $row->nacionalidad_cliente;
                    $cliente_n->idPeriodo              =      Sentinel::getUser()->idPeriodoLectivo;
                    $cliente_n->save();
                }

                //creación del Representante:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

                if ($row->correo_representante!=null) {
                    $representante_n = Administrative::where('correo', TRIM($row->correo_representante))->first();
                    if ($representante_n==null) {
                        $representante_n = new Administrative;
                        $user_sentinel = Usuario::where('email', TRIM($row->correo_representante))->first();
                        $user_sentinel = ['email' => $row->correo_representante,'password' => $row->ci_representante];
                        $user= Sentinel::registerAndActivate($user_sentinel);
                        $role= Sentinel::findRoleByName('Representante');
                        $role->users()->attach($user);
                        $user->idPeriodoLectivo = Sentinel::getUser()->idPeriodoLectivo;
                        $user->save();
                    } else {
                        $user = Usuario::findOrFail($representante_n->userid);
                    }
                    $representante_n->ci    =  $row->ci_representante;
                    $representante_n->nombres   =  $row->nombres_representante;
                    $representante_n->apellidos =  $row->apellidos_representante;
                    $representante_n->sexo  =      $row->sexo_representante;
                    $representante_n->fNacimiento   =  $row->fNacimiento_representante != null ? $row->fNacimiento_representante->format('Y-m-d') : '2000-01-01';
                    $representante_n->correo    =  $row->correo_representante;
                    $representante_n->movil =  $row->movil_representante;
                    $representante_n->dDomicilio    =  $row->direcciondomicilio_representante;
                    $representante_n->tDomicilio    =  $row->telefonodomicilio_representante;
                    $representante_n->cargo =  'Representante';
                    $representante_n->userid   =  $user->id;
                    $representante_n->es_representante   =   1 ;
                    $representante_n->profesion = $row->profesion_representante;
                    $representante_n->lugar_trabajo = $row->lugarTrabajo_representante;
                    $representante_n->telefono_trabajo = $row->telefonotrabajo_representante;
                    $representante_n->fecha_estado_migratorio = $row->fecha_estado_migratorio_representante!= null ? $row->fecha_estado_migratorio_representante->format('Y-m-d') : '';
                    $representante_n->fecha_exp_pasaporte = $row->fecha_expiracion_pasaporte_representante!= null ? $row->fecha_expiracion_pasaporte_representante->format('Y-m-d') : '';
                    $representante_n->fecha_caducidad_pasaporte = $row->fecha_caducidad_pasaporte_representante!= null ? $row->fecha_caducidad_pasaporte_representante->format('Y-m-d') : '';
                    $representante_n->nacionalidad = $row->nacionalidad_representante;
                    $representante_n->save();
                }

                //creación del estudiante en las tablas studen2 y student2_profile_per_year::::::::::::::::::::::::::::::::::::::::::
                $institution = Institution::first();
                $contador_matricula = ConfiguracionSistema::contadorMatricula();
                if ($contador_matricula->valor === '') {
                    return Redirect::back()->withErrors(['login_fail' => 'Antes de matricular a un estudiante, por favor, debe definir el modo de contador de matricula en configuraciones generales.']);
                }

                $course = Course::findOrFail($row->idcurso);
                if (count(Student2::getStudentsByCourse($course->id)) >= $course->cupos) {
                    return Redirect::back()->withErrors(['login_fail' => 'Cupo de estudiantes alcanzado.']);
                }
                $data = Student2::where('ci', $row->ci)->first();
                if ($data==null) {
                    $cont_act++;
                    $data = new Student2();
                }
                $data->ci = $row->ci;
                $data->nombres = TRIM($row->nombres);
                $data->apellidos =TRIM($row->apellidos);
                $data->sexo = $row->sexo;
                $data->fechaNacimiento = $row->fechanacimiento!= null ? $row->fechanacimiento->format('Y-m-d') : '';
                $data->ciudad = $row->ciudad;
                $data->direccion = $row->direccion;
                $data->telefono = $row->telefono;
                $data->nacionalidad = $row->nacionalidad;
                $data->lugarNacimiento = $row->lugarnacimiento;
                $data->tipoVivienda = $row->tipovivienda;
                $data->institucionAnterior = $row->institucionanterior;
                $data->razonCambio = $row->razoncambio;
                $data->observaciones = $row->observaciones;
                $data->clinica = $row->clinica;
                $data->indicaciones = $row->indicaciones;
                $data->tipoSangre = $row->tipoSangre;
                $data->contactoEmergencia = $row->contactoemergencia;
                $data->telefonoEmergencia = $row->telefonoemergencia;
                $data->matricula ='Ordinaria';
                $data->retirado = 'NO';
                // $data->bloqueado = $row->bloqueado;
                $data->seccion = $row->seccion;
                $data->idPadre = isset($padre_n->id)!= null ? $padre_n->id : null;
                $data->idMadre = isset($madre_n->id)!= null ? $madre_n->id : null;
                $data->idRepresentante = $row->correo_representante!=null ? $representante_n->id : '';
                $data->provincia = $row->provincia;
                $data->canton = $row->canton;
                $data->parroquia = $row->parroquia;
                $data->fecha_matriculacion = Carbon::now()->format('Y-m-d');
                $data->save();
                // Registro por año

                $dataProfile = Student2Profile::where('idStudent', $data->id)
             ->where('idPeriodo', $this->idPeriodoUser())
             ->first();
                if ($dataProfile==null) {
                    $dataProfile = new Student2Profile();
                }
                $dataProfile->fecha_matriculacion = Carbon::now()->format('Y-m-d');
                $dataProfile->idCurso = $row->idcurso;
                $dataProfile->idPeriodo = $this->idPeriodoUser();
                $dataProfile->idRepresentante = $row->correo_representante!=null ? $representante_n->id : null;
                $dataProfile->idStudent = $data->id;
                $dataProfile->tipo_matricula = 'Ordinaria';
                $dataProfile->transporte_id = $row->transporte;
                $dataProfile->seccion = $row->seccion;
                $dataProfile->actividad_artistica = $row->actividad_artistica;
                $dataProfile->disciplina_practica = $row->disciplina_practica;
                $dataProfile->ciudad_domicilio = $row->ciudad;
                $dataProfile->direccion_domicilio = $row->direccion;
                $dataProfile->telefono_movil = $row->telefono_movil;
                $dataProfile->tipo_vivienda = $row->tipoVivienda;
                $dataProfile->con_quien_vive = $row->con_quien_vive;
                $dataProfile->nacionalidad = $row->nacionalidad;
                $dataProfile->hospital = $row->clinica;
                $dataProfile->indicaciones = $row->indicaciones;
                $dataProfile->nombre_contacto_emergencia = $row->contactoemergencia;
                $dataProfile->movil_contacto_emergencia = $row->telefonoemergencia;
                $dataProfile->parentezco_contacto_emergencia = $row->parentezco_contacto_emergencia;
                $dataProfile->nombre_contacto_emergencia2 = $row->contactoemergencia2;
                $dataProfile->movil_contacto_emergencia2 = $row->telefonoemergencia2;
                $dataProfile->parentezco_contacto_emergencia2 = $row->parentezco_contacto_emergencia2;
                $dataProfile->ingreso_familiar = $row->ingreso_familiar;
                $dataProfile->seguro_institucional = $row->seguro_institucional;
                $dataProfile->nombre_seguro = $row->nombre_seguro;
                $dataProfile->numero_carnet = $row->numero_carnet;
                $dataProfile->alergias = $row->alergias;
                $dataProfile->enfermedad = $row->enfermedad;
                $dataProfile->fecha_expiracion_pasaporte = $row->fecha_expiracion_pasaporte!= null ? $row->fecha_expiracion_pasaporte->format('Y-m-d') : '';
                $dataProfile->fecha_caducidad_pasaporte = $row->fecha_caducidad_pasaporte!= null ? $row->fecha_caducidad_pasaporte->format('Y-m-d') : '';
                $dataProfile->fecha_ingreso_pais = $row->fecha_ingreso_pais!= null ? $row->fecha_ingreso_pais->format('Y-m-d') : '';
                $dataProfile->celular = $row->celular_estudiante;
                $dataProfile->estado_civil_padres = $row->estado_civil_padres;
                $dataProfile->idCliente = isset($cliente_n->id)!= null ? $cliente_n->id : null;
                $dataProfile->save();
                $this->creacionDeAsistenciaParcial($dataProfile->id, null);



                if ($request->matricula != 'Pre Matricula') {
                    $periodoLectivo = PeriodoLectivo::findOrFail($this->idPeriodoUser());
                    if ($contador_matricula->valor == 'G') {
                        $cont = Student2Profile::query()
                        ->where('idPeriodo', $this->idPeriodoUser())
                        ->where('tipo_matricula', '!=', 'Pre Matricula')
                        ->where('retirado', 'NO')
                        ->count();
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
                        $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4)."-".sprintf("%04d", $cont);
                    } else {
                        $cont = count(Student2Profile::getStudentsBySeccion($dataProfile->course->seccion));
                        $fecha = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now())->year;
                        $dataProfile->numero_matriculacion = substr($periodoLectivo->fecha_inicial, 0, 4)."-".sprintf("%04d", $cont);
                    }
                    // Comprobando si existen deberes existentes en el curso al que se haya matriculado
                    $insumos = Supply::where('idCurso', $dataProfile->idCurso)->get();
                    foreach ($insumos as $insumo) {
                        if ($insumo->activities->isNotEmpty()) {
                            foreach ($insumo->activities as $activity) {
                                if ($activity->recibirTareas === 1) {
                                    $materia = Matter::where('id', $insumo->idMateria)->first();
                                    $deber = new Deber;
                                    $deber->idActividad = $activity->id;
                                    $deber->idPeriodo = $this->idPeriodoUser();
                                    $deber->idEstudiante = $data->id;
                                    $deber->idProfesor = $materia->user->profile->id;
                                    $deber->save();
                                }
                            }
                        }
                    }
                    // Creación de usuario en sentinel
                    $existe_estudiante = Administrative::where('ci', $row->ci)->exists();
                    if (!$existe_estudiante) {
                        $user = new User;
                        $nombres = explode(" ", TRIM($data->nombres));
                        $apellidos = explode(" ", TRIM($data->apellidos));
                        $primerNombre = $this->limpiarString(strtolower($nombres[0]));
                        $primerApellido = $this->limpiarString(strtolower($apellidos[0]));
                        $correo = $this->limpiarString($request->correo);

                        $user_sentinel = [
                    'email' =>  $request->correo ?? $primerNombre.'.'. $primerApellido.$data->id."@pined.ec",
                    'password'  =>  "12345"
                ];

                        $user = Sentinel::registerAndActivate($user_sentinel);
                        $user->idPeriodoLectivo = $this->idPeriodoUser();
                        $user->save();

                        //registra el rol de los usuarios
                        $role = Sentinel::findRoleByName("Estudiante");
                        $role->users()->attach($user);
                        $idProfile = DB::table('users_profile')
                    ->insertGetId([
                        'ci'    =>  $data->ci,
                        'nombres'   =>  $data->nombres,
                        'apellidos' =>  $data->apellidos,
                        'sexo'  =>      $data->sexo,
                        'fNacimiento'   =>  $data->fechaNacimiento,
                        'correo'    => $user->email,
                        'dDomicilio'    =>  $data->dDomicilio,
                        'tDomicilio'    =>  $data->tDomicilio,
                        'cargo' =>  "Estudiante",
                        'userid'   =>  $user->id,
                        'created_at'    =>  date("Y-m-d H:i:s"),
                    ]);
                        $data->idProfile = $idProfile;
                        $data->save();
                    }
                } else {
                    $data->save();
                }
                $dataProfile->save();
                $this->creacionPagos($request->curso, $data, $nextYear = null);
                DB::commit();
            }
        }
        return Redirect::back()->with('message', ['type' => 'success', 'text' => 'El archivo fue importado correctamente total estudiantes:'.$cont.', Estudiantes Nuevos: '.$cont_act]);
    }
    public function creacionDeAsistenciaParcial($idStudent, $idPeriodo)
    {
        $parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
        foreach ($parciales as $parcial) {
            AsistenciaParcial::create([
                'idStudent' => $idStudent,
                'parcial' => $parcial,
                'idPeriodo' => $idPeriodo ?? $this->idPeriodoUser(),
            ]);
        }
    }
    public function creacionPagos($idCurso, Student2 $student, $nextYear)
    {
        $pagos = Payment::where('idCurso', $idCurso)->get();
        foreach ($pagos as $pago) {
            $pagoDetalle = new PagoEstudianteDetalle;
            $pagoDetalle->idPeriodo = $nextYear ?? $this->idPeriodoUser();
            $pagoDetalle->idEstudiante = $student->id;
            $pagoDetalle->estado = "PENDIENTE";
            $pago->pagoEstudianteDetalle()->save($pagoDetalle);
        }
    }
    public function limpiarString($texto)
    {
        $textoLimpio = preg_replace('([^A-Za-z0-9])', '', $texto);
        return $textoLimpio;
    }
    public function reportePromedioExcel($idCurso)
    {
        
        /*
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
        foreach ($matters as $materia) {
                if($materia->idArea == null){
                     return Redirect::back()->withErrors(['error' => 'La materia: '.$materia->nombre.' no tiene area asignada']);
            }
            }
        $num_par=0;
        $unidades_a = UnidadPeriodica::where('activo',1)->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->get();
        foreach ($unidades_a as $unidades) {
            $parcialP[$unidades->id] = ParcialPeriodico::parcialP($unidades->id);
            $num_par +=count($parcialP[$unidades->id]);
        }
        dd($sabana);*/
       
        Excel::create('Datos Alumnos', function ($excel) use ($idCurso) {
            //$sabana = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/sabana/anual/'. $this->idPeriodoUser().'/curso/'.$idCurso)));
            $students = Student2Profile::getStudentsByCourse($idCurso);
            $a_nombres = [];
            $a_materias = ['ESTUDIANTES'];
            foreach ($students as $nombres) {
                array_push($a_nombres, $nombres->nombres);
            }
            $matters = DB::table('matters')->where([
                ['idCurso', '=', $idCurso],
                ['visible', '=', 1],
                ['principal','=',1]])
                ->leftJoin('areas', 'matters.idArea', '=', 'areas.id')
                ->select('matters.*', 'areas.nombre AS nombreArea')
                ->orderBy('matters.posicion')->get();
            foreach ($matters as $materia) {
                array_push($a_materias, $materia->nombre);
            }
            // dd($a_materias);
            $course = Course::find($idCurso);
            $area_pos = Area::areasBySection($course->seccion);//orden de las areas en el descargable
            $tutor = Administrative::find($course->idProfesor);
            $notasMenores = ConfiguracionSistema::notasRojo()->valor;
            $institution = Institution::find(1);
            $periodo = PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo);
            $confComportamiento = ConfiguracionSistema::comportamientoQuimestral();
            $unidades_a = UnidadPeriodica::where('activo', 1)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->get();
            foreach ($unidades_a as $unidades) {
                $parcialP[$unidades->id] = ParcialPeriodico::parcialP($unidades->id);
            }
            //dd($unidades_a);
            /* foreach ($students as $estudiante) {
                 $anual[$estudiante->id]= $sabana->where('estudianteId',$estudiante->id)->first();
             }*/

            $excel->setTitle('Datos Alumnos');

            $excel->setCreator('José Ramírez')->setCompany('PINED');

            $excel->setDescription('Exportable de estudiantes por curso');
            $excel->sheet('Datos Alumnos', function ($sheet) use ($students, $matters, $a_materias, $unidades_a, $parcialP) {
                $col = 1;
                //$sheet->mergeCells($this->cellsToMergeByColsRow($col,$col+9,1));
                /*$sheet->mergeCells("B".(1).":J".(1));
                $sheet->mergeCells("C".(2).":F".(2));
                $sheet->mergeCells("G".(2).":J".(2)); */
                $sheet->setMergeColumn(
                    array(
                    'columns' => array('A'),
                    'rows' => array(
                        array(1,3),
                    )
                    )
                );
                $sheet->setMergeColumn(
                    array(
                    'columns' => array('B'),
                    'rows' => array(
                        array(2,3),
                    )
                    )
                );
                
                $sheet->row(1, $a_materias, 15);
                //->mergeCells($this->cellsToMergeByColsRow($col,$col+9,1));
                //$sheet->mergeCells($this->cellsToMergeByColsRow($col,$col+9,1))->row(1, $a_materias);
                $fila_3 = [];
                $array_notas =[];
                $promedio = [];
                    
                $array_lista = [];
                foreach ($students as $key => $alumno) {
                    $array_estudiante = [$alumno->nombres];
                    $promedios[$alumno->id] = [];
                    // array_push($fila_3, $alumno->nombres);
                    foreach ($matters as $materia) {
                        $promedios[$alumno->id][$materia->id] =[];
                        foreach ($unidades_a as $unidad) {
                            $promedios[$alumno->id][$materia->id][$unidad->id] =[];
                            foreach ($parcialP as $parcial) {
                                foreach ($parcial as $p) {
                                    $promedios[$alumno->id][$materia->id][$unidad->id][$p->id] =10;
                                    $array_estudiante[] = random_int(1, 10);
                                }
                            }
                        }
                    }
                    $array_lista[]= $array_estudiante;
                }
                foreach ($array_lista as $num => $lista) {
                    //dd($lista[0]);
                    $sheet->row($num+4, $lista);
                }
            });
        })->export('xls');
    }
    public function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1)
    {
        $merge = 'A1:A1';
        if ($start>=0 && $end>=0 && $row>=0) {
            $start = \PHPExcel_Cell::stringFromColumnIndex($start);
            $end = \PHPExcel_Cell::stringFromColumnIndex($end);
            $merge = "$start{$row}:$end{$row}";
        }
        return $merge;
    }
}