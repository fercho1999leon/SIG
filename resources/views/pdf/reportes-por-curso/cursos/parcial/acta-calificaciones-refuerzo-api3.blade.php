<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Parcial</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
		@foreach($data->sortBy('apellidos') as $student)
			@include('partials.encabezados.informe-cualitativo-final-novus', [
				'reportName' => 'Informe Cualitativo',
				'periodo' => $periodo,
				'informe' =>'',
				'tipo' =>'PARCIAL '.$n_parcial.' QUIMESTRE '.$nQuimestre,
				'course' =>$curso,
				'nombre' => $student->apellidos.' '.$student->nombres
			])
			@php $visualizar = true; @endphp
			<table class="table m-0">
							<tr>
								<td rowspan="3" class="text-center bold">ASIGNATURA</td>
								<td colspan="{{(count($insumos)*2)}}" class="text-center bold">ACTIVIDADES </td>
								<td rowspan="3" class="text-center bold">SUMA</td>
								<td rowspan="3" class="text-center bold">PROMEDIO INICIAL</td>
								<td colspan="2" rowspan="3" class="text-center bold">PROMEDIO FINAL</td>
							</tr>
							<tr>
								@foreach($insumos as $insumo)
									<td colspan="2" class="text-center bold uppercase">{{$insumo->nombre}}</td>
								@endforeach
							</tr>
							<tr>
								@foreach($insumos as $insumo)
									<td class="text-center bold uppercase">Nota</td>
									<td class="text-center bold uppercase">R</td>
								@endforeach
							</tr>
							<tr>
								@foreach($area_pos as $Ap)
									@php
										$materias = $allMatters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
									@endphp
									@if($materias!= null)
										@foreach($materias as $materia)
											@php
												$s_p_i =0;
												$notas_materia=[];
												$pro_final =[];
											@endphp
											<td>{{$materia->nombre}}</td>
											@foreach($student->parcial as $n_materia)
												@if($n_materia->materiaId == $materia->id)
													@php
														$pro_final[$materia->id] = $n_materia->promedioFinal;
														$pro_inicial[$materia->id] = $n_materia->promedioInicial;
														$notas_materia[$materia->id] = new \Illuminate\Support\Collection($n_materia->insumos);
														$nota=0;
														$refuerzo=0;
													@endphp
													@foreach($insumos as $insumo)
														@php
															$refuerzo = $notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()==null?0:$notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()->refuerzo;
															$nota = $notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()==null?0:$notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()->nota;
															$s_p_i += $nota + $refuerzo;
														@endphp
														@if($nota==0 && $PromedioInsumo == 0 && $materia->principal==1)
															@php
																$visualizar = false;
															@endphp
															<td></td>
														@else
															<td class="text-center"
																@if($nota < 7 && $notasMenores == "1")
																	style="color:red;"
																@endif >
															{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$nota)['nota'] : bcdiv($nota, '1', 2)}}</td>
														@endif
														@if($refuerzo>0)
														<td class="text-center">{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$refuerzo)['nota'] : bcdiv($refuerzo, '1', 2)}}</td>
														@else
														<td class="text-center">0.00</td>
														@endif
													@endforeach
												@endif
											@endforeach
											<td class="text-center"> {{$materia->idEstructura== null ? bcdiv($s_p_i, '1', 2):''}} </td>
											@if($pro_inicial[$materia->id] ==0 && $PromedioInsumo == 0)
												<td></td>
											@else
											<td class="text-center"
													@if($pro_inicial[$materia->id] < 7 && $notasMenores == "1")
														style="color:red;"
													@endif >
													{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$pro_inicial[$materia->id])['nota'] : bcdiv($pro_inicial[$materia->id], '1', 2)}}
												</td>
											@endif
											<td class="text-center">
												{{$materia->idEstructura== null ? App\Calificacion::notaCualitativaApr($pro_final[$materia->id]):''}}
											</td>
											@if($pro_final[$materia->id] ==0 && $PromedioInsumo == 0)
												<td></td>
											@else
												<td class="text-center"
													@if($pro_final[$materia->id] < 7 && $notasMenores == "1")
														style="color:red;"
													@endif >
													{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$pro_final[$materia->id])['nota'] : bcdiv($pro_final[$materia->id], '1', 2)}}
												</td>
											@endif
											</tr>
										@endforeach
									@endif
								@endforeach
							</tr>
							<tr>
								<td class="no-border text-right" colspan="{{(count($insumos)*2) + 3}}">PROMEDIO ACADÉMICO</td>
								@if($visualizar)
								<td class="text-center">{{App\Calificacion::notaCualitativaApr($student->promedio)}}</td>
								<td class="text-center">{{ bcdiv($student->promedio, '1', 2)}}</td>
								@else
									<td class="text-center"></td>
									<td class="text-center"></td>
								@endif
							</tr>
							{{--condicion diseñada exclusivamente para NOVUS--}}
							@if ($institution->ruc==='0992636009001' && $curso->seccion ==='BGU')
								@if($dhi != null && $confDHI->valor == 'PARCIAL' )
									<tr>
										<td class="uppercase bold"> {{$dhi->nombre}} </td>
										<td colspan="8" class="text-center"> {{$dhi[$parcial] ?? '-'}} </td>
									</tr>
								@endif
							@else
								@if($dhi != null && $confDHI->valor == 'PARCIAL')
									<tr>
										<td class="uppercase bold"> {{$dhi->nombre}} </td>
										<td colspan="8" class="text-center"> {{$dhi[$parcial] ?? '-'}} </td>
									</tr>
								@endif
							@endif
							<tr>
								<td class="no-border" colspan="6"></td>
							</tr>
					</td>
				</tr>
			</table>
			@if($curso->seccion == 'EGB' && $curso->grado !='Primero')
				@include('partials.reglamento', [ 'asignaturaCualitativa' => false, 'inicial' => false ])
			@else
				@include('partials.reglamento', [ 'asignaturaCualitativa' => true, 'inicial' => false ])
			@endif
			<table class="table">
									<tr>
										<td class="no-border">
											<table class="table">
												<tr>
													<td colspan="2" class="text-center">OBSERVACIONES</td>
												</tr>
												<tr height="55">
													<td colspan="2" class="text-center">
														<h2 class="uppercase">
															@foreach ($comportamientos->where('idStudent', $student->estudiante->ID)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
																<span class="libreta__pobservaciones-desc">{{$comportamiento->observacion}}</span>
															@endforeach
														</h2>
													</td>
												</tr>
											</table>
										</td>
										<td class="no-border">
											<table class="table">
												<tr>
												<td colspan="2" class="text-center" >INASISTENCIAS Y ATRASOS</td>
												</tr>
												<tr>
													<td>DÍAS DE ASISTENCIA</td>
													<td class="text-center">
														{{ $asistenciaCurso->asistencia }}
													</td>
												</tr>
												@php
													$estudiante = App\Student2Profile::getStudent($student->estudianteId);
												@endphp
												@foreach (['atrasos' => 'Atrasos', 'faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas'] as $tipoFalta => $titulo)
													<tr>
														<td>{{$titulo}}</td>
														<td class="text-center">
															{{$estudiante->asistenciaParcial($parcial)[$tipoFalta]}}
														</td>
													</tr>
												@endforeach
											</table>
										</td>
									</tr>
			</table>
			<br>
			<table class="table">
				<tr>
					<td width="30%" class="no-border text-center">
						<hr style="border:1px solid black;">
						{{($tutor == null ? "-" : $tutor->apellidos)}} {{($tutor == null ? "-" : $tutor->nombres)}}<br>
						MAESTR{{($tutor == null ? "-" : ($tutor->sexo == 'Masculino' ? 'O' : 'A'))}}
					</td>
					<td class="no-border" width="5%"></td>
					<td width="30%" class="no-border text-center"></td>
					<td class="no-border" width="5%"></td>
					<td width="30%" class="no-border text-center">
						<hr style="border:1px solid black;">
						@if ($nombre_representante_libreta_parcial->valor == '1')
							@if($student->estudiante->IDRepresentante != "")
								{{ $representantes->where('id', $student->estudiante->IDRepresentante)->first()->apellidos }} {{ $representantes->where('id', $student->estudiante->IDRepresentante)->first()->nombres }} <br>
							@endif
						@else <br> @endif
						REPRESENTANTE
					</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td class="no-border text-center">
						{{$institution->direccion}}
					</td>
				</tr>
			</table>
			<div style="page-break-after:always;"></div>
		@endforeach
	</main>
</body>

</html>