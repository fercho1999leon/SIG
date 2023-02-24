@php
	use App\Area;
	use App\Matter;
	$cont_pares =0; //creado para darle el salto de pagina cada dos estudiantes
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Quimestral</title>
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
		@php
		$cont_pares++;
		$suma_p_f =0;
		$visibleMaterias=true;
		$visualizar_promedio=true;
		@endphp
			@foreach($parcialP as $par )
				@php
				$c_i[$par->identificador]=0;
				$visualizar_parcial[$par->identificador]= true;
				$ver_p_p[$par->identificador]= true;
				$s_p_p_n[$par->identificador]=0;
				$c_i_me[$par->identificador]=0;
				@endphp
			@endforeach
		<header class="header m-0">
			<table class="table">
				<tr>
					<th style="vertical-align:top;" class="no-border">
						<div class="header__logo" style="float: left">
							<img
								@if(DB::table('institution')->where('id', '1')->first()->logo == null)
									src="{{ secure_asset('img/logo/logo.png') }}"
								@else
									src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"  width="50"
								@endif
							alt="" width="70">
						</div>
					</th>
					<th class="no-border" width="60%">
						<div class="header__info text-center">
							<h3 class="m-0 h1 uppercase" style="font-size: 12px !important;"> {{$institution->nombre}} </h3>
							<h4 class="m-0 bold uppercase"  style="font-size: 12px !important;">
								Promedio {{$quimestre == 'q1' ? 'Primer' : 'Segundo'}} Quimestre
							</h4>
						</div>
					</th>
					<th class="no-border" width="20%">
						<div class="header__logo" style="float: right">
								{{-- este codigo de abajo debe ser activado cuando se lea datos desde la base --}}
								{{-- <img src="{{ $user_data->url_imagen == null ? secure_asset("img/icono_persona.png") : secure_asset("storage/$user_data->url_imagen") }}"
									class="img-circle circle-border m-b-md"
									alt="profile"
									width="70"
								> --}}
						</div>
					</th>
				</tr>
			</table>
		</header>
		<table class="table">
			<tr>
				<td class="no-border" width="25%">Estudiante:</td>
				<td class="no-border uppercase" width="25%">{{$student->nombres}} {{$student->apellidos}}</td>
				<td class="no-border" width="25%">Curso:</td>
				<td class="no-border uppercase" width="25%">{{$curso->grado}} {{$curso->paralelo}} {{$curso->especializacion}}</td>
			</tr>
			<tr>
				<td class="no-border">Profesor(a):</td>
				<td class="no-border uppercase">{{$tutor == null ? "-" : $tutor->nombres}} {{$tutor == null ? "-" : $tutor->apellidos}}</td>

				<td class="no-border">Período Lectivo:</td>
				<td class="no-border">{{$periodo}}</td>
			</tr>
		</table>
		<table class="table">
			<tr>
				<td style="vertical-align:top !important" width="70%" class="no-border">
					<table class="table">
						<tr>
							<td rowspan="3" class="text-center bold">ASIGNATURA</td>
							<td colspan="{{count($parcialP)}}" class="text-center bold">PARCIALES</td>
							<td rowspan="2" class="text-center bold">PROM. PARCIAL</td>
							<td colspan="2" class="text-center bold">QUIMESTRAL</td>
							<td colspan="2" rowspan="2" class="text-center bold">PROMEDIO QUIMESTRAL</td>
						</tr>
						<tr>
							@for ($i = 0; $i < count($parcialP) -1; $i++)
							<td class="text-center">{{$parcialP[$i]->identificador}}</td>
							@endfor
							<td class="text-center">Prom.</td>
							<td class="text-center">Exa.</td>
							<td class="text-center">Prom.</td>
						</tr>
						<tr>
							@for ($i = 0; $i < count($parcialP) -1; $i++)
							<td class="text-center">10</td>
							@endfor
							<td class="text-center">10</td>
							<td class="text-center">80%</td>
							<td class="text-center">10</td>
							<td class="text-center">20%</td>
							<td class="text-center">EC</td>
							<td class="text-center">10</td>
						</tr>
						<tr>
					@foreach($data2 as $data)
						@if($data->estudianteId == $student->id)
							@foreach($area_pos as $Ap)
								@php
								$mat_fij = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',1)->sortBy('posicion');
								$s_promedio_80 = 0;
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
													@if($parcial->identificador=='q1' || $parcial->identificador=='q2')
													@else
														@php
														//dd($data);
														$notas_materia = new \Illuminate\Support\Collection($d_m->parciales);
														$nota = $notas_materia->where('indicador', $parcial->identificador)->first()->promediop;
														$s_p_p_n[$parcial->identificador] += $mp->principal == 1 ? $nota : 0;
														$s_promedio_80 +=$mp->principal == 1 ? $nota : 0;
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
													@endif
												@endforeach
												@if($ver_m_p[$mp->id] && $d_m->promedioquimestral !=0 )
													<td  class="text-center bold"
													@if($d_m->promedioquimestral < 7 && $notasMenores == "1")
																style="color:red;"
													@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$s_promedio_80/(count($parcialP)-1))['nota'] : bcdiv($s_promedio_80/(count($parcialP)-1), '1', 2)}}</td>
													<td  class="text-center bold"
													@if($d_m->promedioquimestral < 7 && $notasMenores == "1")
																style="color:red;"
													@endif>{{$mp->idEstructura!= null ? '' : bcdiv($d_m->promedio80, '1', 2)}}</td>
													@else
													<td></td>
													<td></td>
												@endif
												@foreach($parcialP as $parcial)
													@if($parcial->identificador=='q1' || $parcial->identificador=='q2')
														@php
														//dd($d_m);
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
																<td></td>
															@else
															<td  class="text-center bold"
															@if($nota < 7 && $notasMenores == "1")
																		style="color:red;"
																	@endif>
																{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$nota)['nota'] : bcdiv($nota, '1', 2)}}</td>
																<td  class="text-center bold">
															{{$mp->idEstructura!= null ? '' : bcdiv($d_m->promedio20, '1', 2)}}
														</td>
														@endif
													@endif
												@endforeach
												@if($ver_m_p[$mp->id] && $d_m->promedioquimestral !=0 )
													<td class="text-center bold">{{$mp->idEstructura!= null ?'': App\Calificacion::notaCualitativaApr($d_m->promedioquimestral)}}</td>
													<td  class="text-center bold"
													@if($d_m->promedioquimestral < 7 && $notasMenores == "1")
																style="color:red;"
															@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$d_m->promedioquimestral)['nota'] : bcdiv($d_m->promedioquimestral, '1', 2)}}</td>
												@else
													<td></td>
													<td></td>
												@endif
												</tr>
											@endif
										@endforeach
									@endforeach
								@endif
							@endforeach
							<tr><td colspan="{{count($parcialP)}}" class="no-border text-right">
							<td colspan="4" class="no-border text-right" >PROMEDIO ACADÉMICO</td>
								@if($ver_m_p[$mp->id] && $data->promedioEstudiante !=0 )
										<td class="text-center bold">{{$mp->idEstructura!= null ?'': App\Calificacion::notaCualitativaApr($data->promedioEstudiante)}}</td>
										<td  class="text-center bold"
										@if($data->promedioEstudiante < 7 && $notasMenores == "1")
													style="color:red;"
												@endif>{{$mp->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($mp->idEstructura,$data->promedioEstudiante)['nota'] : bcdiv($data->promedioEstudiante, '1', 2)}}</td>
									@else
										<td></td>
										<td></td>
								@endif
							</tr>
							@foreach($area_pos as $Ap)
								@php
									$mat_ext = $allMatters->where('nombreArea',$Ap->nombre)->where('principal',0)->sortBy('posicion');
									$s_promedio_80_me = 0;
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
														@if($parcial->identificador=='q1' || $parcial->identificador=='q2')
														@else
															@php
															$notas_materia_e = new \Illuminate\Support\Collection($d_m_e->parciales);
															$nota2 = $notas_materia_e->where('indicador', $parcial->identificador)->first()->promediop;
															//dd($d_m_e);
															$s_promedio_80_me += $me->principal == 0 ? $nota2 : 0;

															@endphp
															@if($nota2 ==0 && $PromedioInsumo == 0)
																	@php
																	$ver_m_p_e[$me->id] = false;
																	@endphp
																	<td></td>
																	@else
																<td  class="text-center bold"
																@if($nota2 < 7 && $notasMenores == "1")
																			style="color:red;"
																		@endif>
																	{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nota2)['nota'] : bcdiv($nota2, '1', 2)}}</td>
															@endif
														@endif
													@endforeach
													@if($ver_m_p_e[$me->id] && $d_m_e->promedioquimestral !=0 )
														<td  class="text-center bold"
														@if($d_m_e->promedioquimestral < 7 && $notasMenores == "1")
																	style="color:red;"
														@endif>{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$s_promedio_80_me/(count($parcialP)-1))['nota'] : bcdiv($s_promedio_80_me/(count($parcialP)-1), '1', 2)}}
													</td>
														<td  class="text-center bold"
														@if($d_m_e->promedioquimestral < 7 && $notasMenores == "1")
																	style="color:red;"
														@endif>{{$me->idEstructura!= null ? '' : bcdiv($d_m_e->promedio80, '1', 2)}}</td>
														@else
														<td></td>
														<td></td>
													@endif
													@foreach($parcialP as $parcial)
													@if($parcial->identificador=='q1' || $parcial->identificador=='q2')
														@php
														//dd($d_m);
														$notas_materia_e = new \Illuminate\Support\Collection($d_m_e->parciales);
														$nota2 = $notas_materia_e->where('indicador', $parcial->identificador)->first()->promediop;
														@endphp
														@if($nota2 ==0 && $PromedioInsumo == 0)
																@php
																$ver_m_p_e[$me->id] = false;
																@endphp
																<td></td>
																<td></td>
															@else
															<td  class="text-center bold"
															@if($nota2 < 7 && $notasMenores == "1")
																		style="color:red;"
																	@endif>
																{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$nota2)['nota'] : bcdiv($nota2, '1', 2)}}</td>
																<td  class="text-center bold">
															{{$me->idEstructura!= null ? '' : bcdiv($d_m_e->promedio20, '1', 2)}}
														</td>
														@endif
													@endif
												@endforeach
												@if($ver_m_p_e[$me->id] && $d_m_e->promedioquimestral !=0 )
													<td class="text-center bold">{{$me->idEstructura!= null ?'': App\Calificacion::notaCualitativaApr($d_m_e->promedioquimestral)}}</td>
													<td  class="text-center bold"
													@if($d_m_e->promedioquimestral < 7 && $notasMenores == "1")
																style="color:red;"
															@endif>{{$me->idEstructura!= null ? App\rangosCualitativo::getCalificacionCualitativa($me->idEstructura,$d_m_e->promedioquimestral)['nota'] : bcdiv($d_m_e->promedioquimestral, '1', 2)}}</td>
												@else
													<td></td>
													<td></td>
												@endif
													</tr>
												@endif
											@endforeach
										@endforeach
									@endif
							@endforeach
							@if($dhi != null)
							<tr></tr>
							<tr>
								<td class="text-center bold" >{{$dhi->nombre}}</td>
								@if($confDHI->valor == 'QUIMESTRAL')
									<td colspan="{{count($parcialP)+5}}" class="text-center bold">
										{{$dhi[$quimestre]}}
									</td>
									@else
										@for ($i = 0; $i < count($parcialP) -1; $i++)
											@php
											$P_promediosparcial=0;
											switch ($parcialP[$i]->identificador) {
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
											<td class="text-center bold">
												{{$nota_dhi}}
											</td>
										@endfor
											<td class="text-center">-</td>
											<td class="text-center">-</td>
											<td class="text-center" colspan="2">-</td>
											<td class="text-center bold" colspan="2"> {{$dhi["$quimestre"]}}</td>
								@endif
							</tr>
						@endif
						@endif
					@endforeach
					</table>
					</td>
				<td width="30%" class="no-border" >
					<table class="table">
						<tr>
							<td colspan="2" class="text-center" >OBSERVACIONES</td>
						</tr>
						<tr height="60">
							<td colspan="2" class="text-center">
								<h2 class="uppercase">
									@if($quimestre=='q1')
										@if($confComportamiento->valor == 'replicar')


											@forelse($student->comportamientos->where('parcial', 'p3q1')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
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
											@forelse($student->comportamientos->where('parcial', 'p3q2')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
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
								</h2>
							</td>
						</tr>
						<tr>
							<td class="text-right no-border" style="font-size: 12px !important;">COMPORTAMIENTO</td>
							<td class="text-center" style="font-size: 12px !important;">
								@if($quimestre == 'q1')
									@if($confComportamiento->valor !== 'crear')
										@forelse($student->comportamientos->where('parcial', 'p3q1')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@else
										@forelse($student->comportamientos->where('parcial', 'q1')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@endif
								@else
									@if($confComportamiento->valor !== 'crear')
										@forelse($student->comportamientos->where('parcial', 'p3q2')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@else
										@forelse($student->comportamientos->where('parcial', 'q2')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->sortByDesc('id')->take(1) as $comportamiento)
											{{$comportamiento->nota}}
										@empty
											-
										@endforelse
									@endif
								@endif
							</td>
						</tr>
						<tr>
							<td colspan="2" class="no-border" style="font-size: 12px !important;"></td>
						</tr>
						<tr>
							<td class="text-right no-border" style="font-size: 12px !important;">DIAS DE ASISTENCIA</td>
							<td class="text-center" style="font-size: 12px !important;">
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
								<td class="text-right no-border uppercase" style="font-size: 12px !important;">{{$titulo}}</td>
								<td class="text-center" style="font-size: 12px !important;">
									{{$estudiante->asistenciaParcial("p1{$quimestre}")[$tipoFalta] + $estudiante->asistenciaParcial("p2{$quimestre}")[$tipoFalta] +$estudiante->asistenciaParcial("p3{$quimestre}")[$tipoFalta]}}
								</td>
							</tr>
						@endforeach
					</table>
				</td>
			</tr>
		</table>
		@php $asignaturaCualitativa = ($curso->seccion!="BGU" ? true : false ); @endphp
		@include('partials.reglamento',  ( [
				'asignaturaCualitativa' => $asignaturaCualitativa, 'inicial' => false
			]))
			<br>
		<table class="table">
			<tr>
				<td width="30%" class="no-border text-center" style="font-size: 12px !important;">
					<hr style="border:1px solid black;">
					{{$institution->representante1}}
					<br> {{$institution->cargo1}}
				</td>
				<td class="no-border" width="5%"></td>
				<td width="30%" class="no-border text-center" style="font-size: 12px !important;">
					<hr style="border:1px solid black;">
					{{ $tutor == null ? "-" : $tutor->apellidos }} {{ $tutor == null ? "-" : $tutor->nombres }}
					<br> {{$tutor == null ? "-" : ($tutor->sexo == 'Masculino' ? 'TUTOR' : 'TUTORA')}}
				</td>
				<td class="no-border" width="5%"></td>
				<td width="30%" class="no-border text-center" style="font-size: 12px !important;">
					<hr style="border:1px solid black;">
					@if ($nombre_representante_libreta_parcial->valor == '1')
						@if ($student->representante != null)
							{{$student->representante->apellidos}} {{$student->representante->nombres}}
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
			<tr>
				<td class="no-border text-center">
					{{$institution->direccion}}
				</td>
			</tr>
		</table>
		<p class="new-page">
		@endforeach
	</main>
</body>
</html>