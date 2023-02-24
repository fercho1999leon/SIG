<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte Estudiantes .R</title>
</head>
<style>
	.table td,
	.table th {
		font-size: 9pt !important;
	}
</style>
<body>
	<table class="table">
		<thead>
			<tr>
				<th colspan="3" style="vertical-align:top;" class="no-border">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">Año Lectivo: {{App\Institution::periodoLectivo()}}  </h3>
						<h3 class="up">
							Reporte Estudiantes y .R.
						</h3>
					</div>
				</th>
			</tr>
		</thead>
		<tr>
			<td class="text-center" width='5'>#</td>
			<td class="text-center bold" width="60%">APELLIDOS Y NOMBRES</td>
			<td class="text-center bold" width="40%">REPRESENTANTE</td>
		</tr>
		@foreach ($students as $student)
			<tr>
                @php
                    $representante = $representantes->where('id', $student->idRepresentante )->first();
                @endphp
				<td class="text-center">{{$loop->index+1}}</td>
				<td width="50%" class="uppercase">
					{{$student->apellidos}} {{$student->nombres}} - 
					@if ($student->course != null)
						{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}} 
					@endif
				</td>
				<td>
					@if ($representante != null)
						{{$representante->apellidos}} {{$representante->nombres}}
					@endif
				</td>
            </tr>
            
		@endforeach
	</table>
</body>
</html>