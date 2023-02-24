@php
	use App\Area;
	use App\Institution;
	$institution =Institution::first();
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Parcial</title>
	<link rel="stylesheet" href=" {{secure_asset('css/pdf/pdf.css')}} ">
</head>
@php
$nParcial = "";
$nQuimestre = "";
$promedio_total_materiaInsumoActivo=0;
$n_materiaInsumoActivo=0;
$sum_proy_materiaInsumo=0;
$cont_proy_materiaInsumo=0;
switch($parcial){
	case "p1q1":$nParcial = "1";$nQuimestre = "1";break;
	case "p2q1":$nParcial = "2";$nQuimestre = "1";break;
	case "p3q1":$nParcial = "3";$nQuimestre = "1";break;
	case "p1q2":$nParcial = "1";$nQuimestre = "2";break;
	case "p2q2":$nParcial = "2";$nQuimestre = "2";break;
	case "p3q2":$nParcial = "3";$nQuimestre = "2";break;
}
$n_parcial =  $nParcial;
@endphp
<body>
	<main>
	@foreach($data->sortBy('apellidos') as $student)
	@if ($students->find($student->estudianteId))
		<header class="mb-0">
				@include('partials.encabezados.libreta-formato-vertical', [
					'reportName' => 'Libreta',
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
                <td rowspan="2" class="text-center bold uppercase">Asignaturas</td>
				<td colspan="{{ count($insumos)+1}}" class="text-center bold uppercase">parcial {{ $nParcial }}</td>
				</tr>
				<tr>
				@foreach($insumos as $insumo)
					<td class="text-center bold uppercase">{{ $insumo->nombre }}</td>
				@endforeach
				<td class="text-center bold uppercase">Prom. F</td>
				</tr>
				@php
					$dat = new \Illuminate\Support\Collection($student->parcial);
					$prGeneral = 0;
					$contMaterias = 0;
					$verPromedio = true;
					if ($tipo_libreta=='0') {
						$dat = $dat->sortBy('nombreMateria');
					} else {
						$dat = $dat->sortBy(function($model) {
							$lstMaterias = [
								'LENGUA Y LITERATURA', 'MATEMATICA',
								'CIENCIAS NATURALES', 'ESTUDIOS SOCIALES', 'CIENCIAS SOCIALES',
								'EDUCACION CULTURAL Y ARTISTICA', 'EDUCACION FISICA',
								'INGLES', 'LENGUA EXTRANJERA', 'PROYECTOS ESCOLARES', 'OPTATIVA'
							];
							$sort = array_search($model->area, $lstMaterias);
							return $sort;
						});
					}
				@endphp
				@foreach($dat->groupBy('areaId') as $key => $mFijas)
					@php
						$prNota = [];
						$prRefuerzo = [];
						$prI = 0;
						$prF = 0;
						$area = Area::find($key);
						$dependiente = $area != null ? $area->dependiente : false;
						foreach ($insumos as $insumo) {
							$prNota[$insumo->nombre] = 0;
							$prRefuerzo[$insumo->nombre] = 0;
						}
					@endphp
					@if(!$dependiente)

						@foreach($mFijas as $materia)
							@php
								$verPromMateria = true;
									$suma_materiaInsumoActivo[$materia->materiaId]=0;
									$contador_materiaInsumoActivo[$materia->materiaId]=0;
							@endphp
							@if($materia->principal == 1)
							<tr>
								<td class="pdfSubmateria uppercase">
									@if(count($mFijas) > 1)
										{{-- <img src="{{ secure_asset('img/level-up.png') }}" alt=""> --}}
									@endif
									{{ $materia->nombreMateria }}
								</td>
								@foreach($insumos as $ins)
									@foreach($materia->insumos as $insumo)
									@if($ins->nombre == $insumo->nombre)
											<td class="text-center"
											@if($notasMenores == "1")

												@if($insumo->nota < (int)$nota_menor->valor && $insumo->nota!=0)
													style="color:red;"
												@endif
											@endif
											>{{ bcdiv($insumo->nota, '1', 2) }}</td>
											@php
												$prNota[$insumo->nombre] += (float)$insumo->nota;
												if($insumo->nota == 0 && $PromedioInsumo ==0){
													$verPromMateria = false;
													$verPromedio = false;
												}else{
													if ($insumo->nota!=0) {
													$contador_materiaInsumoActivo[$materia->materiaId]++;
													}
													if ($insumo->refuerzo!=0) {
													$contador_materiaInsumoActivo[$materia->materiaId]++;
													$suma_materiaInsumoActivo[$materia->materiaId]+= $insumo->refuerzo;
													}
													$suma_materiaInsumoActivo[$materia->materiaId]+= $insumo->nota;
												}
											@endphp
										@endif
									@endforeach
								@endforeach
								@php
										$prGeneral += bcdiv(($materia->promedioInicial == $materia->promedioFinal) ? $materia->promedioInicial : $materia->promedioFinal, '1', 2);
								$contMaterias++;
								@endphp
								@if($PromedioInsumo ==0)
									@if($verPromMateria )
										<td class="text-center"
									@if($notasMenores == "1")
										@if($materia->promedioFinal < (int)$nota_menor->valor && $materia->promedioFinal!=0)
											style="color:red;"
										@endif
									@endif
									>{{ bcdiv($materia->promedioFinal, '1', 2) }} </td>
									@else
										<td class="text-center"></td>
									@endif
								@else
								<td class="text-center"
									@if($notasMenores == "1")
										@if(($contador_materiaInsumoActivo[$materia->materiaId]>0?bcdiv(($suma_materiaInsumoActivo[$materia->materiaId] / $contador_materiaInsumoActivo[$materia->materiaId]), '1', 2):0) < (int)$nota_menor->valor)
											style="color:red;"
										@endif
									@endif
									>{{$contador_materiaInsumoActivo[$materia->materiaId]>0 ? bcdiv(($suma_materiaInsumoActivo[$materia->materiaId] / $contador_materiaInsumoActivo[$materia->materiaId]), '1', 2): 0}}</td>
									@php
									$promedio_total_materiaInsumoActivo += $contador_materiaInsumoActivo[$materia->materiaId]>0 ? bcdiv(($suma_materiaInsumoActivo[$materia->materiaId] / $contador_materiaInsumoActivo[$materia->materiaId]), '1', 2): 0;
									$n_materiaInsumoActivo++;
									@endphp
								@endif
							</tr>
							@endif
						@endforeach

					@else
					@php
						$verPromMateria = true;
						$prInsMaterias = [];
						$prMaterias = 0;

						foreach ($insumos as $insumo) {
							$prInsMaterias[$insumo->nombre] = 0;
						}
					@endphp
						@foreach($mFijas as $materia)
							@php
								foreach ($insumos as $ins) {
									foreach ($materia->insumos as $insumo) {

										if($ins->nombre == $insumo->nombre) {
											$prInsMaterias[$insumo->nombre] += bcdiv($insumo->nota, '1', 2);
										}
									}
								}
								$prMaterias += bcdiv($materia->promedioFinal, '1', 2);

							@endphp
						@endforeach
						@php
							$materia = $mFijas->where('principal', 1)->first();
							if($materia == null) {
								throw new Exception ("area ".$area->nombre." no contiene materia principal");
							}
						@endphp
						<tr>
							<td class="pdfSubmateria uppercase">
								@if(count($mFijas) > 1)
									{{-- <img src="{{ secure_asset('img/level-up.png') }}" alt=""> --}}
								@endif
								{{ $materia->nombreMateria }}
							</td>
								@foreach ($insumos as $insumo)
									<td class="text-center"
									@if($notasMenores == "1")
										@if($prInsMaterias[$insumo->nombre] < (int)$nota_menor->valor && $prInsMaterias[$insumo->nombre]!=0)
											style="color:red;"
										@endif
									@endif
									>{{ bcdiv($prInsMaterias[$insumo->nombre]/count($mFijas), '1', 2) }}</td>
									@php
										$prNota[$insumo->nombre] += (float)$prInsMaterias[$insumo->nombre];
										if($prInsMaterias[$insumo->nombre] == 0){
											$verPromMateria = false;
											$verPromedio = false;
										}
									@endphp
								@endforeach
							@php
							$prGeneral += bcdiv($prMaterias / count($mFijas), '1', 2);
							$contMaterias++;
							@endphp

							@if($verPromMateria)
								<td class="text-center"
							@if($notasMenores == "1")
								@if($materia->promedioFinal < (int)$nota_menor->valor && $materia->promedioFinal!=0)
									style="color:red;"
								@endif
							@endif
							>{{ bcdiv($prMaterias / count($mFijas), '1', 2) }}</td>
							@else
								<td class="text-center"> </td>
							@endif
						</tr>
					@endif
				@endforeach
				<tr>
					<td class="uppercase">Promedio General</td>
					<td colspan="{{ count($student->parcial[0]->insumos)  }}"></td>

					@if($PromedioInsumo ==0)
						@if($verPromedio)
							<td class="text-center"
							@if($notasMenores == "1")
								@if(($contMaterias>0?$prGeneral/$contMaterias:0) < (int)$nota_menor->valor)
									style="color:red;"
								@endif
							@endif
							>{{ $contMaterias>0?bcdiv($prGeneral/$contMaterias , '1', 2):0 }}</td>
						@else
							<td class="text-center"> </td>
						@endif
					@else
					<td class="text-center"
							@if($notasMenores == "1")
								@if(($n_materiaInsumoActivo>0?bcdiv($promedio_total_materiaInsumoActivo/$n_materiaInsumoActivo , '1', 2):0) < (int)$nota_menor->valor)
									style="color:red;"
								@endif
							@endif
							>{{$n_materiaInsumoActivo>0?bcdiv($promedio_total_materiaInsumoActivo/$n_materiaInsumoActivo , '1', 2):0 }}</td>
							@php
							$promedio_total_materiaInsumoActivo =0;
							$n_materiaInsumoActivo=0;
							@endphp
					@endif
				</tr>
				<tr>
					<td class="bold" colspan="{{ count($student->parcial[0]->insumos)+2 }}">Asignaturas Adicionales
					</td>
				</tr>
				@php
					$dat = new \Illuminate\Support\Collection($student->parcial);
					$verPromedio = true;
					$verPromMateria = true;
				@endphp
				@foreach($dat->groupBy('areaId') as $key => $mFijas)

					@foreach($mFijas as $materia)
						@if($materia->principal==0 AND $materia->visible==1)
							@if($materia->area!='DESARROLLO HUMANO INTEGRAL')

							@if($materia->area=='PROYECTOS ESCOLARES')
								<tr>
									<td class="pdfSubmateria uppercase">
										{{ $materia->nombreMateria}}
									</td>
									@foreach( $insumos as $ins )
										@foreach($materia->insumos as $insumo)
											@if($ins->nombre == $insumo->nombre)
												<td class="text-center">
												@if ($PromedioInsumo ==0)
													@if($insumo->nota != 0 )
														 {{App\Calificacion::notaCualitativa($insumo->nota)}}
													@else

													@endif
												@else
												@php
												if ($insumo->nota != 0 ) {
												$sum_proy_materiaInsumo+= $insumo->nota;
												$cont_proy_materiaInsumo++;
												}if ($insumo->refuerzo!=0) {
												$sum_proy_materiaInsumo+=$insumo->refuerzo;
												$cont_proy_materiaInsumo++;
												}
												@endphp
												 {{App\Calificacion::notaCualitativa($insumo->nota)}}
												@endif
												</td>
												@php
													$prNota[$insumo->nombre] += (float)$insumo->nota;
												@endphp
											@endif
										@endforeach
									@endforeach
									<td class="text-center">
									@if ($PromedioInsumo ==0)
										@if($materia->promedioInicial  != 0)
											{{App\Calificacion::notaCualitativa($materia->promedioInicial)}}
										@else
										@endif
									@else
									{{$sum_proy_materiaInsumo>0 ?App\Calificacion::notaCualitativa($sum_proy_materiaInsumo/ $cont_proy_materiaInsumo): ''}}
									@php
									$sum_proy_materiaInsumo=0;
									$cont_proy_materiaInsumo=0;
									@endphp
									@endif
									</td>
								</tr>
							@else
								<!-- No está funcionando para R.A -->
								<tr>
									<td class="pdfSubmateria uppercase">
										{{ $materia->nombreMateria}}
									</td>
									@foreach( $insumos as $ins )
										@foreach($materia->insumos as $insumo)
											@if($ins->nombre == $insumo->nombre)

												<td class="text-center">
													@if($insumo->nota != 0)
														{{ $insumo->nota }}
													@else

													@endif
												</td>
												@php
													$prNota[$insumo->nombre] += (float)$insumo->nota;
													if($insumo->nota == 0){
														$verPromMateria = false;
														$verPromedio = false;
													}
												@endphp
											@endif
										@endforeach
									@endforeach
									@php
										$prGeneral +=  bcdiv(($materia->promedioInicial == $materia->promedioFinal) ? $materia->promedioInicial : $materia->promedioFinal, '1', 2);
										$contMaterias++;
									@endphp

									<td class="text-center">
										@if($verPromedio)
											{{$materia->promedioFinal}}
										@else

										@endif
									</td>
								</tr>
							@endif
							@endif
						@endif
					@endforeach
				@endforeach
				<tr>
					<td class="uppercase">comportamiento</td>
					<td colspan="{{ count($student->parcial[0]->insumos)+1  }}"
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
					<td class="bold">Asistencia0
						<small>(Por horas de clase)</small>
					</td>
					<td colspan="{{ count($student->parcial[0]->insumos)+1  }}" class="text-center bold uppercase">Parcial {{ $nParcial }}</td>
				</tr>
				@php
					$estudiante = App\Student2Profile::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
						->where('idStudent', $student->estudiante->ID)
						->first();
				@endphp
				<tr>
					<td class="uppercase">Faltas Justificadas</td>
					<td colspan="{{ count($student->parcial[0]->insumos)+1  }}" class="text-center">{{$estudiante->asistenciaParcial($parcial)['faltas_justificadas']}}</td>
				</tr>
				<tr>
					<td class="uppercase">Faltas Injustificadas</td>
					<td colspan="{{ count($student->parcial[0]->insumos)+1  }}" class="text-center">{{$estudiante->asistenciaParcial($parcial)['faltas_injustificadas']}}</td>
				</tr>
				<tr>
					<td class="uppercase">Atrasos</td>
					<td colspan="{{ count($student->parcial[0]->insumos)+1  }}" class="text-center">{{$estudiante->asistenciaParcial($parcial)['atrasos']}}</td>
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
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center ">
					<hr class="certificado__hr">
					<p class="uppercase bold">
						{{ $tutor->apellidos }} {{ $tutor->nombres }}
						<br> DOCENTE
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
						<br> SECRETARIA
					</p>
				</div>
			</div>
			<br>
			@include('partials.reglamento', [
				'asignaturaCualitativa' => true
			])
		</section>
		<div style="page-break-after:always;"></div>
	@endif
	@endforeach
	</main>
</body>

</html>