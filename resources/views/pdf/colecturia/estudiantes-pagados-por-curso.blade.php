<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte pagos pendientes</title>
</head>
<body>
	@include('partials.encabezados.reporte-institucional', ['reportName' => 'REPORTE DE PAGOS PENDIENTES POR CURSO'])
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
				<td class="uppercase text-center">Valor</td>
			</tr>
			@foreach($students as $student)
				<tr>
					<td class="text-center">{{ $loop->iteration }}</td>
					<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}
						@if ($student->becasDescuentos->isNotEmpty() && $pago->tipo == 'Pension')
							*
						@endif
					</td>
					<td class="text-center">
						@php
							$valor = $student->pagos()->where('idPago', $pago->id)->first();
							$pagoEstudiante = App\PagoEstudianteDetalle::descuento($valor);
							$total += $pagoEstudiante;
						@endphp
						{{$pagoEstudiante}}
					</td>
				</tr>
			@endforeach
			<tr>
				<td class="text-right" colspan="2">TOTAL</td>
				<td class="text-center">{{$total}}</td>
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