@php
	use App\Area;
	use App\Matter;
	//para ocultar los promedios en parciales que no esten activos
	$ver_promedio1 ='display: none;';
	$ver_promedio2 ='display: none;';
	$ver_promedio3 ='display: none;';
	$ver_promedioE ='display: none;';
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Libreta Quimestre</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
		@foreach($students as $student)
		@php
			$pp1=0;
	        $pp2=0;
	        $pp3=0;
	        $pexa=0;
	        $pP=0;
	        $pR=0;
	        $pPQ1=0;
			$mostrarP1 = true;
			$mostrarP2 = true;
			$mostrarP3 = true;
			$mostrarEX = true;
			$mostrarPR = true;
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
				<td class="uppercase">{{ $curso->grado }} {{ $curso->paralelo }} {{ $curso->especializacion }}</td>
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
					<td class="text-center bold">{{$par->nombre}}</td>
				@endforeach
				<td class="text-center bold">PROM. {{$quimestre}}</td>
			</tr>
			@php
			if (count($students) >1){
				$materiasFinal = $materiasFijas->get();
			}else {
				$materiasFinal = $materiasFijas;
			}
			@endphp
			@foreach($materiasFinal->groupBy('idArea') as $key => $mFijas)
				@php
					$prNota = [];
					$prI = 0;
					$prF = 0;
					$area = Area::find($key);
					$dependiente = $area != null ? $area->dependiente : false;
				@endphp
				@if(!$dependiente)
					@foreach($mFijas as $materia)
					<tr>
						<td class="uppercase pdfSubmateria">
							{{ $materia->nombre}}
						</td>
						@foreach($parcialP as $par )
						@php
						$P_promediosparcial=0;
						switch ($par->identificador) {
						case 'p1'.$quimestre:
						$ver_promedio1 ='';
						$promediosparcial = $promediosP1[$materia->id][$student->id]['promedio'];
						$pp1 = $pp1+bcdiv($promediosparcial, '1', 2);
						$P_promediosparcial=$pp1;
						if ($promediosparcial == 0) {
							$mostrarP1 = false;
						}
						break;
						case 'p2'.$quimestre:
						$ver_promedio2 ='';
						$promediosparcial = $promediosP2[$materia->id][$student->id]['promedio'];
						$pp2 = $pp2+bcdiv($promediosparcial, '1', 2);
						$P_promediosparcial=$pp2;
						if ($promediosparcial == 0) {
							$mostrarP2 = false;
						}
						break;
						case 'p3'.$quimestre:
						$ver_promedio3 ='';
						$promediosparcial = $promediosP3[$materia->id][$student->id]['promedio'];
						$pp3 = $pp3+bcdiv($promediosparcial, '1', 2);
						$P_promediosparcial=$pp3;
						if ($promediosparcial == 0) {
							$mostrarP3 = false;
						}
						break;
						case $quimestre:
						$ver_promedio4 ='';
						$promediosparcial = $examenes[$materia->id][$student->id];
						$pexa =$pexa+$examenes[$materia->id][$student->id];
						$P_promediosparcial=$pexa;
						if ($promediosparcial == 0) {
							$mostrarEX = false;
						}
						break;
						}
						@endphp
						<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosparcial < 7 && $promediosparcial!=0)
									style="color:red;"
								@endif
							@endif
							>
							{{  bcdiv($promediosparcial, '1', 2) }}
							<span style="display: none">
								-{{ $P_promediosparcial}}
							</span>
						</td>
						@endforeach
						<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosFinal[$materia->id][$student->id] < 7 && $promediosFinal[$materia->id][$student->id]!=0)
									style="color:red;"
								@elseif( $promediosFinal[$materia->id][$student->id] == 0)
									@php
										$mostrarPR = false;
									@endphp
								@endif
							@endif
								>
								@if($promediosFinal[$materia->id][$student->id] != 0)
									{{  $promediosFinal[$materia->id][$student->id] }}
								@endif
							<span style="display: none">
								-{{ $pPQ1=$pPQ1+$promediosFinal[$materia->id][$student->id] }}
							</span>
						</td>
					</tr>
					@endforeach
				@else
				@php
					$mostrar1 = true;
					$mostrar2 = true;
					$mostrar3 = true;
					$mostrarex = true;
					$mostrarpr = true;
					$pr1 = 0;
					$pr2 = 0;
					$pr3 = 0;
					$ex = 0;
					$prf = 0;
					$materiaPrincipal = $mFijas->where('principal', 1)->first();
					$materiasArea = Matter::where(['idCurso' => $curso->id,'idArea' => $key])->get();
				@endphp
				@foreach($materiasArea as $materia)
					@php
						if($promediosP1[$materia->id][$student->id]['promedio'] == 0) {
							$mostrar1 = false;
						}
						if($promediosP2[$materia->id][$student->id]['promedio'] == 0) {
							$mostrar2 = false;
						}
						if($promediosP3[$materia->id][$student->id]['promedio'] == 0) {
							$mostrar3 = false;
						}
						if($examenes[$materia->id][$student->id] == 0) {
							$mostrarex = false;
						}
						if($promediosFinal[$materia->id][$student->id] == 0) {
							$mostrarpr = false;
						}

						$pr1 += $promediosP1[$materia->id][$student->id]['promedio'];
						$pr2 += $promediosP2[$materia->id][$student->id]['promedio'];
						$pr3 += $promediosP3[$materia->id][$student->id]['promedio'];
						$ex += $examenes[$materia->id][$student->id];
						$prf += $promediosFinal[$materia->id][$student->id];
					@endphp
				@endforeach
				@php
				@endphp
				<tr>
					<td class="uppercase pdfSubmateria">
						{{ $materiaPrincipal->nombre}}
					</td>
					<td class="text-center"
						@if($notasMenores == "1")
							@if(($pr1 / 3) < 7 && ($pr1 / 3)!=0)
								style="color:red;"
							@elseif(($pr1 / 3) == 0)
								@php
									$mostrarP1 = false;
								@endphp
							@endif
						@endif
						>
						{{  $mostrar1 ? bcdiv(($pr1 / 3), '1', 2) : '' }}
						<span style="display: none">
							-{{ $pp1=$pp1+bcdiv(($pr1 / 3), '1', 2)}}
						</span>
					</td>
					<td class="text-center"
						@if($notasMenores == "1")
							@if(($pr2 / 3) < 7 && ($pr2 / 3)!=0)
								style="color:red;"
							@elseif( ($pr2 / 3) == 0)
								@php
									$mostrarP2 = false;
								@endphp
							@endif
						@endif
							>
						{{  $mostrar2 ? bcdiv(($pr2 / 3), '1', 2) : '' }}
						<span style="display: none">
							-{{ $pp2=$pp2+bcdiv(($pr2 / 3), '1', 2)}}
						</span>
					</td>
					<td class="text-center"
						@if($notasMenores == "1")
							@if(($pr3 / 3) < 7 && ($pr3 / 3)!=0)
								style="color:red;"
							@elseif( ($pr3 / 3) == 0)
								@php
									$mostrarP3 = false;
								@endphp
							@endif
						@endif
							>
						{{ $mostrar3 ? bcdiv(($pr3 / 3), '1', 2) : ''}}
						<span style="display: none">
							-{{ $pp3=$pp3+bcdiv(($pr3 / 3), '1', 2)}}
						</span>
					</td>
					<td class="text-center"
						@if($notasMenores == "1")
							@if(($ex/3) < 7 && ($ex/3)!=0)
								style="color:red;"
							@elseif( ($ex/3) == 0)
								@php
									$mostrarEX = false;
								@endphp
							@endif
						@endif
							>
						{{ $mostrarex ? bcdiv(($ex/3), '1', 2) : '' }}
						<span style="display: none">
							-{{ $pexa=$pexa+($ex/3) }}
						</span>
					</td>
					<!--
						<td class="text-center"
							@if($notasMenores == "1")
								@if($promediosTotal[$materia->id][$student->id] < 7 && $promediosTotal[$materia->id][$student->id]!=0)
									style="color:red;"
								@endif
							@endif
								>
							{{  $promediosTotal[$materia->id][$student->id] }}
							<span style="display: none">
								-{{ $pP=$pP+$promediosTotal[$materia->id][$student->id] }}
							</span>
						</td>
						<td class="text-center"
							@if($notasMenores == "1")
								@if($recuperacion[$materia->id][$student->id] < 7 && $recuperacion[$materia->id][$student->id]!=0)
									style="color:red;"
								@endif
							@endif
								>
							{{  $recuperacion[$materia->id][$student->id] }}
							<span style="display: none">
								-{{ $pR=$pR+$recuperacion[$materia->id][$student->id] }}
							</span>
						</td>
					-->
					<td class="text-center"
						@if($notasMenores == "1")
							@if(($prf/3) < 7 && ($prf/3)!=0)
								style="color:red;"
							@elseif( ($prf/3) == 0)
								@php
									$mostrarPR = false;
								@endphp
							@endif
						@endif
							>
							@if(($prf/3) != 0)
								{{ $mostrarpr ? bcdiv(($prf/3), '1', 2) : ''}}
							@endif
						<span style="display: none">
							-{{ $pPQ1=$pPQ1+($prf/3) }}
						</span>
					</td>
				</tr>
				@endif
			@endforeach
			<tr>
				<td class="uppercase bold">Promedio de Aprendizajes</td>
				<td class="text-center"
						@if($notasMenores == "1")
							@if( ( count($materiasFinal)>0?$pp1/count($materiasFinal):0 ) < 7)
								style="color:red; {{$ver_promedio1}}"
							@endif
						@endif
						>
						@if($mostrarP1)
						{{ bcdiv(count($materiasFinal)>0?$pp1/count($materiasFinal):0, '1', 2) }}
						@endif
				</td>
				<td class="text-center"
						@if($notasMenores == "1")
							@if((count($materiasFinal)>0?$pp2/count($materiasFinal):0 ) < 7)
								style="color:red; {{$ver_promedio2}}"
							@endif
						@endif
						>
						@if($mostrarP2)
						{{ bcdiv(count($materiasFinal)>0?$pp2/count($materiasFinal):0, '1', 2) }}
						@endif

				</td>
				<td class="text-center"
						@if($notasMenores == "1")
							@if((count($materiasFinal)>0?$pp3/count($materiasFinal):0) < 7)
								style="color:red; {{$ver_promedio3}}"
							@endif
						@endif
						>
						@if($mostrarP3)
						{{ bcdiv(count($materiasFinal)>0?$pp3/count($materiasFinal):0, '1', 2) }}
						@endif
				</td>
				<td class="text-center"
						@if($notasMenores == "1")
							@if((count($materiasFinal)>0?$pexa/count($materiasFinal):0) < 7)
								style="color:red; {{$ver_promedioE}}"
							@endif
						@endif
						>
						@if($mostrarEX)
						{{ bcdiv(count($materiasFinal)>0?$pexa/count($materiasFinal):0, '1', 2) }}
						@endif

				</td>
				<!--
					<td class="text-center"
						@if($notasMenores == "1")
							@if((count($materiasFinal)>0?$pP/count($materiasFinal):0) < 7)
								style="color:red;"
							@endif
						@endif
						>{{ bcdiv(count($materiasFinal)>0?$pP/count($materiasFinal):0, '1', 2) }}
					</td>
					<td class="text-center"
						@if($notasMenores == "1")
							@if((count($materiasFinal)>0?$pR/count($materiasFinal):0) < 7)
								style="color:red;"
							@endif
						@endif
						>{{ bcdiv(count($materiasFinal)>0?$pR/count($materiasFinal):0, '1', 2) }}
					</td>
				-->
				<td class="text-center"
						@if($notasMenores == "1")
							@if((count($materiasFinal)>0?$pPQ1/count($materiasFinal):0) < 7)
								style="color:red;"
							@endif
						@endif
						>
						@if($mostrarPR)
						{{ bcdiv(count($materiasFinal)>0?$pPQ1/count($materiasFinal):0, '1', 2) }}
						@endif
				</td>
			</tr>
			<tr>
				<td class="bold" colspan="10">Asignaturas Adicionales</td>
			</tr>
			@foreach($materiasExtra->groupBy('area') as $key => $mExtra)
				@foreach($mExtra as $materia)
					@if($materia->nombre=='PROYECTOS' || $materia->nombre=='PROYECTOS ESCOLARES')
						<tr>
							<td class="uppercase pdfSubmateria">
								PROYECTOS ESCOLARES
							</td>
							@foreach($parcialP as $par )
							@php
							switch ($par->identificador) {
								case 'p1'.$quimestre:
									$promediosparcial_cualitativo = $promediosP1[$materia->id][$student->id]['promedio'];
									$pp1=$pp1+bcdiv($promediosparcial_cualitativo, '1', 2);
									break;
								case 'p2'.$quimestre:
									$promediosparcial_cualitativo = $promediosP2[$materia->id][$student->id]['promedio'];
									$pp2=$pp2+bcdiv($promediosparcial_cualitativo, '1', 2);
									break;
								case 'p3'.$quimestre:
									$promediosparcial_cualitativo = $promediosP3[$materia->id][$student->id]['promedio'];
									$pp3=$pp3+bcdiv($promediosparcial_cualitativo, '1', 2);
									break;
								case $quimestre:
									$promediosparcial = $examenes[$materia->id][$student->id];
									$pexa=$pexa+$examenes[$materia->id][$student->id];
									break;
							}
							@endphp
							<td class="text-center">
									@if( bcdiv($promediosparcial_cualitativo, '1', 2)>= 9)
										EX
									@endif

									@if ( bcdiv($promediosparcial_cualitativo, '1', 2)<9 && bcdiv($promediosparcial_cualitativo, '1', 2)>=7)
										MB
									@endif

									@if( bcdiv($promediosparcial_cualitativo, '1', 2)>4 && bcdiv($promediosparcial_cualitativo, '1', 2)<7)
										B
									@endif

									@if( bcdiv($promediosparcial_cualitativo, '1', 2)>=0 && bcdiv($promediosparcial_cualitativo, '1', 2)<4)
										R
									@endif
								</td>
								@endforeach
								<td class="text-center">
									@if( $promediosFinal[$materia->id][$student->id]>= 9)
										EX
									@endif

									@if ( $promediosFinal[$materia->id][$student->id]<9 && $promediosFinal[$materia->id][$student->id]>=7)
										MB
									@endif

									@if( $promediosFinal[$materia->id][$student->id]>4 && $promediosFinal[$materia->id][$student->id]<7)
										B
									@endif

									@if( $promediosFinal[$materia->id][$student->id]>=0 && $promediosFinal[$materia->id][$student->id]<4)
										R
									@endif
									<span style="display: none">
										-{{ $pPQ1=$pPQ1+$promediosFinal[$materia->id][$student->id] }}
									</span>
								</td>
						</tr>
					@else
						<tr>
							<td class="uppercase pdfSubmateria">
								{{ $materia->nombre}}
							</td>
							<td class="text-center">
								{{  bcdiv($promediosP1[$materia->id][$student->id]['promedio'], '1', 2) }}
								<span style="display: none">
									-{{ $pp1=$pp1+bcdiv($promediosP1[$materia->id][$student->id]['promedio'], '1', 2)}}
								</span>
							</td>
							<td class="text-center">
								{{  bcdiv($promediosP2[$materia->id][$student->id]['promedio'], '1', 2) }}
								<span style="display: none">
									-{{ $pp2=$pp2+bcdiv($promediosP2[$materia->id][$student->id]['promedio'], '1', 2)}}
								</span>
							</td>
							<td class="text-center">
								{{  bcdiv($promediosP3[$materia->id][$student->id]['promedio'], '1', 2) }}
								<span style="display: none">
									-{{ $pp3=$pp3+bcdiv($promediosP3[$materia->id][$student->id]['promedio'], '1', 2)}}
								</span>
							</td>
							<td class="text-center">
								{{ $examenes[$materia->id][$student->id] }}
								<span style="display: none">
									-{{ $pexa=$pexa+$examenes[$materia->id][$student->id] }}
								</span>
							</td>
							<td class="text-center">
								{{  $promediosFinal[$materia->id][$student->id] }}
								<span style="display: none">
									-{{ $pPQ1=$pPQ1+$promediosFinal[$materia->id][$student->id] }}
								</span>
							</td>
						</tr>
					@endif
				@endforeach
			@endforeach

			<!-- DHI -->
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
				<td class="uppercase bold">Evaluación comportamental</td>
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
						@forelse($student->comportamientos->where('parcial',$parcial_comp) as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
						</td>

				@endforeach
				<td colspan="2" class="text-center">
						@if($confComportamiento->valor !== 'crear')
							@forelse($student->comportamientos->where('parcial', $parcialP[(count($parcialP)-2)]->identificador) as $comportamiento)
								{{$comportamiento->nota}}
							@empty
								-
							@endforelse
						@else
							@forelse($student->comportamientos->where('parcial', $quimestre) as $comportamiento)
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
				'asignaturaCualitativa' => true
			])
		<div style="page-break-after:always;"></div>
		@endforeach
	</main>
</body>

</html>