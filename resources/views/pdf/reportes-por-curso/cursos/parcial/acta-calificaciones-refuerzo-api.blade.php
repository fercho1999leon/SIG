@php
	use App\Area;
	$nQuimestre = substr($parcial,3,1);
	$n_parcial =  substr($parcial,1,1);
	$viualizar = true;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Parcial</title>
	<link rel="stylesheet" href=" {{secure_asset('css/pdf/pdf.css')}} ">
</head>
@php
@endphp
<body>
	<main>
	@foreach($data->sortBy('apellidos') as $student)
		@if ($students->where('idStudent', $student->estudianteId))
		<header class="mb-0">
			@include('partials.encabezados.libreta-formato-vertical', [
				'reportName' => 'LIBRETA REFUERZO ACADÉMICO',
				'seccion' => $seccion,
				'nQuimestre' => $nQuimestre,
				'parcial' => $n_parcial,
				'quimestre' => $nQuimestre,
			])
		</header>
		<section class="section">
			<table class="table">
				<tr>
					<td width="50" class="uppercase bold bgDark text-right">Estudiante</td>
					<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
					<td class="uppercase bold bgDark text-right" width="50">Curso</td>
					<td class="uppercase">{{ $curso->grado }} {{ $curso->paralelo }} {{ $curso->especializacion }}</td>
					<td class="uppercase bold bgDark text-right" width="50">Fecha</td>
					<td class="uppercase" width="50">{{ $now->format('d/m/Y') }}</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td rowspan="3" class="text-center bold uppercase">Asignaturas</td>
					<td colspan="{{ (count($insumos)*2)+2}}" class="text-center bold uppercase">parcial {{ $n_parcial }}</td>
				</tr>
				<tr>
					@foreach($insumos as $insumo)
						<td colspan="2" class="text-center bold uppercase">{{ $insumo->nombre }}</td>
					@endforeach
					<td rowspan="2" class="text-center bold uppercase">PROM. I</td>
					<td rowspan="2" class="text-center bold uppercase">Prom. F</td>
				</tr>
				<tr>
					@foreach($insumos as $insumo)
					<td class="text-center bold uppercase">Nota</td>
					<td class="text-center bold uppercase">R</td>
					@endforeach
				</tr>
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
														$pro_inicial[$materia->id] = $n_materia->promedioInicial;
														$notas_materia[$materia->id] = new \Illuminate\Support\Collection($n_materia->insumos);
														$nota=0;
														$refuerzo=0;
													@endphp
													@foreach($insumos as $insumo)
														@php
															$nota = $notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()==null?0:$notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()->nota;
															$refuerzo = $notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()==null?0:$notas_materia[$materia->id]->where('nombre', $insumo->nombre)->first()->refuerzo;
															$s_p_i += $nota;
														@endphp
														@if($nota==0 && $PromedioInsumo == 0)
															@php
																$viualizar = false;
															@endphp
															<td></td>
														@else
															<td class="text-center"
																@if($nota < 7 && $notasMenores == "1")
																	style="color:red;"
																@endif >
															{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$nota)['nota'] : bcdiv($nota, '1', 2)}}</td>
														@endif
														<td class="text-center">{{bcdiv($refuerzo, '1', 2)}}</td>
													@endforeach
												@endif
											@endforeach
											@if($pro_final[$materia->id] ==0 && $PromedioInsumo == 0)
												<td></td>
												<td></td>
											@else
												<td class="text-center"
													@if($pro_final[$materia->id] < 7 && $notasMenores == "1")
														style="color:red;"
													@endif >
													{{$materia->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($materia->idEstructura,$pro_inicial[$materia->id])['nota'] : bcdiv($pro_inicial[$materia->id], '1', 2)}}
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
								<tr>
									<td class="uppercase">Promedio General</td>
									<td colspan="{{ (count($insumos)*2)+1  }}"></td>
									@if($viualizar)
										<td class="text-center">{{ bcdiv($student->promedio, '1', 2)}}</td>
									@else
										<td class="text-center"></td>
									@endif
								</tr>
								<tr>
									<td class="bold" colspan="{{ count($insumos)+2 }}">Asignaturas Adicionales
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
														$pro_inicial[$ma_ex->id] = $n_materia_e->promedioInicial;
														$notas_materia_e[$ma_ex->id] = new \Illuminate\Support\Collection($n_materia_e->insumos);
														$nota_e=0;
														$refuerzo_e =0;
													@endphp
													@foreach($insumos as $insumo)
														@php
															$nota_e= $notas_materia_e[$ma_ex->id]->where('nombre', $insumo->nombre)->first()==null?0:$notas_materia_e[$ma_ex->id]->where('nombre', $insumo->nombre)->first()->nota;
															$refuerzo_e = $notas_materia_e[$ma_ex->id]->where('nombre', $insumo->nombre)->first()==null?0:$notas_materia_e[$ma_ex->id]->where('nombre', $insumo->nombre)->first()->refuerzo;
															$s_p_i += $nota_e;
														@endphp
														@if($nota==0 && $PromedioInsumo == 0)
															@php
																$viualizar = false;
															@endphp
															<td></td>
														@else
															<td class="text-center"
																@if($nota_e< 7 && $notasMenores == "1")
																	style="color:red;"
																@endif >
															{{$ma_ex->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($ma_ex->idEstructura,$nota_e)['nota'] : bcdiv($nota_e, '1', 2)}}</td>
														@endif
														<td class="text-center">{{bcdiv($refuerzo_e, '1', 2)}}</td>
													@endforeach
												@endif
											@endforeach
											@if($pro_final_e[$ma_ex->id] ==0 && $PromedioInsumo == 0)
												<td></td>
												<td></td>
											@else
												<td class="text-center"
													@if($pro_final_e[$ma_ex->id] < 7 && $notasMenores == "1")
														style="color:red;"
													@endif >
													{{$ma_ex->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($ma_ex->idEstructura,$pro_inicial[$ma_ex->id])['nota'] : bcdiv($pro_inicial[$ma_ex->id], '1', 2)}}
												</td>
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
				@if ($institution->ruc==='0992636009001' && $curso->seccion ==='BGU'){{--condicion diseñada exclusivamente para NOVUS--}}
					@if($dhi != null && $confDHI->valor == 'PARCIAL')
						<tr>
							<td class="uppercase bold">
								{{$dhi->nombre}}
							</td>
							<td colspan="8" class="text-center">
								{{$dhi[$parcial] ?? '-'}}
							</td>
						</tr>
					@endif
				@else
					@if($dhi != null && $confDHI->valor == 'PARCIAL')
						<tr>
							<td class="uppercase bold">
								{{$dhi->nombre}}
							</td>
							<td colspan="8" class="text-center">
								{{$dhi[$parcial] ?? '-'}}
							</td>
						</tr>
					@endif
				@endif
				<tr>
					<td class="uppercase">comportamiento</td>
					<td colspan="{{  (count($insumos)*2)+2  }}"
						class="text-center uppercase">
						@forelse ($comportamientos->where('idStudent', $student->estudiante->ID) as $comportamiento)
							<span
								@if(strcmp($comportamiento_menor->valor, $comportamiento->nota) <= 0)
									style="color:red;"
								@endif>
								{{$comportamiento->nota}}
							</span>
						@empty
							-
						@endforelse
					</td>
				</tr>
				<tr>
					<td class="bold">Asistencia
						<small>(Por horas de clase)</small>
					</td>
					<td colspan="{{ (count($insumos)*2)+2  }}" class="text-center bold uppercase">Parcial {{ $n_parcial }}</td>
				</tr>
				@php
					$estudiante = App\Student2Profile::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
						->where('idStudent', $student->estudiante->ID)
						->first();
				@endphp
				<tr>
					<td class="uppercase">Faltas Justificadas</td>
					<td colspan="{{ (count($insumos)*2)+2  }}" class="text-center">{{$estudiante->asistenciaParcial($parcial)['faltas_justificadas']}}</td>
				</tr>
				<tr>
					<td class="uppercase">Faltas Injustificadas</td>
					<td colspan="{{ (count($insumos)*2)+2  }}" class="text-center">{{$estudiante->asistenciaParcial($parcial)['faltas_injustificadas']}}</td>
				</tr>
				<tr>
					<td class="uppercase">Atrasos</td>
					<td colspan="{{ (count($insumos)*2)+2  }}" class="text-center">{{$estudiante->asistenciaParcial($parcial)['atrasos']}}</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td width="20" class="uppercase bold text-center no-border" style="padding: 0 7px 0 0">Observaciones: </td>
					<td class="borderBottom p-0 libreta__pobservaciones-desc">
						@forelse ($comportamientos->where('idStudent', $student->estudiante->ID) as $comportamiento)
							<span class="libreta__pobservaciones-desc">{{$comportamiento->observacion}}</span>
						@empty
							-
						@endforelse
					</td>
				</tr>
			</table>
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center ">
					<hr class="certificado__hr">
					<p class="uppercase bold">
						{{$tutor == null ? "-" : $tutor->apellidos}} {{ $tutor == null ? "-" : $tutor->nombres }}
						<br> TUTOR
					</p>
				</div>
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase bold">
						@if ($nombre_representante_libreta_parcial->valor == '1')
							@if($student->estudiante->IDRepresentante != "")
								{{ $representantes->where('id', $student->estudiante->IDRepresentante)->first()->apellidos }} {{ $representantes->where('id', $student->estudiante->IDRepresentante)->first()->nombres }}
							@endif
						@endif
						<br> REPRESENTANTE
					</p>
				</div>
			</div>
			<br>
			@include('partials.reglamento', [
				'asignaturaCualitativa' => true, 'inicial' => false
			])
		</section>
		<div style="page-break-after:always;"></div>
		@endif
	@endforeach
	</main>
</body>
</html>