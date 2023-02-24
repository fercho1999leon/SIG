<!DOCTYPE html>
<html lang="es">
@php
	use App\Student2;
	use App\Payment;
	use App\FacturaDetalle;
	use App\PagoEstudianteDetalle;
	use App\Fechas;
	use App\Factura;
	use App\Rubro;
@endphp
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte de cobros</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
		<table class="table">
			<thead>
				<tr>
					<th class="no-border" colspan="11">
						<div class="header__info text-center">
							<h3>{{ $institution->nombre }}</h3>
							<h3 class="up">Año Lectivo: {{$periodo->nombre}} </h3>
							<h3 class="up">
								cobros en colecturia
							</h3>
						</div>
					</th>
				</tr>
			</thead>
			<tr>
				<td class="no-border" colspan="7" style="font-size: 9px">
					<p>Usuario: {{ $user->apellidos}} {{ $user->nombres }}</p>
					<p>
						@if ($desde === $hasta)
							Fecha de apertura: {{$desde}}
						@else
							Desde: {{$desde}} hasta: {{$hasta}}
						@endif
					</p>
				</td>
				<td class="no-border" colspan="4" style="font-size: 9px;text-align: right">
					<p>Fecha de impresión: {{Carbon\Carbon::now()}}</p>
				</td>
			</tr>
			<tr class="uppercase" height="40">
				<td rowspan="2" class="text-center">Alumno</td>
				<td rowspan="2" class="text-center">Curso</td>
				<td rowspan="2" class="text-center">Rubro</td>
				<td rowspan="2" class="text-center">Numero de Documento</td>
				<td rowspan="2" class="text-center">Valor Doc.</td>
				<td class="text-center" colspan="4">Formas de Cobro</td>
				<td rowspan="2" class="text-center">Total Cobrado</td>
				<td rowspan="2" class="text-center">Saldo Actual</td>
			</tr>
			<tr class="uppercase">
				<td class="text-center">Efectivo</td>
				<td class="text-center">Cheque Post Fechado</td>
				<td class="text-center">Deposito/Transferencia</td>
				<td class="text-center">Tarjeta</td>
			</tr>
			<tr>
				<td colspan="11">FACTURA</td>
			</tr>

			<!-- Variables de valores a contar-->
			@php
				$valorDocumento_F = 0;
				$valorEfectivo_F = 0;
				$valorCheque_F = 0;
				$valorDeposito_F = 0;
				$valorTarjeta_F = 0;
				$totalCobradoFactura = 0;
				$saldoActualFactura = 0;

				$sumaValorDocumento_F = 0;
				$sumaValorEfectivo_F = 0;
				$sumaValorCheque_F = 0;
				$sumaValorDeposito_F = 0;
				$sumaValorTarjeta_F = 0;
				$sumaTotalCobradoFactura = 0;
				$sumaSaldoActualFactura = 0;


				$valorDocumento_R = 0;
				$valorEfectivo_R = 0;
				$valorCheque_R = 0;
				$valorDeposito_R = 0;
				$valorTarjeta_R = 0;
				$totalCobrado_R = 0;
				$saldoActual_R = 0;

				$sumaValorDocumento_R = 0;
				$sumaValorEfectivo_R = 0;
				$sumaValorCheque_R = 0;
				$sumaValorDeposito_R = 0;
				$sumaValorTarjeta_R = 0;
				$sumaTotalCobradoRecibo = 0;
				$sumaSaldoActualRecibo = 0;
			@endphp
		
			@foreach($facturas->groupBy('idFactura') as $key => $item)						
				<!-- Se reestablece los valores a 0 de pagos en EFECTIVO, CHEQUE, DEPOSITO Y TARJETA -->
				@php
					$valorDocumento_F = 0;
					$valorEfectivo_F = 0;
					$valorCheque_F = 0;
					$valorDeposito_F = 0;
					$valorTarjeta_F = 0;
					$totalCobradoFactura = 0;
					$saldoActualFactura = 0;
				@endphp
				@if(strtoupper($item->first()->tipo_emision) =='FACTURA')
				<tr>
					<td class="uppercase"> {{ $item->first()->nombres }} {{ $item->first()->apellidos }}
						
						@if($item->first()->estatus=='BAJA')
							***
						@endif
					</td>
					<td>{{ $item->first()->grado }} {{ $item->first()->especializacion }} {{ $item->first()->paralelo }}</td>
					<td class="text-center">
						@foreach ($item as $data)
						@php
							$r =  Rubro::find($data->idRubro);
							if($r!=null)
								$r = $r->tipo_rubro;
						@endphp							
							{{ $r }} {{ Fechas::getMes($data->mes) }} ,
						@endforeach
					</td>
					<td class="text-center">
					{{-- @foreach ($item as $data) --}}
						{{ $data->numeroFactura }} 
					{{-- @endforeach							 --}}
					</td>
					<td class="text-center">
						@php						
							$valorDocumento_F += $item->first()->subtotal;
							$sumaValorDocumento_F += $valorDocumento_F;											
						@endphp
						{{ $valorDocumento_F }}
					</td>
					<td class="text-center">
						<!-- Valor si el pago es en EFECTIVO -->
                        @php
						if($item->first()->tipo_pago == "EFECTIVO" || $item->first()->tipo_pago == null) {
							if($item->count() > 1)
								$valorEfectivo_F += $data->total;
							else
								$valorEfectivo_F += $data->total;																
						}
									
						$sumaValorEfectivo_F += $valorEfectivo_F;
						@endphp
						{{ $valorEfectivo_F == 0 ? '-' : $valorEfectivo_F }}
					</td>
					<td class="text-center">
						<!-- Valor si el pago es en CHEQUE -->
						@php
						foreach ($item as $key => $data) {
							if($data->tipo_pago == "CHEQUE") {
                                if($item->count() > 1)
									$valorCheque_F = $data->total;
								else
									$valorCheque_F += $data->total;
								
							}
						}
						$sumaValorCheque_F += $valorCheque_F;
						@endphp
						{{ $valorCheque_F == 0 ? '-' : $valorCheque_F }}
					</td>
					<td class="text-center">
						<!-- Valor si el pago es en DEPOSITO -->
						@php
						foreach ($item as $key => $data) {
							if($data->tipo_pago == "DEPOSITO") {
								if($item->count() > 1)
									$valorDeposito_F = $data->total;
								else
									$valorDeposito_F += $data->total;
								
							}
						}							
						$sumaValorDeposito_F += $valorDeposito_F;
						@endphp
						{{ $valorDeposito_F == 0 ? '-' : $valorDeposito_F }}
					</td>
					<td class="text-center">
						<!-- Valor si el pago es en TARJETA -->
						@php
						foreach ($item as $key => $data) {
							if($data->tipo_pago == "TARJETA" || $data->tipo_pago == "TARJETACREDITO" || $data->tipo_pago == "TARJETADEBITO") {
								if($item->count() > 1)
									$valorTarjeta_F = $data->total;
								else
									$valorTarjeta_F += $data->total;								
							}
						}
						$sumaValorTarjeta_F += $valorTarjeta_F;
						@endphp
						{{ $valorTarjeta_F == 0 ? '-' : $valorTarjeta_F }}
					</td>
					<td class="text-center">
						@php
							$totalCobradoFactura = $valorEfectivo_F + $valorCheque_F  + $valorDeposito_F  + $valorTarjeta_F;
							$sumaTotalCobradoFactura=$sumaTotalCobradoFactura+$totalCobradoFactura;
						@endphp
						{{ $totalCobradoFactura }}
					</td>
					<td class="text-center">
						<!-- Valor del saldo a cancelar -->
						@php
							$saldoActualFactura = bcsub( $valorDocumento_F,$totalCobradoFactura);
							$sumaSaldoActualFactura = $sumaSaldoActualFactura+$saldoActualFactura;
						@endphp
						{{ $saldoActualFactura!= 0 ? $saldoActualFactura : "-" }}
					</td>
				</tr>
				@endif
			@endforeach
			<tr>
				<td colspan="3" class="text-right">Suman Factura ===> </td>
				<td class="text-center">=======></td>
				<td class="text-center">
					{{ $sumaValorDocumento_F != 0 ? $sumaValorDocumento_F : "-"}}
				</td>
				<td class="text-center">
					{{ $sumaValorEfectivo_F != 0 ? $sumaValorEfectivo_F : " "}}
				</td>
				<td class="text-center">
					{{ $sumaValorCheque_F != 0 ? $sumaValorCheque_F : " "}}
				</td>
				<td class="text-center">
					{{ $sumaValorDeposito_F != 0 ? $sumaValorDeposito_F : " "}}
				</td>
				<td class="text-center">
					{{ $sumaValorTarjeta_F != 0 ? $sumaValorTarjeta_F : " "}}
				</td>
				<td class="text-center">
					{{ $sumaTotalCobradoFactura }}
				</td>
				<td class="text-center">
					{{ $sumaSaldoActualFactura != 0 ? $sumaSaldoActualFactura : "-"}}
				</td>
			</tr>
			<tr>
				<td colspan="11">RECIBO DE CAJA</td>
			</tr>
			@foreach ($abonos->groupBy('idFactura') as $key => $abono)
				
				<!-- Se reestablece los valores a 0 de pagos en EFECTIVO, CHEQUE, DEPOSITO Y TARJETA -->
				@php
					$valorDocumento_R = 0;
					$valorEfectivo_R = 0;
					$valorCheque_R = 0;
					$valorDeposito_R = 0;
					$valorTarjeta_R = 0;
					$totalCobradoFactura = 0;
					$saldoActualFactura = 0;
				@endphp
				<tr>
					<td class="uppercase"> {{ $abono->first()->nombres }} {{ $abono->first()->apellidos }}</td>
					<td>{{ $abono->first()->grado }} {{ $abono->first()->especializacion }} {{ $abono->first()->paralelo }}</td>
					<td class="text-center">
						@foreach ($abono as $item)
						@php
							$r =  Rubro::find($item->idRubro);
							if($r!=null)
								$r = $r->tipo_rubro;
						@endphp
							{{ $r }} {{ Fechas::getMes($item->mes) }},
						@endforeach
					</td>
					<td class="text-center">	
						@foreach ($abono as $item)
							{{ $item->id }},
						@endforeach
					</td>
					<td class="text-center">
							@php
								$valorDocumento_R += $abono->first()->subtotal;
								$sumaValorDocumento_R += $valorDocumento_R;															
							@endphp
							{{ $valorDocumento_R }}
						</td>
						<td class="text-center">
							<!-- Valor si el pago es en EFECTIVO -->
							@php
							foreach ($abono as $key => $data) {
								if($data->tipo_recibo == "EFECTIVO") {
									if($abono->count() > 1)
										$valorEfectivo_R += $data->cantidad;
									else
										$valorEfectivo_R += $data->cantidad;
									
								}
							}
							$sumaValorEfectivo_R += $valorEfectivo_R;
							@endphp
							{{ $valorEfectivo_R == 0 ? '-' : $valorEfectivo_R }}
						</td>
						<td class="text-center">
							<!-- Valor si el pago es en CHEQUE -->
							@php
							foreach ($abono as $key => $data) {
								if($data->tipo_recibo == "CHEQUE") {
									if($abono->count() > 1)
										$valorCheque_R += $data->cantidad;
									else
										$valorCheque_R += $data->cantidad;
								}
							}
							$sumaValorCheque_R += $valorCheque_R;
							@endphp
							{{ $valorCheque_R == 0 ? '-' : $valorCheque_R }}
						</td>
						<td class="text-center">
							<!-- Valor si el pago es en DEPOSITO -->
							@php
							foreach ($abono as $key => $data) {
								if($data->tipo_recibo == "DEPOSITO") {
									if($abono->count() > 1)
										$valorDeposito_R += $data->cantidad;	
									else
										$valorDeposito_R += $data->cantidad;
								}
							}
							$sumaValorDeposito_R += $valorDeposito_R;
							@endphp
							{{ $valorDeposito_R == 0 ? '-' : $valorDeposito_R }}
						</td>
						<td class="text-center">
							<!-- Valor si el pago es en TARJETA -->
							@php
							foreach ($abono as $key => $data) {
								if($data->tipo_recibo == "TARJETA" || $data->tipo_recibo == "TARJETACREDITO" || $data->tipo_recibo == "TARJETADEBITO") {
									if($abono->count() > 1)
										$valorTarjeta_R += $data->cantidad;
									else
										$valorTarjeta_R += $data->cantidad;
								}
							}
							$sumaValorTarjeta_R += $valorTarjeta_R;
							@endphp
							{{ $valorTarjeta_R == 0 ? '-' : $valorTarjeta_R }}
						</td>
					<td class="text-center">
						@php
							$totalCobrado_R = $valorEfectivo_R + $valorCheque_R + $valorDeposito_R + $valorTarjeta_R;
							$sumaTotalCobradoRecibo = $sumaTotalCobradoRecibo + $totalCobrado_R;
						@endphp
						{{ $totalCobrado_R == 0 ? '-' : $totalCobrado_R }}
					</td>
					<td class="text-center">
						@php
							$saldoActual_R = $valorDocumento_R - $totalCobrado_R;
							$sumaSaldoActualRecibo = $sumaSaldoActualRecibo + $saldoActual_R;
						@endphp
						{{ $saldoActual_R == 0 ? '-' : $saldoActual_R}}
					</td>
				</tr>
			@endforeach
			<tr>
				
				<td colspan="3" class="text-right">Suman Recibo de Caja ===> </td>
				<td class="text-center">=======></td>
				<td class="text-center">
					{{--
						{{ $p->sum('valor_cancelar') }}
					--}}

					{{ $sumaValorDocumento_R == 0 ? '-' : $sumaValorDocumento_R}}
				</td>
				<td class="text-center">
					{{--
						{{$totAb}}
					--}}

					{{ $sumaValorEfectivo_R == 0 ? '-' : $sumaValorEfectivo_R}}
				</td>
				<td class="text-center">
					{{ $sumaValorCheque_R == 0 ? '-' : $sumaValorCheque_R}}
				</td>
				<td class="text-center">
					{{ $sumaValorDeposito_R == 0 ? '-' : $sumaValorDeposito_R}}
				</td>
				<td class="text-center">
					{{ $sumaValorTarjeta_R == 0 ? '-' : $sumaValorTarjeta_R}}
				</td>
				<td class="text-center">
					{{--
						{{$totAb}}
					--}}

					{{ $sumaTotalCobradoRecibo == 0 ? '-' : $sumaTotalCobradoRecibo}}
				</td>
				<td class="text-center">
					{{--
						{{ $p->sum('valor_cancelar') -$totAb }}
					--}}

					{{ $sumaSaldoActualRecibo }}
				</td>
			</tr>

			<tr>
				<td colspan="3" class="text-right">Totales por usuario ===> </td>
				<td class="text-center">=======></td>
				<td class="text-center">
					{{--
						{{ $pagos->sum('pago.valor_cancelar') + $p->sum('valor_cancelar') }}
					--}}

					{{ ($sumaValorDocumento_F+$sumaValorDocumento_R) == 0 ? '-' : $sumaValorDocumento_F+$sumaValorDocumento_R}}
				</td>
				<td class="text-center">
					{{--
						{{ $pagos->sum('pago.valor_cancelar') +$totAb }}
					--}}

					{{ ($sumaValorEfectivo_F+$sumaValorEfectivo_R) == 0 ? '-' : $sumaValorEfectivo_F+$sumaValorEfectivo_R}}
				</td>
				<td class="text-center">
					{{ ($sumaValorCheque_F+$sumaValorCheque_R) == 0 ? '-' : $sumaValorCheque_F+$sumaValorCheque_R}}
				</td>
				<td class="text-center">
					{{ $sumaValorDeposito_F+$valorDeposito_R == 0 ? '-' : $sumaValorDeposito_F+$valorDeposito_R}}
				</td>
				<td class="text-center">
					{{ $sumaValorTarjeta_F+$sumaValorTarjeta_R == 0 ? '-' : $sumaValorTarjeta_F+$sumaValorTarjeta_R}}
				</td>
				<td class="text-center">
					{{--
						{{ $pagos->sum('pago.valor_cancelar') +$totAb }}
					--}}

					{{ $sumaTotalCobradoFactura+$sumaTotalCobradoRecibo }}
				</td>
				<td class="text-center">
					{{--
						{{ $pagos->sum('pago.valor_cancelar') + ($p->sum('valor_cancelar') -$totAb) }}
					--}}

					{{ $sumaSaldoActualFactura+$sumaSaldoActualRecibo == 0 ? '-' : $sumaSaldoActualFactura+$sumaSaldoActualRecibo}}
				</td>
			</tr>
		</table>
		<br>
	</main>
	{{-- <div style="page-break-after:always;"></div> --}}
</body>

</html>