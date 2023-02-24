<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Acta de Refuerzo Académico</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
.table td,
.table th {
	font-size: 7pt !important;
}

</style>
@php
$n_parcial = "";
$quimestre = "";
switch ($parcial){
	case "p1q1":
		$n_parcial = "primer";
		$quimestre = "primer";
	break;
	case "p2q1":
		$n_parcial = "segundo";
		$quimestre = "primer";
	break;
	case "p3q1":
		$n_parcial = "tercer";
		$quimestre = "primer";
	break;
	case "p1q2":
		$n_parcial = "primer";
		$quimestre = "segundo";
	break;
	case "p2q2":
		$n_parcial = "segundo";
		$quimestre = "segundo";
	break;
	case "p3q2":
		$n_parcial = "tercer";
		$quimestre = "segundo";
	break;

}
@endphp
<body>
	<main>
		<div class="actaCalificacionesParcial__header">
			<h3 class="text-center uppercase bold m-0">{{ $institution->nombre}} </h3>
			<h3 class="text-center uppercase m-0">acta de refuerzo académico del {{ $n_parcial }} parcial del {{ $quimestre }} quimestre</h3>
			<h3 class="text-center uppercase m-0">año lectivo: {{$periodo}}  </h3>
		</div>
		<br>
		<br>
		<table class="table">
			<tr>
				<th class="p-0">
					<h3 class="m-0 uppercase text-left">nivel: @if($course->seccion == "EI")
							Educación inicial
						@elseif($course->seccion == "EGB")
							Educación general básica
						@else($course->seccion == "BGU")
							Bachillerato general unificado
						@endif
					</h3>
				</th>
				<th class="p-0">
					<h3 class="m-0 uppercase text-right">fecha: {{ $now->format('d/m/Y') }}</h3>
				</th>
			</tr>
			<tr>
				<th class="p-0">
					<h3 class="m-0 uppercase text-left">{{ $course->grado }} {{ $course->paralelo }}</h3>
				</th>
			</tr>
			<tr>
				<th class="p-0">
					<h3 class="m-0 uppercase text-left">asignatura: {{ $matter->nombre }}</h3>
				</th>
				<th class="p-0">
					<h3 class="m-0 uppercase text-right">profesor: {{ $teacher->apellidos }} {{ $teacher->nombres }}</h3>
				</th>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<td class="text-center uppercase">nombre</td>
				@foreach($supplies as $supply)
				<td class="text-center no-border" width="20">
					<p class="s-calificaciones__materia">
						<span class="up">{{ $supply->nombre}}</span>
					</p>
				</td>
				@endforeach
				<td colspan="4" class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="up">recuperación academica</span>
					</p>
				</td>
				<td colspan="2" class="text-center no-border" width="40">
					<p class="s-calificaciones__materia">
						<span class="up">nota parcial</span>
					</p>
				</td>
			</tr>
			<tr>
				<td></td>
			@foreach($supplies as $supply)
				<td class="uppercase text-center">n</td>
			@endforeach
				<td class="text-center">ra1</td>
				<td class="text-center">ra2</td>
				<td class="text-center">ra3</td>
				<td class="text-center">ra4</td>
				<td class="text-center" width="80">PI</td>
				<td class="text-center" width="80">PG</td>
			</tr>
			@foreach($students as $student)
			<tr>
			@php 
			$pi = 0;
			$pg = 0;
			@endphp
				<td>{{ $student->apellidos }} {{ $student->nombres }}</td>		
				@foreach($supplies as $supply)	
				<td class="text-center">{{  bcdiv($promedios[$supply->id][$student->id]['promedio'], '1', 2) }}</td>
				@php 
				$pi = 0;
				$pg = 0;
				foreach($data as $d){
                    if($d->estudiante->ID == $student->id){
                        $p = new \Illuminate\Support\Collection($d->parcial);	
                        $prom = $p->where('materiaId', $matter->id)->first();
						$pi = $prom->promedioInicial;
						$pg = $prom->promedioFinal;
                       
                    }                        
                }
				// $pi += bcdiv($promedios[$supply->id][$student->id]['promedio'], '1', 2);
				// $pg += bcdiv($promedioFinal[$supply->id][$student->id]['promedio'], '1', 2);
				@endphp
				
				@endforeach
				@foreach($supplies->where('es_aporte', 0) as $supply)
					<td class="text-center">
					@if($refuerzos[$supply->id][$student->id]['promedio']>0)
						{{  bcdiv($refuerzos[$supply->id][$student->id]['promedio'], '1', 2) }}
					@endif
					</td>
				@endforeach

				<td class="text-center">
					@if($pi != 0)
						{{ bcdiv(($pi), '1', 2) }}
					@else
						 0
					 @endif
					</td>
					
					<td class="text-center">
					@if($pg != 0 && $pg != $pi)
						{{ bcdiv(($pg), '1', 2) }}
					@else
						 
					 @endif 
					</td>
			</tr>
			@endforeach
		</table>
	</main>
</body>

</html>