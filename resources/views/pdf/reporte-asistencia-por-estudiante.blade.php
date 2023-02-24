<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>{{$nombreReporte}}</title>
</head>
<style>
	.table td,
	.table th {
		font-size: 8pt !important;
	}
</style>
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="20%">
				<div class="header__logo" style="text-align:left">
					<img 
						@if(DB::table('institution')->where('id', '1')->first()->logo == null)
							src="{{ secure_asset('img/logo/logo.png') }}"
						@else
							src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
						@endif 
					alt="" width="70">
				</div>
			</th>
			@php 
				dd($nombreReporte);
			@endphp
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3 class="up">
							{{$nombreReporte}}
					</h3>
					<h3 class="up">Año Lectivo: {{$institution->periodoActual->nombre}} </h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table m-0">
		<tr>
			<td class="no-border uppercase">Estudiante: {{$student->nombres}} {{$student->apellidos}}</td>
		</tr>
	</table>
	<table class="table m-0 uppercase">
			<tr>
				<td class="no-border">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </td>
				@if ($tutor != null)
					<td class="no-border text-right">TUTOR: {{$tutor->apellidos}} {{$tutor->nombres}} </td>
				@endif
			</tr>
	</table>
	<table class="table" style="width:50%">
		<tr>
			<td colspan="2" class="text-center uppercase">parcial {{substr($parcial,1,1)}} - quimestre {{substr($parcial,3,1)}}</td>
		</tr>
		<tr>
			<td class="tex-center">Atrasos:</td>
			<td>
				{{$parcial == 'p1q1' ? $student->p1q1A : ''}}
				{{$parcial == 'p2q1' ? $student->p2q1A : ''}}
				{{$parcial == 'p3q1' ? $student->p3q1A : ''}}
				{{$parcial == 'p1q2' ? $student->p1q2A : ''}}
				{{$parcial == 'p2q2' ? $student->p2q2A : ''}}
				{{$parcial == 'p3q2' ? $student->p3q2A : ''}}
			</td>
		</tr>
		<tr>
			<td class="tex-center">Faltas Justificadas:</td>
			<td>
				{{$parcial == 'p1q1' ? $student->p1q1FJ : ''}}
				{{$parcial == 'p2q1' ? $student->p2q1FJ : ''}}
				{{$parcial == 'p3q1' ? $student->p3q1FJ : ''}}
				{{$parcial == 'p1q2' ? $student->p1q2FJ : ''}}
				{{$parcial == 'p2q2' ? $student->p2q2FJ : ''}}
				{{$parcial == 'p3q2' ? $student->p3q2FJ : ''}}
			</td>
		</tr>
		<tr>
			<td class="tex-center">Faltas Injustificadas:</td>
			<td>
				{{$parcial == 'p1q1' ? $student->p1q1FI : ''}}
				{{$parcial == 'p2q1' ? $student->p2q1FI : ''}}
				{{$parcial == 'p3q1' ? $student->p3q1FI : ''}}
				{{$parcial == 'p1q2' ? $student->p1q2FI : ''}}
				{{$parcial == 'p2q2' ? $student->p2q2FI : ''}}
				{{$parcial == 'p3q2' ? $student->p3q2FI : ''}}
			</td>
		</tr>
		<tr>
			<td colspan="2" style="font-size:4pt !important;">NOTA: Son # de horas</td>
		</tr>
	</table>
</body>
</html>