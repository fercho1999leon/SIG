<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Formato Horario de Clases</title>
</head>
<style>
	.table { 
		td,
		th {
			font-size: 6pt !important;
		}
	}
</style>
<body>
	<table class="table">
		<tr>
			<th width="20%">
				<div class="header__logo" style="text-align: left">
					<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" @endif width="70" alt="" >
				</div>
			</th>
			<th width="60%" class="text-center">
				<h2 class="m-0 up"> {{ $institution->nombre }} </h2>
				<h2 class="m-0 up">año lectivo {{$periodo}}  </h2>
				<h2 class="m-0 up">Horario de clases</h2>
			</th>
			<th width="20%"></th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td width="35%" class="no-border"> 
				<table class="table">
					@foreach ($materias->take(10) as $materia)
						<tr>
							<td style="border-right:1px solid transparent;"> {{$materia->nombre}}</td>
							<td class="text-right" style="border-left:1px solid transparent;">
								@if ($materia->user != null)
                                    @if ($materia->user->profile != null)
                                        {{$materia->user->profile->nombres}} {{$materia->user->profile->apellidos}}
                                    @endif
                                @endif
							</td>
						</tr>
					@endforeach
				</table>
			</td>
			<td  width="30%" class="no-border"></td>
			<td width="35%" class="no-border"> 
				<table class="table">
					@foreach ($materias->slice(10) as $materia)
						<tr>
							<td style="border-right:1px solid transparent;"> {{$materia->nombre}}</td>
							<td class="text-right" style="border-left:1px solid transparent;">
								@if ($materia->user != null)
                                    @if ($materia->user->profile != null)
                                        {{$materia->user->profile->nombres}} {{$materia->user->profile->apellidos}}
                                    @endif
                                @endif
							</td>
						</tr>
					@endforeach
				</table>
			</td>
		</tr>
	</table>
	<table class="table">
		<tr class="bgDark">
			<td width="5" class="text-center">No.</td>
			<td class="text-center">Hora Inicio</td>
			<td class="text-center">Hora Fin</td>
			<td class="text-center">L</td>
			<td class="text-center">M</td>
			<td class="text-center">M</td>
			<td class="text-center">J</td>
			<td class="text-center">V</td>
		</tr>
		@foreach($horarios as $horario)
			<tr>
				<td class="text-center">{{$i += 1}}</td>
				<td class="text-center"> {{substr($horario->horaInicio, 0, 5)}}  </td>
				<td class="text-center"> {{substr($horario->horaFin, 0, 5)}}</td>
				<td>
				@foreach($materias as $materia)
					@if ($materia->id == $horario->dia1)
						{{$materia->nombre}}
					@endif
				@endforeach
				<td>
				@foreach($materias as $materia)
					@if ($materia->id == $horario->dia2)
						{{$materia->nombre}}
					@endif
				@endforeach
				</td>
				<td>
				@foreach($materias as $materia)
					@if ($materia->id == $horario->dia3)
						{{$materia->nombre}}
					@endif
				@endforeach
				</td>
				<td>
				@foreach($materias as $materia)
					@if ($materia->id == $horario->dia4)
						{{$materia->nombre}}
					@endif
				@endforeach
				</td>
				<td>
				@foreach($materias as $materia)
					@if ($materia->id == $horario->dia5)
						{{$materia->nombre}}
					@endif
				@endforeach
				</td>
			</tr>
		@endforeach
	</table>
	<table class="table">
		<tr>
			<td class="no-border">
				<h3>
					TUTOR: 
					@if ($tutor != null)
						{{$tutor->nombres}} {{$tutor->apellidos}}
					@endif
				</h3>
			</td>
			<td class="no-border text-right">
				<h3 class="up m-0">
					CURSO: {{$curso->grado}} {{$curso->paralelo}}
				</h3>
			</td>
		</tr>
	</table>
	
</body>
</html>