<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte de estudiantes con prorroga</title>
</head>
<style>
.table th,
.table td {
	font-size: 7pt !important;
}
</style>
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="20%">
				<div class="header__logo" style="text-align:left">
					<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3 class="up">Año Lectivo: {{App\PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo)}}  </h3>
					<h3 class="up">
						{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} - Reporte de estudiantes con prorroga
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table m-0">
		<tr>
			<td class="uppercase text-right no-border">
				{{App\Fechas::obtenerMes($mes)}} - {{ App\Rubro::findOrFail($tipoPago)->tipo_rubro}}
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="text-center" width="5">No.</td>
			<td class="text-center">Estudiante</td>
			<td class="text-center">Fecha de prorroga</td>
			<td class="text-center">VALOR</td>
		</tr>
		@foreach ($students2 as $student)
			@foreach ($prorrogas as $prorroga)
				@if ($prorroga->idEstudiante == $student->id)
					<tr>
						@php
							$mesActual = Carbon\Carbon::createFromDate($pago->anio, $pago->mes, $dia_pago)->daysInMonth;
							$fecha_pago = Carbon\Carbon::createFromDate($pago->anio, $pago->mes, $dia_pago)->addDays($prorroga->prorroga + $mesActual);
							$fecha_mes = $fecha_pago->month;
						@endphp
						<td class="text-center">{{$i++}}</td>
						<td>{{$student->apellidos}} {{$student->nombres}}
							@if ($student->becasDescuentos->isNotEmpty() && App\Rubro::findOrFail($pago->tipo)->tipo_rubro == 'Pension')
								*
							@endif
						</td>
						<td class="text-center">{{$fecha_pago->year}}-
							{{App\Fechas::obtenerMes($fecha_mes)}} -
							{{$fecha_pago->day}}
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
				@endif
			@endforeach
		@endforeach
		<tr>
			<td class="text-right" colspan="3">TOTAL</td>
			<td class="text-center">{{$total}}</td>
		</tr>
	</table>
</body>
</html>