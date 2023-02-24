@php
	use App\Fechas;
	use App\TipoPago;
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Deudores por curso de pensión</title>
</head>

<body>
	<table class="table">
		<thead>
			<tr>
				<th colspan="9" style="vertical-align:top;" class="no-border" width="20%">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">Año Lectivo: {{$periodoLectivo->nombre}}  </h3>
						<h3 class="up">
							Deudores por curso de pensión
						</h3>
					</div>
				</th>
			</tr>
		</thead>
		<tr>
			<td colspan="3" class="no-border">Desde: {{ Fechas::getMes($fDesde)  }}</td>
			<td colspan="5" class="no-border" >Hasta: {{ Fechas::getMes($fHasta) }}</td>
		</tr>
		<tr>
			<td class="no-border" colspan="2">Fecha: 26 de marzo</td>
		</tr>
		<tr>
			<td width="1%"></td>
			<td class="text-center">Alumno</td>
			<td class="text-center">Rubros Deuda</td>
			<td class="text-center">Valor Total</td>
			<td class="text-center">Pagos</td>
			<td class="text-center">Deuda Rubros</td>
			<td class="text-center">Deuda Saldos</td>
			<td class="text-center">Deuda Total</td>
			<td class="text-center">Estado</td>
		</tr>
		@php
			$TsumValorTotal = 0;
			$TsumPagos = 0;
			$TsumDeudaRubros = 0;
			$TsumDeudaSaldos = 0;
			$TsumDeudaTotal = 0;
			$c = 1;
		@endphp
		@foreach ($facturas->groupBy('grado') as $key => $grado)
            @foreach ($grado->groupBy('especializacion') as $spec)
                @foreach ($spec->groupBy('paralelo') as $p => $paralelo)
                    @php
                        $specialitation = $paralelo->where('especializacion', '!=', null)->first();
                        $sumValorTotal = 0;
                        $sumPagos = 0;
                        $sumDeudaRubros = 0;
                        $sumDeudaSaldos = 0;
                        $sumDeudaTotal = 0;
                    @endphp
                    <tr>
                        <td></td>
                        <td colspan="9">Curso: {{ $paralelo->first()->grado }} {{ ( ($specialitation != null) ? $specialitation->especializacion : "" ) }} {{ $p }}</td>
                    </tr>
                    @foreach ($paralelo->groupBy('idEstudiante') as $x => $item)
                        <tr>
                            <td class="text-center">{{ $c }}</td>
                            <td> {{ $item->first()->apellidos }} {{ $item->first()->nombres }}</td>
                            <td>	
                                @foreach ($item as $data)	
                                    {{ $data->tipo_rubro }} {{ Fechas::getMes($data->mes) }} 
                                @endforeach
                            </td>
                            @php
                            $c++;
                            $beca = $becas->where('idEstudiante', $item->first()->idEstudiante);
                            $totalCancelar = 0;
                            $abono = 0;
                            foreach ($item as $key => $data) {
                                $valor = bcdiv( $data->valor_cancelar,1,2 );
                                if(count($beca) > 0 && strtoupper($data->tipo_rubro) == 'PENSION'){
                                    foreach ($beca->where('tipo_beca', 'BECA') as $key => $b) {
                                        if($b->tipo_pago_beca == "USD") {
                                            $valor = ($valor) - strval($b->valor_beca);
                                        }
                                        if($b->tipo_pago_beca == "PORCENTAJE") {
                                            $valor = $valor - bcdiv(($valor* bcdiv(($b->valor_beca/100),1,2)),1,2);
                                            
                                        }
                                    }
                                    foreach ($beca->where('tipo_beca', 'DESCUENTO') as $key => $b) {
                                        if($b->tipo_pago_beca == "USD") {
                                            $valor = $valor - $b->valor_beca;
                                        }
                                        if($b->tipo_pago_beca == "PORCENTAJE") {
                                            $valor = $valor - bcdiv( ($valor* bcdiv( ($b->valor_beca/100),1,2 )),1,2 );
                                        }
                                    }
                                }
                                $totalCancelar += $valor;
                            }
                            if (count($item) > 1) {
                                foreach ($item as $key => $pagoDetalle) {
                                    $abono += $abonos->where('idPagoDetalle', $pagoDetalle->idPagoDetalle)->sum('cantidad');
                                }
                            }
                            $abono = $abonos->where('idPagoDetalle', $item->first()->idPagoDetalle)->sum('cantidad');
                            
                            $deudaSaldos = ($abono == 0) ? 0 : $totalCancelar - $abono;
                            $valorFinal = $deudaSaldos == 0 ? $totalCancelar : $deudaSaldos;

                            $sumValorTotal += $totalCancelar;
                            $sumPagos += $abono;
                            $sumDeudaRubros += ($abono == 0) ? $totalCancelar : 0;
                            $sumDeudaSaldos += $deudaSaldos;
                            $sumDeudaTotal += $valorFinal;
                            @endphp
                            <td class="text-center">{{ bcdiv($totalCancelar,1,2) }}</td>
                            <td class="text-center">
                            {{	$abono }}
                            </td>
                            <td class="text-center">
                                {{ $abono == 0 ? bcdiv($totalCancelar,1,2) : '' }}
                            </td>
                            <td>
                                {{ $abono == 0 ? '' : bcdiv(($totalCancelar - $abono),1,2)  }}
                            </td>
                            <td class="text-center">
                                {{ bcdiv($valorFinal,1,2) }}
                            </td>
                            <td>
                                {{ count($item->where('estado', 'PRORROGA')) != 0 ? 'PRORROGA' : '' }}
                            </td>
                        </tr>
                    @endforeach
                    @php
                        $TsumValorTotal += $sumValorTotal;
                        $TsumPagos += $sumPagos;
                        $TsumDeudaRubros += $sumDeudaRubros;
                        $TsumDeudaSaldos += $sumDeudaSaldos;
                        $TsumDeudaTotal += $sumDeudaTotal;
                    @endphp
                    <tr>
                            <td></td>
                            <td colspan="2" class="text-right">Suman</td>
                            <td class="text-center">{{ 	bcdiv($sumValorTotal,1,2) }}</td>
                            <td class="text-center">{{ bcdiv($sumPagos,1,2) }}</td>
                            <td class="text-center">{{ bcdiv($sumDeudaRubros,1,2) }}</td>
                            <td class="text-center">{{ bcdiv($sumDeudaSaldos,1,2) }}</td>
                            <td class="text-center">{{ bcdiv($sumDeudaTotal,1,2) }}</td>
                            <td></td>
                        </tr>
                @endforeach
		    @endforeach
        @endforeach
		<tr>
			<td></td>
			<td colspan="2" class="text-right">Total</td>
			<td class="text-center">{{ $TsumValorTotal }}</td>
			<td class="text-center">{{ $TsumPagos }}</td>
			<td class="text-center">{{ $TsumDeudaRubros }}</td>
			<td class="text-center">{{ $TsumDeudaSaldos }}</td>
			<td class="text-center">{{ $TsumDeudaTotal }}</td>
			<td></td>
		</tr>
	</table>
</body>
</html>