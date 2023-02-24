@php
	use App\Area;
	use App\Matter;
	$cont_pares =0; //creado para darle el salto de pagina cada dos estudiantes
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Boletin</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style type="text/css">
     .new-page {
       page-break-before: always;
     }
</style>
<body>
	<main>
		@foreach($students->sortBy('apellidos') as $student)
		@include('partials.encabezados.informe-cualitativo-final-novus', [
				'reportName' => 'Informe Cualitativo',
				'periodo' => $periodo,
				'informe' =>'',
				'tipo' =>'QUIMESTRE '.$nQuimestre,
				'course' =>$curso,
				'nombre' => $student->apellidos.' '.$student->nombres
			])
			@foreach($data2 as $data)
				@if($data->estudianteId == $student->id)
					@php
					$cont_pares++;
					@endphp
							<table class="table">
									<tr>
										<td class="text-center bold">ASIGNATURA</td>
										@foreach($parcialP as $parcial)
										@php
										$s_p_p[$parcial->identificador]=0;
										$ver_p_p[$parcial->identificador] = true;
										@endphp
										<td class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">{{$parcial->nombre}}</td>
										@endforeach
										<td  class="text-center bold">PROMEDIO QUIMESTRAL</td>
										<td  class="text-center bold">ESCALA CUALITATIVA</td>
									</tr>
									<tr>
										@foreach($area_pos as $Ap)
											@php
											$materias = $allMatters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
											$n_materias_principales = count($allMatters->where('principal',1));
											@endphp
											@if($materias!= null)
												@foreach($materias as $materia)
													@php
													$ver_m_p[$materia->id] = true;
													@endphp
													@foreach($data->materias as $d_m)
														@if($d_m->materiaId == $materia->id)
															<td  class="bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">{{$materia->nombre}}</td>
															@foreach($parcialP as $parcial)
															@php
															$notas_materia = new \Illuminate\Support\Collection($d_m->parciales);
															$nota = $notas_materia->where('indicador', $parcial->identificador)->first()->promediop;
															$s_p_p[$parcial->identificador] += $materia->principal == 1 ? $nota : 0;
															@endphp
																@if($nota ==0 && $PromedioInsumo == 0 && $materia->principal==1)
																@php
																$ver_p_p[$parcial->identificador] = false;
																$ver_m_p[$materia->id] = false;
																@endphp
																<td></td>
																@else
															<td  class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;"
															@if($nota < 7 && $notasMenores == "1")
																		style="color:red;"
																	@endif>
																{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$nota)['nota'] : bcdiv($nota, '1', 2)}}</td>
																@endif
															@endforeach
															@if($ver_m_p[$materia->id] && $d_m->promedioquimestral !=0 )
															<td  class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;"
															@if($d_m->promedioquimestral < 7 && $notasMenores == "1")
																		style="color:red;"
																	@endif>{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$d_m->promedioquimestral)['nota'] : bcdiv($d_m->promedioquimestral, '1', 2)}}</td>
															@else
															<td></td>
															@endif
															<td  class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">{{$materia->idEstructura!= null ?'': App\Calificacion::notaCualitativaApr($d_m->promedioquimestral)}}</td>
															</tr>
														@endif
													@endforeach
												@endforeach
											@endif
										@endforeach
											<tr>
												<td class="bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;"> PROMEDIO</td>
												@foreach($parcialP as $parcial)
												@if($ver_p_p[$parcial->identificador])
												<td class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;"
												@if($s_p_p[$parcial->identificador]/$n_materias_principales < 7 && $notasMenores == "1")
																		style="color:red;"
																	@endif>{{bcdiv($s_p_p[$parcial->identificador]/$n_materias_principales, '1', 2)}}</td>
												@else
												<td></td>
												@endif
												@endforeach
												<td class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;"
													@if($data->promedioEstudiante < 7 && $notasMenores == "1")
														style="color:red;"
													@endif>
													{{$data->promedioEstudiante!=0 ? bcdiv($data->promedioEstudiante, '1', 2): ''}}
												</td>
												<td class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">{{App\Calificacion::notaCualitativaApr($data->promedioEstudiante)}}</td>
											</tr>
											<tr>
												<td class="bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">COMPORTAMIENTO</td>
												@foreach($parcialP as $parcial)
													@if(strlen($parcial->identificador)>2)
														<td class="text-center bold" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
															@forelse($student->comportamientos->where('parcial',$parcial->identificador)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
															{{$comportamiento->nota}}
															@empty
															-
															@endforelse
														</td>
														@else
														<td></td>
													@endif
												@endforeach
												<td colspan="2" class="text-center" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
													@if($confComportamiento->valor !== 'crear')
														@forelse($student->comportamientos->where('parcial', $parcialP[(count($parcialP)-2)]->identificador)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
															{{$comportamiento->nota}}
														@empty
															-
														@endforelse
													@else
														@forelse($student->comportamientos->where('parcial', $quimestre)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
															{{$comportamiento->nota}}
														@empty
															-
														@endforelse
													@endif
												</td>
											</tr>
							</table>
						@if($curso->seccion == 'EGB' && $curso->grado !='Primero')
							@include('partials.reglamento', [ 'asignaturaCualitativa' => true ,'inicial' => false])
						@else
							@include('partials.reglamento', [ 'asignaturaCualitativa' => false , 'inicial' => false ])
						@endif
								<table class="table">
									<tr>
										<td class="no-border">
											<table class="table">
												<tr>
												<td colspan="2" class="text-center" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">INASISTENCIAS Y ATRASOS</td>
												</tr>
													<tr>
														<td style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">DIAS DE ASISTENCIA</td>
														<td style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
															{{$totalAsistenciaDelCurso}}
														</td>
													</tr>
													@php
														$estudiante = App\Student2Profile::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
															->where('idStudent', $student->id)
															->first();
													@endphp
													@foreach (['atrasos' => 'Atrasos', 'faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas'] as $tipoFalta => $titulo)
														<tr>
															<td style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">{{$titulo}}</td>
															<td style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
																{{$estudiante->asistenciaParcial("p1{$quimestre}")[$tipoFalta] + $estudiante->asistenciaParcial("p2{$quimestre}")[$tipoFalta] +$estudiante->asistenciaParcial("p3{$quimestre}")[$tipoFalta]}}
															</td>
														</tr>
													@endforeach
											</table>
										</td>
										<td class="no-border">
											&nbsp;
										</td>
										<td  class="no-border">
											<table class="table" >
												<tr>
												<td class="text-center" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">OBSERVACIONES</td>
												</tr>
													<tr height="55">
														<td class="text-center" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
																@if($quimestre=='q1')
																	@if($confComportamiento->valor == 'replicar')
																		@forelse($student->comportamientos->where('parcial', 'p2q1')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
																			{{$comportamiento->observacion}}
																		@empty
																		@endforelse
																	@else
																		@foreach($student->comportamientos->where('parcial', 'q1')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
																			@if($comportamiento->observacion != null)
																				{{$comportamiento->observacion}}
																			@endif
																		@endforeach
																	@endif
																@else
																	@if($confComportamiento->valor == 'replicar')
																		@forelse($student->comportamientos->where('parcial', 'p2q2')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
																			{{$comportamiento->observacion}}
																		@empty

																		@endforelse
																	@else
																		@foreach($student->comportamientos->where('parcial', 'q2')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
																			@if($comportamiento->observacion != null)
																				{{$comportamiento->observacion}}
																			@endif
																		@endforeach
																	@endif
																@endif
														</td>
													</tr>
											</table>
										</td>
									</tr>
								</table>
								<table class="table">
									<tr>
										<td width="30%" class="no-border text-center" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
											<hr style="border:1px solid black;">
											{{$institution->representante1}}
											<br> {{$institution->cargo1}}
										</td>
										<td class="no-border" width="5%"></td>
										<td width="30%" class="no-border text-center" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
											<hr style="border:1px solid black;">
											{{ $tutor == null ? "-" : $tutor->nombres }} {{ $tutor == null ? "-" : $tutor->apellidos }}
											<br> {{$tutor == null ? "-" : ($tutor->sexo == 'Masculino' ? 'TUTOR' : 'TUTORA')}}
										</td>
										<td class="no-border" width="5%"></td>
										<td width="30%" class="no-border text-center" style="font-size: {{$curso->seccion == 'EGB' ? '10px' : '8px'}} !important;">
											<hr style="border:1px solid black;">
											@if ($nombre_representante_libreta_parcial->valor == '1')
												@if ($student->representante != null)
													{{$student->representante->nombres}} {{$student->representante->apellidos}}
												@endif
												<br>
											@else
												<br>
											@endif
											REPRESENTANTE
										</td>
									</tr>
								</table>
					<table class="table">
					</table>
					{{-- @if ($cont_pares%2==0) --}}
						<p class="new-page">
					{{-- @endif --}}
				@endif
			@endforeach
		@endforeach
	</main>
</body>
</html>