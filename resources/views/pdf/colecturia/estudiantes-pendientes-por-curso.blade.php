<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Estudiante pendientes prorroga</title>
</head>

<body>
	@include('partials.encabezados.reporte-institucional', ['reportName' => 'REPORTE DE ESTUDIANTES PENDIENTES POR CURSO'])
	<table class="table m-0">
		<tr>
			<th class="text-left uppercase">{{ $course->grado }} {{ $course->especializacion }} {{ $course->paralelo }}</th>
			<th class="text-right uppercase"> {{ $nombreMes }} - {{$tipoPago}}</th>
		</tr>
	</table>
	
	<table class="table">
		<tr>
			<td width="5">#</td>
			<td class="uppercase">Apellidos y nombres del estudiante</td>
		</tr>
		@php
			$cPendientes = 0;
			$cProrroga = 0;
		@endphp
			
		@foreach($students as $student)
			@php					
				if(count($student->pagos)>0){
					if($student->pagos->where('idPago', $pago->id)->first()->estado == 'PENDIENTE' )
						$cPendientes++;
					if($student->pagos->where('idPago', $pago->id)->first()->estado == 'PRORROGA' )
						$cProrroga++;
				}
			@endphp
			@if(count($student->pagos)>0)
				@if( $student->pagos->where('idPago', $pago->id)->first()->estado == 'PENDIENTE' )
				<tr>
					<td class="text-center">{{ $cPendientes }}</td>
					<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
				</tr>
				@endif
			@endif
		@endforeach
			
		<tr>
			<td class="no-border" colspan="2"></td>
		</tr>
	</table>
	
	<table class="table">
		<tr>
			<td class="text-center">Estudiantes: {{ count($students) }}</td>
			<td class="text-center">Pendientes: {{ $cPendientes }}</td>
			<td class="text-center">Prórroga: {{ $cProrroga }}</td>
		</tr>
	</table>

</body>
</html>