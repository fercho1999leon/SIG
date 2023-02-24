<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte de comportamiento por parcial</title>
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
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3 class="up">
						Reporte de comportamiento parcial {{$parcial}}
					</h3>
					<h3 class="up">Año Lectivo: {{$periodo->nombre}} </h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="m-0 w100">
		<tr>
			<td style="font-size: 20 !important" class="no-border"> {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </td>
			@if ($tutor != null)
				<td style="font-size: 20 !important" class="no-border text-center">Tutor: {{$tutor->apellidos}} {{$tutor->nombres}} </td>
			@endif
		</tr>
	</table>
	<table class="table" style="width:75%">
		<tr>
			<td width="5">No.</td>
			<td class="uppercase">Nombre y apellidos</td>
			<td class="uppercase">Comportamiento {{$parcial}}</td>
		</tr>
		@foreach ($students as $student)
			<tr>
				<td class="text-center">{{$i++}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}}</td>
				<td class="text-center">
					@foreach ($comportamientos->where('idStudent', $student->id) as $comportamiento)
						{{$comportamiento->nota}}
					@endforeach
				</td>
			</tr>
		@endforeach
	</table>
</body>
</html>