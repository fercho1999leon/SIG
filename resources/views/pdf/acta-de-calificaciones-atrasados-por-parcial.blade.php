@php
		use App\Course;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Acta de calificaciones</title>
</head>
<style>
	.table td,
	.table th {
		font-size: 8pt !important;
	}
</style>
<body>
	<table class="table">
		<thead>
			<tr>
				<th colspan="3" style="vertical-align:top;" class="no-border" width="20%">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">
							Acta de calificaciones del primer parcial del primer quimestre año lectivo 2019 - 2020
						</h3>
					</div>
				</th>
			</tr>
		</thead>
	</table>
	@foreach ($data as $item)
	@php
	@endphp
	
			<table class="table">
				<tr>
				<td class="no-border"></td>
					<td class="no-border text-right">fecha: -</td>
				</tr>
				<tr>
				<td class="no-border">asignatura: </td>
					<td class="no-border text-right">profesor: ---</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td class="text-center">#</td>
					<td class="text-center uppercase">nombre</td>
					<td class="text-center uppercase">tareas</td>
					<td class="text-center uppercase">act. grupal</td>
					<td class="text-center uppercase">act. individual</td>
					<td class="text-center uppercase">lección</td>
					<td class="text-center uppercase">Evaluación</td>
					<td class="text-center uppercase">Nota Parcial</td>
				</tr>
				<tr>
					<td class="text-center">1</td>
					<td>nombre alumno</td>
					<td class="text-center">0.00</td>
					<td class="text-center">0.00</td>
					<td class="text-center">0.00</td>
					<td class="text-center">0.00</td>
					<td class="text-center">0.00</td>
					<td class="text-center">0.00</td>
				</tr>
			</table>				
	
	@endforeach
</body>
</html>