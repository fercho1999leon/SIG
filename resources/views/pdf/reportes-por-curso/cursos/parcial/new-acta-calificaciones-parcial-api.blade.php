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
$suma_P_final=0;
$suma_P_final_Comportamiento=0;
$nParcial = "";
$nQuimestre = "";
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
	@foreach($students as $student)
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
				@foreach($materias as $materia)
				@php
						$insumoMateria = App\Supply::getSuppliesByMatter($materia->id)->pluck('id');
						$promInsumos = App\Calificacion::getPromedioSupply($materia->id,$student->idCurso,$parcial);
						$P_final = App\Calificacion::getPromedioMatterParcial($materia->id, $parcial);

				@endphp
					<tr>
						<td class="text-center bold uppercase">{{ $materia->nombre }}</td>
						@foreach($insumoMateria as $insumo)
						<td class="text-center bold uppercase">{{$promInsumos[$insumo][$student->id]['promedio']}}</td>
						@endforeach
						<td class="text-center bold uppercase">{{$P_final[$student->id]['promedio']}}</td>
						@php
						$suma_P_final += $P_final[$student->id]['promedio'];
						@endphp
					</tr>
				@endforeach
					<tr>
						<td class="text-center bold uppercase">Promedio General</td>
						<td colspan="{{ count($insumoMateria)  }}"></td>
						<td class="text-center">{{bcdiv($suma_P_final/count($materias), '1', 2)}}</td>
					</tr>
					@php
					$suma_P_final=0;
					@endphp
					<tr>
						<td class="text-center bold uppercase" colspan="{{ count($insumoMateria)+2 }}">Asignaturas Adicionales
					</td>
					</tr>
					@foreach($materiasExtra->groupBy('area') as $key => $mExtra)
						@foreach($mExtra as $materia)
						@php
						$promInsumos = App\Calificacion::getPromedioSupply($materia->id,$student->idCurso,$parcial);
						@endphp
						@if($materia->nombre=='PROYECTOS' || $materia->nombre=='PROYECTOS ESCOLARES')
						<tr>
								<td class="text-center bold uppercase">
									PROYECTOS ESCOLARES
								</td>
						@foreach($insumoMateria as $insumo)
						<td class="text-center bold uppercase">{{ App\Calificacion::notaCualitativa($promInsumos[$insumo][$student->id]['promedio'])}}</td>
						@php
						$suma_P_final_Comportamiento += $promInsumos[$insumo][$student->id]['promedio'];
						@endphp
						@endforeach
						<td class="text-center bold uppercase">{{  App\Calificacion::notaCualitativa($suma_P_final_Comportamiento)}}</td>
						</tr>
						@endif
						@endforeach
						@php
						$suma_P_final_Comportamiento=0;
						@endphp
					@endforeach
					<tr>
					<td class="uppercase">comportamiento</td>
					<td colspan="{{ count($insumoMateria)+1 }}"
						class="text-center uppercase">
						@forelse ($comportamientos->where('idStudent', $student->idStudent) as $comportamiento)
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
						<td class="bold">Asistencia
						<small>(Por horas de clase)</small>
						</td>
						<td colspan="{{ count($insumoMateria) +1 }}" class="text-center bold uppercase">Parcial {{ $nParcial }}</td>
						</tr>
						<tr>
						<td class="uppercase">Faltas Justificadas</td>
						<td colspan="{{ count($insumoMateria) +1 }}" class="text-center">{{$student->asistenciaParcial($parcial)['faltas_justificadas']}}</td>
						</tr>
						<tr>
						<td class="uppercase">Faltas Injustificadas</td>
						<td colspan="{{ count($insumoMateria)+1  }}" class="text-center">{{$student->asistenciaParcial($parcial)['faltas_injustificadas']}}</td>
						</tr>
						<tr>
						<td class="uppercase">Atrasos</td>
						<td colspan="{{ count($insumoMateria) +1 }}" class="text-center">{{$student->asistenciaParcial($parcial)['atrasos']}}</td>
						</tr>
			</table>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center ">
					<hr class="certificado__hr">
					<p class="uppercase bold">
						{{ $tutor->apellidos }} {{ $tutor->nombres }}
						<br> TUTOR
					</p>
				</div>
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase bold">
						@if ($nombre_representante_libreta_parcial->valor == '1')
							@if($student->idRepresentante != "")
								{{$student->representante()->first()->apellidos}} {{$student->representante()->first()->nombres}}
							@endif
						@endif
						<br> REPRESENTANTE
					</p>
				</div>
			</div>
			<br>
			@include('partials.reglamento', [
				'asignaturaCualitativa' => true
			])
		</section>
		<div style="page-break-after:always;"></div>

	@endforeach
	</main>
</body>

</html>