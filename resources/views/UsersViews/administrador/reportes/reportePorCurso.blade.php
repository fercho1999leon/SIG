@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
    $unidad = App\UnidadPeriodica::unidadP();
	use App\Student2Profile;
	use App\ConfiguracionSistema;
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <!--<h2 class="title-page">Reporte Por Curso</h2>-->
			<h2 class="title-page">Reporte Por Carrera</h2>
            <select class=" form-control select__header" id="mySelect">
                @foreach($unidad as $und)
                	<optgroup label="{{$und->nombre}}">
                    @php
                    $parcialP = App\ParcialPeriodico::parcialP($und->id);
                    @endphp
                    @foreach($parcialP as $par )
                    	@if(($par->identificador == 'q1') || ($par->identificador == 'q2'))
                    	@else
                       		<option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                    	@endif
                    @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
	</div>
    <div class="row mt-1 mb350">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">               
                    <li class="active">
                       <!-- <a data-toggle="tab" href="#tab-2">Educación General Básica</a> -->
						<a data-toggle="tab" href="#tab-2">{{$nombrecarrera}}</a>
                    </li>                   
                </ul>
                <div class="tab-content">                	
                    <div id="tab-2" class="tab-pane active">
						<div class="reportePorCurso--grid">
							<div class="pined-table-responsive">
								<table class="s-calificaciones reportePorCurso__tabla-reportes">
									@if($regimen=='Regular')
										@foreach ($courses as $course)
											<tr height="50">
												<td width="15%" class="text-center uppercase bold no-border"> {{$course->grado}} </td>
												<td width="15%" class="text-center uppercase bold no-border"> {{$course->paralelo}} </td>
												<td width="15%" class="text-center uppercase bold no-border">
													<div class="pinedTooltip text-left">
														<img src="{{secure_asset('img/icono persona.png')}}" width="20" alt="">
														@foreach ($docentes->where('id', $course->idProfesor) as $docente)
															{{$docente->nombres}} {{$docente->apellidos}}
														@endforeach
													</div>
												</td>
												<td width="15%" class="text-center uppercase bold no-border">
													@php
														$estudiantesMujeres = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                                                            ->select('students2_profile_per_year.idCurso', 'students2.sexo')
                                                            ->where([
                                                                'students2_profile_per_year.idCurso' => $course->id,
                                                                'students2_profile_per_year.retirado' => 'NO',
                                                                'students2.sexo' => 'Femenino',
                                                            ])
                                                            ->whereIn('tipo_matricula', ['Ordinaria', 'Extraordinaria'])
                                                            ->get();

														$estudiantesHombres = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
															->select('students2_profile_per_year.idCurso', 'students2.sexo')
															->where([
                                                                'students2_profile_per_year.idCurso' => $course->id,
                                                                'students2_profile_per_year.retirado' => 'NO',
                                                                'students2.sexo' => 'Masculino',
                                                            ])
                                                            ->whereIn('tipo_matricula', ['Ordinaria', 'Extraordinaria'])
															->get();
													@endphp
													<div class="flex" >
														<p style="width:35px" class="mb-0">
															<img src="{{secure_asset('img/mujerS.svg')}}" width="23" alt="">{{count($estudiantesMujeres)}}
														</p>
														<p style="width:35px" class="mb-0">
															<img src="{{secure_asset('img/hombreS.svg')}}" width="23" alt="">{{count($estudiantesHombres)}}
														</p>
													</div>
												</td>
												<td width="30%" class="text-center uppercase bold no-border">

											@if( $course->grado=='Primer Semestre' && null)
											<select name="" id="select__reportes" class="form-control reportePorCurso--select">
												<option value="">Escoja un reporte...</option>
												<optgroup label="Parcial">
													<option value="{{ route('destrezaCurso', ['curso' => $course->id, 'parcial' => $parcial]) }}">Boletin de calificaiones</option>
													{{-- <option value="{{ route('cuadroInformeInicial', ['curso' => $course->id, 'quimestre' => $parcial]) }}">Cuadro Informe</option> --}}
												</optgroup>
												<optgroup label="Semestral">
													<option value="{{ route('libretaQuimestralGeneral', ['curso' => $course->id, 'parcial' => $parcial]) }}">Boletin de calificaiones</option>
													<option value="{{ route('informeQuimestralDestrezas', ['curso' => $course->id, 'parcial' => $parcial]) }}">Informe Cualitativo Quimestral Detallado</option>
												</optgroup>
												<optgroup label="Anual">
													<option value="{{ route('reporteEstudiantesCedula', [$course,'varios=0']) }}">Reporte de estudiantes con numero de cédula</option>
													<option value="{{ route('reporteEstudiantesCedula', [$course,'varios=1']) }}">Reporte de estudiantes con numero de cédula y varios</option>
													<option value="{{ route('reporteDatosCas', $course) }}">Reporte Datos Cas</option>
													<option value="{{ route('nominaEstudiantil', $course->id)}}">Nómina estudiantil</option>
													<option value="{{ route('listadoAsistencia2', $course->id)}}">Reporte asistencia</option>
													<option value="{{ route('informeAnualDestrezas', ['curso' => $course->id, 'parcial' => $parcial]) }}">Informe Anual Cualitativo</option>
													<!---<option value="{{ route('informeFinalDestrezas', ['curso' => $course->id]) }}">Informe Cualitativo Final</option>
													<option value="{{ route('informeAnualDestrezasDetalladas', ['curso' => $course->id]) }}">Informe Cualitativo Final Detallado</option> <-->
													<option value="{{route('reporte.datosVarios', $course->id)}}">Datos Varios</option>
												<optgroup label="Excel">
													<option value="{{route('excel.show' , $course->id)}}">Aulas Virtuales</option>
												</optgroup>
											</select>
											
											@elseif(null && ($course->grado=='Segundo Semestre' || $course->grado=='Tercer Semestre' || $course->grado=='Cuarto Semestre' || $course->grado=='Quinto Semestre' || $course->grado=='Sexto Semestre' || $course->grado=='Septimo Semestre') )
														<select name="" id="select__reportes" class="form-control reportePorCurso--select">
															<option value="">Escoja un reporte...</option>
															<optgroup label="Parcial">
																{{-- <option value="{{route('reporteActaDeControlDeInsumos-curso', [$course, $parcial])}}">Acta de Control de Insumos</option> --}}
																<option value="{{ route('actaCalificacionesGeneral', ['curso' => $course->id, 'parcial' => $parcial])}}">Reporte General</option>
																<!--
																<option value="{{ route('EstadisticasPorParcial', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Estadísticas</option>
																<option value="{{ route('calificacionesPendientes', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Calificaciones pendiente</option>
																<option value="{{ route('ResumenCalificaciones', ['curso' => $course->id, 'parcial' => $parcial])}}">Resumen de calificaciones</option>
																<option value="{{ route('RefuerzoAcademicoReporteCurso', ['curso' => $course->id, 'parcial' => $parcial])}}">Refuerzo Académico</option>
																<option value="{{ route('cuadroCalificacionesCurso', ['curso' => $course->id, 'parcial' => $parcial])}}">Cuadro de calificaciones</option>
																{{-- <option value="{{ route('evaluacionesPendientes', ['curso' => $course->id, 'parcial' => $parcial])}}">Evaluaciones Pendientes</option> --}}
																<option value="{{ route('reporteEstudiantes', ['idCurso' => $course->id, 'parcial' => $parcial]) }}">Boletin</option>
																<option value="{{ route('libretaParcialConRefuerzo',['idCurso' => $course->id, 'parcial' => $parcial])}}">Libreta RA</option> -->
															</optgroup>
															<optgroup label="Semestral">
																<option value="{{ route('EstadisticasQuimestre', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Estadísticas</option>
																<option value="{{ route('cuadroDeHonor', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Cuadro de honor</option>
																<option value="{{ route('ResumenCalificacionesQuimestre', ['curso' => $course->id, 'parcial' => $parcial])}}">Resumen de calificaciones</option>
																<!--<option value="{{ route('calificacionesPendienteExamen', ['idCurso' => $course->id, 'quimestre' => substr($parcial,2,2)])}}">Calificaciones Pendientes</option>-->
																<option value="{{ route('cuadroGeneralCursoQuimestre', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Cuadro de calificaciones</option>
																<option value="{{ route('libretaQuimestre', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2) ])}}">Libreta</option>
																<option value="{{ route('examenesPendientes', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2) ])}}">Calificaciones Pendientes</option>
															</optgroup>
															<optgroup label="Anual">
																<option value="{{ route('reporteEstudiantesCedula', [$course,'varios=0']) }}">Reporte de estudiantes con numero de cédula</option>
																<option value="{{ route('reporteEstudiantesCedula', [$course,'varios=1']) }}">Reporte de estudiantes con numero de cédula y varios</option>
																<option value="{{ route('reporteDatosCas', $course) }}">Reporte Datos Cas</option>
																<option value="{{ route('nominaEstudiantil', $course->id)}}">Nomina de estudiantes</option>
																<option value="{{ route('listadoAsistencia2', $course->id)}}">Reporte asistencia</option>
																<option value="{{ route('libretaAnual', $course->id)}}">Libreta</option>
																<option value="{{ route('reportePromedio', $course->id)}}">Reporte de promedio</option>
																{{-- <option value="{{ route('reportePromedioExcel', $course->id)}}">Reporte de promedio excel</option> --}}
																<option value="{{ route('reportePromedioClases', $course->id)}}">Reporte de promedio por clase</option>
																<option value="{{ route('reporteRecuperacion', $course->id)}}">Reporte de recuperación</option>
																<option value="{{ route('reporteSupletorio', $course->id)}}">Reporte de supletorio</option>
																<option value="{{ route('reporteRemedial', $course->id)}}">Reporte de remedial</option>
																<option value="{{ route('reporteGracia', $course->id)}}">Reporte de gracia</option>
																<option value="{{ route('certificadoPromocionCurso', $course->id)}}">Certificado de promoción</option>
																<option value="{{ route('certificadoPaseEstudianteCurso', $course->id)}}">Certificado de pase de año</option>
																<option value="{{ route('sabana', ['curso' => $course->id, 'reporte' => 0]) }}">Sábanas</option>
																<option value="{{ route('sabana', ['curso' => $course->id, 'reporte' => 2]) }}">Sábana supletorio</option>
                                                                <option value="{{  route('sabana', ['curso' => $course->id, 'reporte' => 3]) }}">Sábana remedial</option>
                                                                <option value="{{route('reporte.datosVarios', $course->id)}}">Datos Varios</option>
                                                              <!-- </optgroup>
															<optgroup label="Excel">
															<option value="{{route('excel.show' , $course->id)}}">Aulas Virtuales</option>
															</optgroup>-->
														</select>
													@else
														<select name="" id="select__reportes" class="form-control reportePorCurso--select">
															<option value="">Escoja un reporte...</option>
															<optgroup label="Estadistica">
																{{-- <option value="{{route('reporteActaDeControlDeInsumos-curso', [$course, $parcial])}}">Acta de Control de Insumos</option> --}}
																
																<option value="{{ route('EstadisticasPorParcial', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Estadísticas</option>
																<!--
																<option value="{{ route('actaCalificacionesGeneral', ['curso' => $course->id, 'parcial' => $parcial])}}">Reporte General</option>
																	<option value="{{ route('calificacionesPendientes', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Calificaciones pendiente</option>
																<option value="{{ route('ResumenCalificaciones', ['curso' => $course->id, 'parcial' => $parcial])}}">Resumen de calificaciones</option>
																<option value="{{ route('RefuerzoAcademicoReporteCurso', ['curso' => $course->id, 'parcial' => $parcial])}}">Refuerzo Académico</option>
																<option value="{{ route('cuadroCalificacionesCurso', ['curso' => $course->id, 'parcial' => $parcial])}}">Cuadro de calificaciones</option>

																{{-- <option value="{{ route('evaluacionesPendientes', ['curso' => $course->id, 'parcial' => $parcial])}}">Evaluaciones Pendientes</option> --}}

																<option value="{{ route('reporteEstudiantes', ['idCurso' => $course->id, 'parcial' => $parcial]) }}">Boletin</option>
																<option value="{{ route('libretaParcialConRefuerzo',['idCurso' => $course->id, 'parcial' => $parcial])}}">Boletin RA</option> -->
															</optgroup>
															<!--
															<optgroup label="Semestral">
																
																<option value="{{ route('ResumenCalificacionesQuimestre', ['curso' => $course->id, 'parcial' => $parcial])}}">Resumen de calificaciones</option>
																<!--
																<option value="{{ route('cuadroDeHonor', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Cuadro de honor</option>
																
																<option value="{{ route('calificacionesPendienteExamen', ['idCurso' => $course->id, 'quimestre' => substr($parcial,2,2)])}}">Calificaciones Pendientes</option>
																<option value="{{ route('cuadroGeneralCursoQuimestre', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Cuadro de calificaciones</option>
																<option value="{{ route('libretaQuimestre', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2) ])}}">Boletin</option>
																<option value="{{ route('examenesPendientes', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2) ])}}">Calificaciones Pendientes</option>
															
															</optgroup>
														-->
															<optgroup label="Estudiantes">
																<option value="{{ route('reporteEstudiantesCedula', [$course,'varios=0']) }}">Reporte de estudiantes con numero de cédula</option>
																<option value="{{ route('reporteEstudiantesCedula', [$course,'varios=1']) }}">Reporte de estudiantes con numero de cédula y varios</option>
																<option value="{{ route('listadoAsistencia2', $course->id)}}">Reporte asistencia</option>

																<!--
																<option value="{{ route('reporteDatosCas', $course) }}">Reporte Datos Cas</option>
																<option value="{{ route('nominaEstudiantil', $course->id)}}">Nomina de estudiantes</option>
																
																<option value="{{ route('libretaAnual', $course->id)}}">Boletin</option>
																<option value="{{ route('reportePromedio', $course->id)}}">Reporte de promedio</option>
																{{-- <option value="{{ route('reportePromedioExcel', $course->id)}}">Reporte de promedio excel</option> --}}
																<option value="{{ route('reportePromedioClases', $course->id)}}">Reporte de promedio por clase</option>
																<option value="{{ route('reporteRecuperacion', $course->id)}}">Reporte de recuperación</option>
																<option value="{{ route('reporteSupletorio', $course->id)}}">Reporte de mejoramiento</option>
																<option value="{{ route('reporteRemedial', $course->id)}}">Reporte de remedial</option>
																<option value="{{ route('reporteGracia', $course->id)}}">Reporte de gracia</option>
																<option value="{{ route('certificadoPromocionCurso', $course->id)}}">Certificado de promoción</option>
																<option value="{{ route('certificadoPaseEstudianteCurso', $course->id)}}">Certificado de pase de año</option>
																<option value="{{ route('sabana', ['curso' => $course->id, 'reporte' => 1]) }}">Sábanas</option>
                                                                <option value="{{ route('sabana', ['curso' => $course->id, 'reporte' => 2]) }}">Sábana mejoramiento</option>
                                                                <option value="{{route('reporte.datosVarios', $course->id)}}">Datos Varios</option>
																<option value="{{  route('sabana', ['curso' => $course->id, 'reporte' => 3]) }}">Sábana remedial</option> -->
                                                                
                                                              </optgroup>
														<!--	<optgroup label="Excel">
															<option value="{{route('excel.show' , $course->id)}}">Aulas Virtuales</option>
															</optgroup>-->
														</select>
													@endif
												</td>
											</tr>
											<tr style="background:#ebebed" height="15">
												<td class="no-border" colspan="5"></td>
											</tr>
										@endforeach
									@else
										@foreach ($courses as $course)
											@if($course->grado=='Octavo')
											<tr height="50">
												<td width="15%" class="text-center uppercase bold no-border">{{$course->grado}}</td>
												<td width="15%" class="text-center uppercase bold no-border"> {{$course->paralelo}} </td>
												<td width="15%" class="text-center uppercase bold no-border">
													<div class="pinedTooltip text-left">
														<img src="{{secure_asset('img/icono persona.png')}}" width="20" alt="">
														@foreach ($docentes->where('id', $course->idProfesor) as $docente)
															{{$docente->nombres}} {{$docente->apellidos}}
														@endforeach
													</div>
												</td>
												<td width="15%" class="text-center uppercase bold no-border">
                                                    @php
                                                        $estudiantesMujeres = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                                                            ->select('students2_profile_per_year.idCurso', 'students2.sexo')
                                                            ->where([
                                                                'students2_profile_per_year.idCurso' => $course->id,
                                                                'students2_profile_per_year.retirado' => 'NO',
                                                                'students2.sexo' => 'Femenino',
                                                            ])
                                                            ->whereIn('tipo_matricula', ['Ordinaria', 'Extraordinaria'])
                                                            ->get();

                                                        $estudiantesHombres = Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                                                            ->select('students2_profile_per_year.idCurso', 'students2.sexo')
                                                            ->where([
                                                                'students2_profile_per_year.idCurso' => $course->id,
                                                                'students2_profile_per_year.retirado' => 'NO',
                                                                'students2.sexo' => 'Masculino',
                                                            ])
                                                            ->whereIn('tipo_matricula', ['Ordinaria', 'Extraordinaria'])
                                                            ->get();
                                                    @endphp
													<div class="flex" >
														<p style="width:35px" class="mb-0">
															<img src="{{secure_asset('img/mujerS.svg')}}" width="23" alt="">{{count($estudiantesMujeres)}}
														</p>
														<p style="width:35px" class="mb-0">
															<img src="{{secure_asset('img/hombreS.svg')}}" width="23" alt="">{{count($estudiantesHombres)}}
														</p>
													</div>
												</td>
												<td width="30%" class="text-center uppercase bold no-border">
													<select name="" id="select__reportes" class="form-control reportePorCurso--select">
														<option value="">Escoja un reporte...</option>
														<optgroup label="Parcial">
															{{-- <option value="{{route('reporteActaDeControlDeInsumos-curso', [$course, $parcial])}}">Acta de Control de Insumos</option> --}}
															<option value="{{ route('actaCalificacionesGeneral', ['curso' => $course->id, 'parcial' => $parcial])}}">Reporte General</option>
															<option value="{{ route('EstadisticasPorParcial', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Estadísticas</option>
															<option value="{{ route('ResumenCalificaciones', ['curso' => $course->id, 'parcial' => $parcial])}}">Resumen de calificaciones</option>
															<option value="{{ route('cuadroCalificacionesCurso', ['curso' => $course->id, 'parcial' => $parcial])}}">Cuadro de calificaciones</option>
															{{-- <option value="{{ route('evaluacionesPendientes', ['curso' => $course->id, 'parcial' => $parcial])}}">Evaluaciones Pendientes</option> --}}
															<option value="{{ route('reporteEstudiantes', ['idCurso' => $course->id, 'parcial' => $parcial]) }}">Boletin</option>
														</optgroup>
														<optgroup label="Semestral">
															<!--<option value="{{ route('EstadisticasQuimestre', ['idCurso' => $course->id, 'parcial' => $parcial])}}">Estadísticas</option>-->
															<option value="{{ route('ResumenCalificacionesQuimestre', ['curso' => $course->id, 'parcial' => $parcial])}}">Resumen de calificaciones</option>
															<!--<option value="{{ route('calificacionesPendienteExamen', ['idCurso' => $course->id, 'quimestre' => substr($parcial,2,2)])}}">Calificaciones Pendientes</option>-->
															<option value="{{ route('libretaQuimestre', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2) ])}}">Boletin</option>
															<option value="{{ route('examenesPendientes', ['idCrurso' => $course->id, 'quimestre' =>  substr($parcial,2,2) ])}}">Calificaciones Pendientes</option>
														</optgroup>
														<optgroup label="Anual">
															<option value="{{ route('nominaEstudiantil', $course->id)}}">Nomina de estudiantes</option>
															<option value="{{ route('listadoAsistencia2', $course->id)}}">Reporte asistencia</option>
															<option value="{{ route('libretaAnual', $course->id)}}">Boletin</option>
															<option value="{{ route('reportePromedio', $course->id)}}">Reporte de promedio</option>
															{{-- <option value="{{ route('reportePromedioExcel', $course->id)}}">Reporte de promedio excel</option> --}}
															<option value="{{ route('reportePromedioClases', $course->id)}}">Reporte de promedio por clase</option>
															<option value="{{ route('certificadoPromocionCurso', $course->id)}}">Certificado de promoción</option>
															<option value="{{ route('certificadoPaseEstudianteCurso', $course->id)}}">Certificado de pase de año</option>
															<option value="{{ route('sabana', ['curso' => $course->id, 'reporte' => $parcial]) }}">Sábana</option>
															<option value="{{route('reporte.datosVarios', $course->id)}}">Datos Varios</option>
														</optgroup>
														<optgroup label="Excel">
														<option value="{{route('excel.show' , $course->id)}}">Aulas Virtuales</option>
														</optgroup>
													</select>
												</td>
											</tr>
											<tr style="background:#ebebed" height="15">
												<td class="no-border" colspan="5"></td>
											</tr>
											@endif
										@endforeach

									@endif
								</table>
							</div>
						</div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#mySelect').change(function () {
    window.location.href = "{{ route('reportePorCursoRuta') }}/" +  $('#mySelect').val();
});
</script>
<script>
	const selectReportes = document.querySelectorAll('.reportePorCurso--select');
	if(selectReportes) {
		selectReportes.forEach(e => {
			e.addEventListener('change', function() {
				$url = e.value
				if($url) {
					window.open($url, '_blank');
				}
			})
		});
	}
</script>
@endsection