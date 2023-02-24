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
		@if ($students->where('idStudent', $student->estudianteId))
		@php $viualizar = true; @endphp
			<header class="header m-0">
				<table class="table">
					<tr>
						<th style="vertical-align:top" class="no-border" width="20%">
							<div class="header__logo" style="float: left">
								<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
							</div>
						</th>
						<th class="no-border" width="60%">
							<div class="header__info text-center">
								<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
								<h4 class="m-0 bold uppercase">
									Promedio Parcial {{$n_parcial}} Quimestre {{$nQuimestre}}
								</h4>
							</div>
						</th>
						<th class="no-border" width="20%">
							<div class="header__logo" style="float: right">
							</div>
						</th>
					</tr>
				</table>
			</header>
			<table class="table m-0">
				<tr>
					<td class="no-border" width="25%">Estudiante: </td>
					<td class="no-border" width="25%">{{$student->apellidos}} {{$student->nombres}}</td>
					<td class="no-border">Curso:</td>
					<td class="no-border">{{$curso->grado}} {{$curso->paralelo}} {{$curso->especializacion}}</td>
				</tr>
				<tr>
					<td class="no-border">Profesor(a):</td>
					<td class="no-border">{{($tutor == null ? "-" : $tutor->nombres)}} {{($tutor == null ? "-" : $tutor->apellidos)}}</td>
					<td class="no-border">Período Lectivo:</td>
					<td class="no-border">{{$periodo}}</td>
				</tr>
			</table>
			<table class="table m-0">
				<tr>
					<td style="vertical-align:top !important" width="65%" class="no-border">
						<table class="table">
							<tr>
								<td rowspan="3" class="text-center bold">ASIGNATURA</td>
								<td colspan="{{count($insumos)}}" class="text-center bold">ACTIVIDADES
								</td>
								@if($porcentajeInsumos == 0)
								<td rowspan="3" class="text-center bold">SUMA</td>
								@endif
								<td colspan="2" rowspan="2" class="text-center bold">PROMEDIO FINAL</td>
							</tr>
							<tr>
								@foreach($insumos as $insumo)
									<td class="text-center bold uppercase">{{$insumo->nombre}}</td>
								@endforeach
							</tr>
							<tr>
								@foreach($insumos as $insumo)
									<td class="text-center">{{$porcentajeInsumos == 0 ? '10' : '-'}}</td>
								@endforeach
								<td class="text-center">EC</td>
								<td class="text-center">10</td>
							</tr>
							<tr>
							@foreach($area_pos as $Ap)
								@php
									$materias = $allMatters->where('nombreArea',$Ap->nombre)->sortBy('posicion');

								@endphp
								@if($materias!= null)
								@foreach($materias->where('principal', 1) as $materia)
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
														$notas_materia[$materia->id] = new \Illuminate\Support\Collection($n_materia->insumos);
														$nota=0;
													@endphp
													@foreach($insumos as $insumo)
														@php
															$nota = $notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first() == null ? 0 : $notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()->nota;
															$s_p_i += $nota;
														@endphp
														@if($nota==0 && $PromedioInsumo == 0)
															@php
																$viualizar = false;
															@endphp
															<td></td>
														@else
															<td class="text-center"
																@if($nota < 7 && $notasMenores == "1" && $porcentajeInsumos == 0)
																	style="color:red;"
																@endif >
																@if($porcentajeInsumos == 1 && $materia->idEstructura!= null)
																{{App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,($nota * 100 )/$insumo->porcentaje)['nota'] }}
																@else
																{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$nota)['nota'] : bcdiv($nota, '1', 2)}}
																@endif
															</td>
														@endif
													@endforeach
												@endif
											@endforeach
											@if($porcentajeInsumos == 0)
											<td class="text-center"> {{$materia->idEstructura== null ? $s_p_i:''}} </td>
											@endif
											@if($pro_final[$materia->id] ==0 && $PromedioInsumo == 0)
												<td></td>
												<td></td>
											@else
												<td class="text-center">
													{{$materia->idEstructura== null ? App\Calificacion::notaCualitativaApr($pro_final[$materia->id]):''}}
												</td>
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
							<td class="no-border text-right" colspan="{{ $porcentajeInsumos == 0 ? count($insumos) + 2 :  count($insumos) + 1}}">PROMEDIO ACADÉMICO</td>
								@if($viualizar)
									<td class="text-center">{{App\Calificacion::notaCualitativaApr($student->promedio)}}</td>
									<td class="text-center">{{$student->promedio}}</td>
									@else
									<td class="text-center"></td>
									<td class="text-center"></td>
								@endif
							</tr>
							<tr>
									<td class="bold" colspan="{{$porcentajeInsumos == 0 ? count($insumos) + 2 :  count($insumos) + 3}}">Asignaturas Adicionales
									</td>
								</tr>
								@foreach($area_pos as $Ap)
									@php
										$materias_ex = $allMatters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
									@endphp
									@if($materias_ex!= null)
										@foreach($materias_ex->where('principal','<>',1) as $ma_ex)
										<tr>
										@php
												$s_p_i_e =0;
												$notas_materia_e=[];
												$pro_final_e =[];
											@endphp
											<td>{{$ma_ex->nombre}}</td>
											@foreach($student->parcial as $n_materia_e)
												@if($n_materia_e->materiaId == $ma_ex->id)
													@php
														$pro_final_e[$ma_ex->id] = $n_materia_e->promedioFinal;
														$notas_materia_e[$ma_ex->id] = new \Illuminate\Support\Collection($n_materia_e->insumos);
														$nota_e=0;
													@endphp
													@foreach($insumos as $insumo)
														@php
															$nota_e= $notas_materia_e[$ma_ex->id]->where('nombre', $insumo->nombre)->first()==null?0:$notas_materia_e[$ma_ex->id]->where('nombre', $insumo->nombre)->first()->nota;
															$s_p_i_e += $nota_e;
														@endphp
														@if($nota_e==0 && $PromedioInsumo == 0)
															@php
																$viualizar = false;
															@endphp
															<td></td>
														@else
															<td class="text-center"
																@if($nota_e< 7 && $notasMenores == "1" && $porcentajeInsumos == 0)
																	style="color:red;"
																@endif >
																@if($porcentajeInsumos == 1 && $ma_ex->idEstructura!= null)
																{{App\rangosCualitativo::getCalificacionCualitativa($ma_ex->idEstructura,($nota_e * 100 )/$insumo->porcentaje)['nota'] }}
																@else
																{{$ma_ex->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($ma_ex->idEstructura,$nota_e)['nota'] : bcdiv($nota_e, '1', 2)}}
																@endif
															</td>
														@endif
													@endforeach
												@endif
											@endforeach
											@if($porcentajeInsumos == 0)
											<td class="text-center">{{$ma_ex->idEstructura== null ? $s_p_i_e : ''}}</td>
											@endif
											@if($pro_final_e[$ma_ex->id] ==0 && $PromedioInsumo == 0)
												<td></td>
												<td></td>
											@else
												<td class="text-center">
													{{$ma_ex->idEstructura== null ? App\Calificacion::notaCualitativaApr($pro_final_e[$ma_ex->id]):''}}</td>
												<td class="text-center"
													@if($pro_final_e[$ma_ex->id] < 7 && $notasMenores == "1")
														style="color:red;"
													@endif >
													{{$ma_ex->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($ma_ex->idEstructura,$pro_final_e[$ma_ex->id])['nota'] : bcdiv($pro_final_e[$ma_ex->id], '1', 2)}}
												</td>
											@endif
											</tr>
										@endforeach
									@endif
								@endforeach
							</tr>
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
						</table>
					</td>
					<td width="1%" class="no-border"></td>
					<td width="49%" class="no-border">
						<table class="table">
							<tr>
								<td colspan="2" class="text-center">OBSERVACIONES</td>
							</tr>
							<tr height="60">
								<td colspan="2" class="text-center">
									<h2 class="uppercase">
										@foreach ($comportamientos->where('idStudent', $student->estudiante->ID)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
											<span class="libreta__pobservaciones-desc">{{$comportamiento->observacion}}</span>
										@endforeach
									</h2>
								</td>
							</tr>
							<tr>
								<td class="text-right no-border">COMPORTAMIENTO</td>
								<td class="text-center">
									@foreach ($comportamientos->where('idStudent', $student->estudiante->ID)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
										<span
											@if(strcmp($comportamiento_menor->valor, $comportamiento->nota) <= 0)
												style="color:red;"
											@endif>
											{{$comportamiento->nota}}
										</span>
									@endforeach
								</td>
							</tr>
							<tr>
								<td colspan="2" class="no-border"></td>
							</tr>
							<tr>
								<td class="text-right no-border">DÍAS DE ASISTENCIA</td>
								<td class="text-center">
									{{ $asistenciaCurso->asistencia }}
								</td>
							</tr>
							@php
								$estudiante = App\Student2Profile::getStudent($student->estudianteId);
							@endphp
							@foreach (['atrasos' => 'Atrasos', 'faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas'] as $tipoFalta => $titulo)
								<tr>
									<td class="text-right no-border">{{$titulo}}</td>
									<td class="text-center">
										{{$estudiante->asistenciaParcial($parcial)[$tipoFalta]}}
									</td>
								</tr>
							@endforeach
						</table>
					</td>
				</tr>
			</table>
			@include('partials.reglamento', [ 'asignaturaCualitativa' => false, 'inicial' => false ])
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
			<span style="display:none"> {{$i++}} </span>
			@if ($i % 2 == 0)
				<div style="page-break-after:always;"></div>
			@endif
		@endif
		@endforeach
	</main>
</body>
</html>