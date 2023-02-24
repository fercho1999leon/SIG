<!DOCTYPE html>
<html lang="es">
@php
	use App\Rubro;
	use Carbon\Carbon;
@endphp
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Pagos por curso</title>
</head>
<body>
	@foreach ($course->pagos as $pago)
		@include('partials.encabezados.reporte-institucional', ['reportName' => 'Pagos por curso'])
			@php		
				$nombreMes = "";
				$mes = $pago->mes;
				switch($pago->mes){
					case 1:
						$nombreMes = 'ENERO';
					break;
					case 2:
						$nombreMes = 'FEBRERO';
					break;
					case 3:
						$nombreMes = 'MARZO';
					break;
					case 4:
						$nombreMes = 'ABRIL';
					break;
					case 5:
						$nombreMes = 'MAYO';
					break;
					case 6:
						$nombreMes = 'JUNIO';
					break;
					case 7:
						$nombreMes = 'JULIO';
					break;
					case 8:
						$nombreMes = 'AGOSTO';
					break;
					case 9:
						$nombreMes = 'SEPTIEMBRE';
					break;
					case 10:
						$nombreMes = 'OCTUBRE';
					break;
					case 11:
						$nombreMes = 'NOVIEMBRE';
					break;
					case 12:
						$nombreMes = 'DICIEMBRE';
					break;
				}
				$rubro = Rubro::find($pago->idRubro);        
			@endphp
			<table class="table m-0">
				<tr>
					<th class="text-left uppercase">{{ $course->grado }} {{ $course->especializacion }} {{ $course->paralelo }}</th>
					<th class="text-right uppercase"> {{ $nombreMes }} - {{ $rubro->tipo_rubro }} ({{$pago->descripcion}})</th>
					<th class="text-left uppercase">{{ $course->grado }} {{ $course->especializacion }} {{ $course->paralelo }}</th>
					<th class="text-right uppercase"> {{ $nombreMes }} - {{ $rubro->tipo_rubro }} ({{$pago->descripcion}})</th>
					<th class="text-left uppercase">{{ $course->grado }} {{ $course->especializacion }} {{ $course->paralelo }}</th>
					<th class="text-right uppercase"> {{ $nombreMes }} - {{ $rubro->tipo_rubro }} ({{$pago->descripcion}})</th>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td width="5">#</td>
					<td class="uppercase">Apellidos y nombres del estudiante</td>
					<td class="text-center">PAGADO</td>
					<td class="text-center">PENDIENTE</td>
					<td class="text-center">PRÓRROGA</td>
				</tr>
				@php				
					$fecha_pago = Carbon::createFromDate($pago->anio, $mes, $dia_pago)->format('Y-m-d');
					$cPendientes = 0;
					$cProrroga = 0;
					$cPagado = 0;
					$totalPagado = 0;
					$totalPendiente = 0;
					$totalProrroga = 0;
				@endphp
				@foreach($students as $student)
					@if($student->pagos->where('idPago', $pago->id)->first() != null)
						@php		
							$pagoEstudiante = $student->pagos->where('idPago', $pago->id)->first();
								if($pagoEstudiante->estado == 'PENDIENTE' )
									$cPendientes++;
								else if($pagoEstudiante->estado == 'PRORROGA' )
									$cProrroga++;
								else if($pagoEstudiante->estado == 'PAGADO' )
									$cPagado++;
						@endphp
						<tr>
							<td class="text-center">{{ $loop->iteration }}</td>
							<td class="uppercase">
								{{ $student->apellidos }} {{ $student->nombres }}
								@if ($student->becasDescuentos->isNotEmpty() && $pagoEstudiante->pago->tipo == 'Pension')
									*
								@endif
							</td>
							<td class="text-center">
								@if($pagoEstudiante->estado == 'PAGADO')
									@php
										$total = App\PagoEstudianteDetalle::descuento($pagoEstudiante);
										$totalPagado += $total;
									 @endphp
									{{$total}}
								@endif
							</td>
							<td class="text-center">
								@if($pagoEstudiante->estado == 'PENDIENTE')
									@php
										$pagoPendiente = App\PagoEstudianteDetalle::descuento($pagoEstudiante);
									@endphp
									@foreach ($pagoEstudiante->abonos as $abono)
										@php
											$pagoPendiente -= $abono->cantidad;
										@endphp
									@endforeach
									@php
										$totalPendiente += $pagoPendiente;
									@endphp
									{{$pagoPendiente}}
								@endif
							</td>
							<td class="text-center">
								@if($pagoEstudiante->estado == 'PRORROGA')
									@php
										$pagoProrroga = App\PagoEstudianteDetalle::descuento($pagoEstudiante);
									@endphp
									@foreach ($pagoEstudiante->abonos as $abono)
										@php
											$pagoProrroga -= $abono->cantidad;
										@endphp
									@endforeach
									@php
										$totalProrroga += $pagoProrroga;
									@endphp
									{{$pagoProrroga}}
								@endif
							</td>
						</tr>
					@endif
				@endforeach
				<tr>
					<td colspan="5" class="no-border">-</td>
				</tr>
				<tr>
					<td class="text-right" colspan="2">TOTAL</td>
					<td class="text-center">{{$totalPagado}}</td>
					<td class="text-center">{{$totalPendiente}}</td>
					<td class="text-center">{{$totalProrroga}}</td>
				</tr>
				<tr>
					<td colspan="5" class="no-border">-</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td class="text-center">Total pagados: {{ $cPagado }}</td>
					<td class="text-center">Total pendientes: {{ $cPendientes }}</td>
					<td class="text-center">Total con prorroga: {{ $cProrroga }}</td>
				</tr>
			</table>
			<div style="page-break-after:always;"></div>
		@endforeach
</body>
</html>