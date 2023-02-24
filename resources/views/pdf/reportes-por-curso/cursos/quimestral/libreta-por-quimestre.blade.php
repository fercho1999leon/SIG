
<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Boletin</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
		@foreach($students->sortBy('apellidos') as $student)
			@php
			$c_p_a =0;
			$s_p_a =0;
			$visualizar_promedio = true;
			@endphp
			<header class="header m-0">
			@include('partials.encabezados.libreta-formato-vertical-quimestre', [
				'reportName' => '',
				'seccion' => $seccion,
				'quimestre' => $quimestre,
				'parcial' => $n_parcial
			])
			<br>
		</header>
		<table class="table">
			<tr>
				<td width="50" class="uppercase bold bgDark text-right">Estudiante</td>
				<td class="uppercase">{{ $student->nombres }} {{ $student->apellidos }}</td>
				<td class="uppercase bold bgDark text-right" width="50">Curso</td>
				<td class="uppercase">{{ $curso->career }} {{ $curso->paralelo }} {{ $curso->especializacion }}</td>
				<td class="uppercase bold bgDark text-right" width="50">Fecha</td>
				<td class="uppercase" width="50">{{ $now->format('d/m/Y') }}</td>
			</tr>
		</table>
		<table class="table mb-0">
			<tr>
				<td rowspan="2" class="text-center bold">Materias</td>
				<td class="text-center bold" colspan="{{count($parcialP)+1}}"> {{ $quimestre == 'q1' ? "Primer": "Segundo"}} Quimestre </td>
			</tr>
			<tr>
				@foreach($parcialP as $par )
				@php
				$c_i[$par->identificador]=0;
				$visualizar_parcial[$par->identificador]= true;
				$ver_p_p[$par->identificador]= true;
				$s_p_p_n[$par->identificador]=0;
				$c_i_me[$par->identificador]=0;
				@endphp
					<td class="text-center bold">{{$par->nombre}}</td>
				@endforeach
				<td class="text-center bold">PROM. {{$quimestre}}</td>
			</tr>
			<tr>
		@foreach($data2 as $data)
			@if($data->estudianteId == $student->id)
				@foreach($area_pos as $Ap)
					@php
					//$mat_fij = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',1)->sortBy('posicion');
					$mat_fij = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',1)->sortBy('posicion');

					//dd($n_materias_principales);
					@endphp
					@if($mat_fij!= null)
						@foreach($mat_fij as $mp)
								@php
								$ver_m_p[$mp->id] = true;
								@endphp
							@foreach($data->materias as $d_m)
								@if($d_m->materiaId == $mp->id)
									<td class="text-center bold">{{$mp->nombre}}</td>
									@foreach($parcialP as $parcial)
										@php
										$notas_materia = new \Illuminate\Support\Collection($d_m->parciales);
										$nota = $notas_materia->where('indicador', $parcial->identificador)->first()->promediop;
										$s_p_p_n[$parcial->identificador] += $mp->principal == 1 ? $nota : 0;
										@endphp
										@if($nota ==0 && $PromedioInsumo == 0)
												@php
												$ver_p_p[$parcial->identificador] = false;
												$ver_m_p[$mp->id] = false;
												@endphp
												<td></td>
												@else
											<td  class="text-center bold"
											@if($nota < 7 && $notasMenores == "1")
														style="color:red;"
													@endif>
												{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nota)['nota'] : bcdiv($nota, '1', 2)}}</td>
										@endif
									@endforeach
									@if($ver_m_p[$mp->id] && $d_m->promedioquimestral !=0 )
										<td  class="text-center bold"
										@if($d_m->promedioquimestral < 7 && $notasMenores == "1")
													style="color:red;"
										@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$d_m->promedioquimestral)['nota'] : bcdiv($d_m->promedioquimestral, '1', 2)}}</td>
										@else
										<td></td>
									@endif
									</tr>
								@endif
							@endforeach
						@endforeach
					@endif
				@endforeach
				<tr>
					<td class="text-center bold" > PROMEDIO DE APRENDIZAJES</td>
					@foreach($parcialP as $par)
						@if($ver_p_p[$par->identificador])
						<td class="text-center bold"
						@if($s_p_p_n[$par->identificador]/$materiasFijas < 7 && $notasMenores == "1")
												style="color:red;"
											@endif>{{bcdiv($s_p_p_n[$par->identificador]/$materiasFijas, '1', 2)}}</td>
						@else
						<td></td>
						@endif
					@endforeach
					<td class="text-center bold"
						@if($data->promedioEstudiante < 7 && $notasMenores == "1")
							style="color:red;"
						@endif>
						{{$data->promedioEstudiante!=0 ? bcdiv($data->promedioEstudiante, '1', 2): ''}}
					</td>
				</tr>
				<tr>
				<td class="text-center bold">ASIGNATURAS ADICIONALES</td>
				</tr>
				@foreach($area_pos as $Ap)
					@php
					$mat_ext = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',0)->sortBy('posicion');
					@endphp
					@if($mat_ext!= null)
						@foreach($mat_ext as $me)
								@php
								$ver_m_p_e[$me->id] = true;
								@endphp
							@foreach($data->materias as $d_m_e)
								@if($d_m_e->materiaId == $me->id)
									<tr>
									<td class="text-center bold">{{$me->nombre}}</td>
									@foreach($parcialP as $parcial)
										@php
										$notas_materia_e = new \Illuminate\Support\Collection($d_m_e->parciales);
										$nota_e= $notas_materia_e->where('indicador', $parcial->identificador)->first()->promediop;
										@endphp
										@if($nota_e ==0 && $PromedioInsumo == 0)
													@php
													$ver_p_p_e[$parcial->identificador] = false;
													$ver_m_p_e[$me->id] = false;
													@endphp
													<td></td>
											@else
												<td  class="text-center bold"
												@if($nota_e < 7 && $notasMenores == "1")
															style="color:red;"
														@endif>
													{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nota_e)['nota'] : bcdiv($nota_e, '1', 2)}}</td>
										@endif
									@endforeach
									@if($ver_m_p_e[$me->id] && $d_m_e->promedioquimestral !=0 )
										<td  class="text-center bold"
										@if($d_m_e->promedioquimestral < 7 && $notasMenores == "1")
													style="color:red;"
										@endif>{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$d_m_e->promedioquimestral)['nota'] : bcdiv($d_m_e->promedioquimestral, '1', 2)}}</td>
										@else
										<td></td>
									@endif
									</tr>
								@endif
							@endforeach
						@endforeach
					@endif
				@endforeach
			@endif
		@endforeach
			@if($dhi != null)
			<tr>
				<td class="uppercase bold">
					{{$dhi->nombre}}
				</td>
				@if($confDHI->valor == 'QUIMESTRAL')
					<td colspan="5" class="text-center">
						{{$dhi[$quimestre]}}
					</td>
				@else
				@foreach($parcialP as $par )
						@php
						$P_promediosparcial=0;
						switch ($par->identificador) {
						case 'p1'.$quimestre:
						$nota_dhi = $dhi["p1$quimestre"];
						break;
						case 'p2'.$quimestre:
						$nota_dhi = $dhi["p2$quimestre"];
						break;
						case 'p3'.$quimestre:
						$nota_dhi = $dhi["p3$quimestre"];
						break;
						case $quimestre:
						$nota_dhi = $dhi["$quimestre"];
						break;
						}
						@endphp
						<td class="text-center">
							{{$nota_dhi}}
						</td>
					@endforeach
					<td class="text-center">{{$dhi["$quimestre"]}}</td>
				@endif
			</tr>
			@endif
			<!-- COMPORTAMIENTO -->
			<tr>
				<td class="text-center bold">EVALUACIÓN COMPORTAMENTAL</td>
				@foreach($parcialP as $par )
						@php
						switch ($par->identificador) {
						case 'p1'.$quimestre:
						$parcial_comp = 'p1'.$quimestre;
						break;
						case 'p2'.$quimestre:
						$parcial_comp = 'p2'.$quimestre;
						break;
						case 'p3'.$quimestre:
						$parcial_comp = 'p3'.$quimestre;
						break;
						case $quimestre:
						$parcial_comp =  $quimestre;
						break;
						}
						@endphp
						<td class="text-center bold">
						@forelse($student->comportamientos->where('parcial',$parcial_comp)->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
						</td>

				@endforeach
				<td colspan="2" class="text-center">
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
		<table class="table">
			<tr>
				<td class="no-border">
					<table class="table">
						<tr>
							<td height="20" colspan="2" class="bold no-border text-center uppercase">informe de inspección</td>
						</tr>
						<tr>
							<td></td>
							<td class="text-center">Totales</td>
						</tr>
						@php
							$estudiante = App\Student2Profile::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
								->where('idStudent', $student->id)
								->first();
						@endphp
						@foreach (['atrasos' => 'Atrasos', 'faltas_justificadas' => 'Faltas Justificadas', 'faltas_injustificadas' => 'Faltas Injustificadas'] as $tipoFalta => $titulo)
							<tr>
								<td>{{$titulo}}</td>
								<td class="text-center">
									{{$estudiante->asistenciaParcial("p1{$quimestre}")[$tipoFalta] + $estudiante->asistenciaParcial("p2{$quimestre}")[$tipoFalta] +$estudiante->asistenciaParcial("p3{$quimestre}")[$tipoFalta]}}
								</td>
							</tr>
						@endforeach
					</table>
				</td>
				<td class="no-border">
					<div class="text-center" style="padding:0">
						@if($quimestre=='q1')
							@if($confComportamiento->valor !== 'crear')
								<h4 class="m-0" style="line-height: 1.5; font-size:14px">Observación: ___________________
									<br>_______________________________
									<br>_______________________________
								</h4>
							@else
								<h4 class="m-0" style="line-height: 1.5; font-size:14px">
									@foreach($student->comportamientos->where('parcial', 'q1') as $comportamiento)
										@if($comportamiento->observacion != null)
											Observación: {{$comportamiento->observacion}}
										@else
											<h4 class="m-0" style="line-height: 1.5; font-size:14px">
												Observación: ___________________
												<br>_______________________________
												<br>_______________________________
											</h4>
										@endif
									@endforeach
								</h4>
							@endif
						@else
							@if($confComportamiento->valor !== 'crear')
								<h4 class="m-0" style="line-height: 1.5" style="font-size:14px">Observación: ___________________
									<br>_______________________________
									<br>_______________________________
								</h4>
							@else
								<h4 class="m-0" style="line-height: 1.5" style="font-size:14px">
									@foreach($student->comportamientos->where('parcial', 'q2') as $comportamiento)
										@if($comportamiento->observacion != null)
											Observación: {{$comportamiento->observacion}}
										@else
											<h4 class="m-0" style="line-height: 1.5; font-size:14px">
												Observación: ___________________
												<br>_______________________________
												<br>_______________________________
											</h4>
										@endif
									@endforeach
								</h4>
							@endif
						@endif
					</div>
				</td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<div class="row">
			<div class="col-xs-6 p-0 text-center ">
				<hr class="certificado__hr">
				<p class="uppercase bold">
					@if($tutor != null)
					{{ $tutor->nombres }} {{ $tutor->apellidos }}
					@endif
					<br> TUTOR
				</p>
			</div>
			<div class="col-xs-6 p-0 text-center">
				<hr class="certificado__hr">
				<p class="uppercase bold">
					@if ($nombre_representante_libreta_parcial->valor == '1')
						@if ($student->representante != null)
							{{$student->representante->apellidos}} {{$student->representante->nombres}}
						@endif
						<br>
					@else
						<br>
					@endif
					REPRESENTANTE
				</p>
			</div>
		</div>
		<br>
		<br>
		@include('partials.reglamento', [
				'asignaturaCualitativa' => true, 'inicial' => false
			])
		<div style="page-break-after:always;"></div>
		@endforeach
	</main>
</body>
</html>