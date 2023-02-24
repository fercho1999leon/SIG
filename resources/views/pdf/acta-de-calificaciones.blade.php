<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Acta de Calificaciones</title>
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
		<div class="actaCalificaciones__titulo">
			<p class="text-center uppercase bold"> {{ $institution->nombre}}</p>
			<p class="text-center uppercase bold">acta de calificaciones del {{ $n_parcial }} parcial del {{ $quimestre }} quimestre</p>
			<p class="text-center uppercase">año lectivo: {{$periodo}}</p>
		</div>
		<br>
		<table class="w100">
			<tr>
				<!-- <td class="text-left uppercase">Nivel: Educación general basica</td> -->
				<td colspan="2" class="text-center uppercase">Fecha: {{$now->format('d/m/Y')}}</td>
			</tr>
			<tr>
				<td colspan="2" class="text-left uppercase">{{ $course->grado }} {{ $course->paralelo }}</td>
			</tr>
			<tr>
				<td class="text-left uppercase">Asignatura: <span class="uppercase">{{ $matter->nombre }}</span></td>
				<td class="text-right uppercase">Profesor: <span class="uppercase">{{ $teacher->apellidos }} {{ $teacher->nombres }} </span></td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td class="text-center">No.</td>
				<td>NOMBRE</td>
				@foreach($supplies as $supply)
				<td class="text-center">
					<div class="">
						{{ $supply->nombre}}
					</div>
				</td>
				@endforeach
				<td class="text-center">
					<span class="actaCalificaciones__act">Nota Parcial</span>
				</td>
			</tr>
			@php $c = 1;  @endphp
			@foreach($students as $student)
			@php
			$acumulado=0;
			$j =0;
			@endphp
			<tr>
				<td  class="text-center">{{ $c }}</td>
				<td class="whitespace-no">{{ $student->apellidos}} {{ $student->nombres }}</td>
				@foreach($supplies as $supply)
					@if($supply->nombre != "EVALUACION")
						<td class="text-center"> {{  bcdiv($promedios[$supply->id][$student->id]['promedio'], '1', 2) }}</td>
					@php
					$j += 1;
					$acumulado+=bcdiv($promedios[$supply->id][$student->id]['promedio'], '1', 2);
					@endphp
					@else
						<td class="text-center"></td>
					@endif
				@endforeach
				@if($acumulado != 0)
					<td class="text-center">{{bcdiv( ($acumulado / $j), '1', 2) }}</td>
				@else
					<td class="text-center">-</td>
				@endif
				@php $c++;  @endphp

			</tr>
			@endforeach
		</table>
		<br>
		<br>
		<table class="table">
			<tr>
				<th width="10%"></th>
				<th width="35%">
					<hr style="border:1px solid black;">
					<h3 class="m-0 text-center">Profesor</h3>
				</thw>
				<th width="10%"></th>
				<th width="35%">
					<hr style="border:1px solid black; ">
					<h3 class="m-0 text-center">Fecha de Entrega</h3>
				</th>
				<th width="10%"></th>
			</tr>
		</table>
	</main>
</body>

</html>
