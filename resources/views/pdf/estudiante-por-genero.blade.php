<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Estudiante por Genero</title>
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
				<th colspan="3" style="vertical-align:top;" class="no-border">
					<div class="header__logo" style="text-align:left; ">
						<img 
							@if(DB::table('institution')->where('id', '1')->first()->logo == null)
								src="{{ secure_asset('img/logo/logo.png') }}" 
							@else 
								src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
							@endif 
						width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">Año Lectivo: {{App\Institution::periodoLectivo()}}</h3>
						<h3 class="up">
							estudiantes por genero
						</h3>
					</div>
				</th>
			</tr>
		</thead>
		<tr>
			<td colspan="3">FEMENINO</td>
		</tr>
		<tr>
			<td width="5" class="text-center">#</td>
			<td class="text-center bold" width="60%">APELLIDOS Y NOMBRES</td>
			<td class="text-center bold" width="40%">GRADO</td>
		</tr>
		@foreach ($students->where('sexo', 'Femenino') as $student)
			<tr>
			
				<td class="text-center">{{$loop->index+1}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}} </td>
				<td>
					@if ($student->course != null)
						{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}} 
					@endif
				</td>
			</tr>
		@endforeach
	</table>
	<div style="page-break-after:always;"></div>
	<table class="table">
		<thead>
			<tr>
				<th colspan="3" style="vertical-align:top;" class="no-border">
					<div class="header__logo" style="text-align:left">
						<img 
							@if(DB::table('institution')->where('id', '1')->first()->logo == null)
								src="{{ secure_asset('img/logo/logo.png') }}" 
							@else 
								src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
							@endif 
						width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						
						<h3 class="up">Año Lectivo: {{$institution->periodoLectivo}}  </h3>
						<h3 class="up">
							Lista de Estudiantes
						</h3>
					</div>
				</th>
			</tr>
		</thead>
		<tr>
			<td colspan="3">MASCULINO</td>
		</tr>
		<tr>
			<td width="5" class="text-center">#</td>
			<td width="50%">APELLIDOS Y NOMBRES</td>
			<td width="50%">GRADO</td>
		</tr>
		@foreach ($students->where('sexo', 'Masculino') as $student)
			<tr>
				<td class="text-center">{{$loop->index+1}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}} </td>
				<td>
					@if ($student->course != null)
						{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}} 
					@endif
				</td>
			</tr>
		@endforeach
	</table>
	
</body>
</html>