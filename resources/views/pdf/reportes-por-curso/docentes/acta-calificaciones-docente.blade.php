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
    font-size: 8pt !important;
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
@foreach($courses as $course)
@foreach($matters->where('idCurso', $course->id) as $matter)
	<main>
		<div class="actaCalificaciones__titulo">
			<p class="text-center uppercase bold"> {{ $institution->nombre}}</p>
			<p class="text-center uppercase bold">acta de calificaciones del {{ $n_parcial }} parcial del {{ $quimestre }} quimestre</p>
			<p class="text-center uppercase bold">año lectivo {{$periodo}}  </p>
		</div>
		<br>
		<table class="w100">
			<tr>
			@php
				$nivel = "";
				switch($course->grado){
					case "Primero de Bachillerato":
					$nivel = "Bachillerato General Unificado";
					break;
					case "Segundo de Bachillerato":
					$nivel = "Bachillerato General Unificado";
					break;
					case "Tercero de Bachillerato":
					$nivel = "Bachillerato General Unificado";
					break;
					case "Inicial 1":
					$nivel = "Educación inicial";
					break;
					case "Inicial 2":
					$nivel = "Educación inicial";
					break;
					case "Primero":
					$nivel = "Educación Básica General";
					break;
					case "Segundo":
					$nivel = "Educación Básica General";
					break;
					case "Tercero":
					$nivel = "Educación Básica General";
					break;
					case "Cuarto":
					$nivel = "Educación Básica General";
					break;
					case "Quinto":
					$nivel = "Educación Básica General";
					break;
					case "Sexto":
					$nivel = "Educación Básica General";
					break;
					case "Septimo":
					$nivel = "Educación Básica General";
					break;
					case "Octavo":
					$nivel = "Educación Básica General";
					break;
					case "Noveno":
					$nivel = "Educación Básica General";
					break;
					case "Decimo":
					$nivel = "Educación Básica General";
					break;
				}
			@endphp
			</tr>
			<tr>
				<td class="text-left uppercase">{{ $course->grado }} {{$course->especializacion}} {{ $course->paralelo }}</td>
				<td class="text-right uppercase">Fecha: {{ $fechaA }}</td>
			</tr>
			<tr>
				<td class="text-left uppercase">Asignatura: <span class="uppercase">{{ $matter->nombre }}</span></td>
                <td class="text-right uppercase">Profesor: <span class="uppercase">
				@if($teacher != null)
				{{ $teacher->apellidos }} {{ $teacher->nombres }}
				@endif
				</span></td>
			</tr>
		</table>
		<table class="table">
			<tr>
				<td class="text-center">No.</td>
				<td>NOMBRE</td>
				@foreach($supplies[$course->id][$matter->id] as $supply)
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
			@foreach($students->where('idCurso', $course->id) as $student)
			<tr>
				@php $c = 0;  @endphp
				<td  class="text-center">{{ $loop->iteration }}</td>
				<td class="whitespace-no">{{ $student->apellidos}} {{ $student->nombres }} </td>
				@foreach($supplies[$course->id][$matter->id] as $supply)
					@if($promedios[$course->id][$matter->id][$supply->id][$student->id]['promedio'] != 0)
						<td class="text-center"> {{  bcdiv($promedios[$course->id][$matter->id][$supply->id][$student->id]['promedio'], '1', 2) }}</td>				
					@else
						<td class="text-center">-</td>				
					@endif
					@php $c+=bcdiv($promedios[$course->id][$matter->id][$supply->id][$student->id]['promedio'], '1', 2);@endphp
				@endforeach
				@if($c != 0)
				<td class="text-center">{{bcdiv( ($c/5), '1', 2)}}</td>
				@else
				<td class="text-center">-</td>
				@endif
				
			</tr>
			@endforeach
		</table>
	</main>
	<div style="page-break-after:always;"></div>
@endforeach

@endforeach
</body>

</html>