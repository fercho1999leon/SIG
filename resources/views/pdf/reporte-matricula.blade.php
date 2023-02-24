<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte Matricula</title>
</head>
<style>
.table td,
.table th {
	font-size: 6pt !important;
}
</style>
<body>
	@include('partials.encabezados.reporte-institucional', ['reportName' => 'Reporte Matricula'])
	<table class="table m-0">
		<tr>
			<th class="text-left"> {{$fechaA}} </th>
			<th class="text-right">
				{{$now->format('h:i:s A')}}
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="text-center bold">CURSO</td>
			<td class="text-center bold">ESPECIALIZACION</td>
			<td class="text-center bold">PARALELO</td>
			<td class="text-center bold">HOMBRES</td>
			<td class="text-center bold">MUJERES</td>
			<td class="text-center bold">SUMAN</td>
		</tr>
		@foreach ($courses->groupBy('seccion') as $key => $courses)
			<tr>
				<td colspan="6" class="text-center bold bgDark">
					{{$key == 'EI' ? 'EDUCACIÓN INICIAL' : ''}}
					{{$key == 'EGB' ? 'EDUCACIÓN GENERAL BÁSICA' : ''}}
					{{$key == 'BGU' ? 'BACHILLERATO GENERAL UNIFICADO' : ''}}
				</td>
			</tr>
			@foreach ($courses as $course)
				<tr>
					<td class="text-center"> {{$course->grado}} </td>
					<td class="text-center"> {{$course->especializacion}} </td>
					<td class="text-center">{{$course->paralelo}}</td>
					<td class="text-center">
						{{count($students->where('idCurso', $course->id)->where('retirado', 'NO' )->where('sexo', 'Masculino'))}}
						@php
							$totalHombresPorCurso = count($students->where('idCurso', $course->id)->where('retirado', 'NO' )->where('sexo', 'Masculino'));
						@endphp
					</td>
					<td class="text-center">
						{{count($students->where('idCurso', $course->id)->where('retirado', 'NO' )->where('sexo', 'Femenino'))}}
						@php
							$totalMujeresPorCurso = count($students->where('idCurso', $course->id)->where('retirado', 'NO' )->where('sexo', 'Femenino'));
						@endphp
					</td>
					<td class="text-center">
						{{$totalHombresPorCurso + $totalMujeresPorCurso}}
					</td>
				</tr>
			@endforeach
		@endforeach
		<tr>
			<td class="bgDark text-center" colspan="3">TOTAL</td>
			<td class="text-center">
				@php
					$totalHombres = count($students->where('retirado', 'NO' )->where('sexo', 'Masculino'))
				@endphp
				{{$totalHombres}}
			</td>
			<td class="text-center">
				@php
					$totalMujeres = count($students->where('retirado', 'NO' )->where('sexo', 'Femenino'))
				@endphp
				{{$totalMujeres}}
			</td>
			<td class="text-center">
				{{$totalHombres + $totalMujeres}}
			</td>
		</tr>
	</table>
</body>

</html>