<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Lista</title>
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
					<h3 class="up">Año Lectivo: {{App\Institution::periodoLectivo()}} </h3>
					<h3 class="up">
							{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} - Lista de estudiantes 
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table m-0">
		<tr>
			<td class="text-right no-border">
				Tutor: 
				@if ($course->tutor != null)
					{{$course->tutor->apellidos}} {{$course->tutor->nombres}}
				@endif 
			</td>
		</tr>
	</table>
	<table class="table whitespace-no">
		<tr>
			<td class="text-center">#</td>
			<td class="up" width="70%">Apellidos y Nombres</td>
			<td class="up" width="30%">correo</td>
		</tr>
		@foreach( $students as $student)
			<tr>
				<td class="text-center">{{ $loop->index+1 }}</td>
				<td width="50%" class="up">{{ $student->apellidos }} {{ $student->nombres }}</td>
				<td width="50%">{{ $student->student->profile->correo }}</td>
			</tr>
		@endforeach
	</table>
	<table class="table">
		<tr> 
			<td class="text-center">
				Estudiantes Masculinos: {{ $students->where('sexo', 'Masculino')->count() }}
			</td>
			<td class="text-center">
				Estudiantes Femeninos: {{ $students->where('sexo', 'Femenino')->count() }}
			</td>
		</tr>
	</table>
</body>
</html>