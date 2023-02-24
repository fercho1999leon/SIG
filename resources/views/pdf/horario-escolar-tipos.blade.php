<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Horario Escolar</title>
</head>
<body>
	<table class="table">
		<tr>
			<th width="20%">
				<div class="header__logo" style="text-align: left">
					<img 
						@if(DB::table('institution')->where('id', '1')->first()->logo == null) 
							src="{{ secure_asset('img/logo/logo.png') }}" 
						@else 
							src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" 
						@endif 
						width="70" 
					alt="" >
				</div>
			</th>
			<th width="60%" class="text-center">
				<h2 class="m-0 up"> {{ $institution->nombre }} </h2>
				<h2 class="m-0 up">año lectivo {{$periodo}}  </h2>
				<h2 class="m-0 up">Horario tipo {{$parcial}} </h2>
			</th>
			<th width="20%"></th>
		</tr>
	</table>
	<table class="table">
		<tr class="bgDark">
			<td width="5" class="text-center">No.</td>
			<td class="text-center">Hora Inicio</td>
			<td class="text-center">Hora Fin</td>
			<td class="text-center">LUNES</td>
			<td class="text-center">MARTES</td>
			<td class="text-center">MIERCOLES</td>
			<td class="text-center">JUEVES</td>
			<td class="text-center">VIERNES</td>
		</tr>
		@php
			$diaLunes = [];
			$diaMartes = [];
			$diaMiercoles = [];
			$diaJueves = [];
			$diaViernes = [];
		@endphp
		@foreach($horarios as $horario)
			<tr>
				<td class="text-center"> {{$count++}} </td>
				<td class="text-center"> {{substr($horario->horaInicio, 0, 5)}}  </td>
				<td class="text-center"> {{substr($horario->horaFin, 0, 5)}}</td>
				<td>
					@foreach($materias->where('id', $horario->dia1) as $key => $materia)
						{{$materia->nombre}}
						@php
							array_push($diaLunes, $materia->id)
						@endphp
					@endforeach
				<td>
					@foreach($materias->where('id', $horario->dia2) as $materia)
						{{$materia->nombre}}
						@php
							array_push($diaMartes, $materia->id)
						@endphp
					@endforeach				
				</td>
				<td>
					@foreach($materias->where('id', $horario->dia3) as $materia)
						{{$materia->nombre}}
						@php
							array_push($diaMiercoles, $materia->id)
						@endphp
					@endforeach				
				</td>
				<td>
					@foreach($materias->where('id', $horario->dia4) as $materia)
						{{$materia->nombre}}
						@php
							array_push($diaJueves, $materia->id)
						@endphp
					@endforeach				
				</td>
				<td>
					@foreach($materias->where('id', $horario->dia5) as $materia)
						{{$materia->nombre}}
						@php
							array_push($diaViernes, $materia->id)
						@endphp
					@endforeach	
				</td>
			</tr>
		@endforeach
	</table>
	@php
		$materiasHorario = array_merge($diaLunes, $diaMartes, $diaMiercoles, $diaJueves, $diaViernes);
		$cantidadMaterias = count($materias->whereIn('id', $materiasHorario));
		$numeroDeMaterias = round($cantidadMaterias/2);
	@endphp
	
	<table class="table">
		<tr>
			<td width="35%" class="no-border"> 
				<table class="table">
					@foreach ($materias->whereIn('id', $materiasHorario)->take($numeroDeMaterias) as $materia)
						<tr>
							<td style="border-right:1px solid transparent;"> {{$materia->nombre}}</td>
							<td class="text-left" style="border-left:1px solid transparent;">
								@foreach ($docentes->where('id', $materia->idDocente) as $docente)
									{{$docente->nombres}} {{$docente->apellidos}}
								@endforeach
							</td>
						</tr>
					@endforeach
				</table>
			</td>
			<td  width="30%" class="no-border"></td>
			<td width="35%" class="no-border"> 
				<table class="table">
					@foreach ($materias->whereIn('id', $materiasHorario)->slice($numeroDeMaterias) as $materia)
						<tr>
							<td style="border-right:1px solid transparent;"> {{$materia->nombre}}</td>
							<td class="text-left" style="border-left:1px solid transparent;">
								@foreach ($docentes->where('id', $materia->idDocente) as $docente)
									{{$docente->nombres}} {{$docente->apellidos}}
								@endforeach
							</td>
						</tr>
					@endforeach
				</table>
			</td>
		</tr>
	</table>
</body>
</html>