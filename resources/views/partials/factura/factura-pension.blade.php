@php
	use App\BecaDescuento;
	use App\Rubro;
@endphp
<div>
	<div class="row" style="visibility: hidden;">
		<br> <br>
		<div class="col-xs-6  facPension__institucion">
			<p class="text-left uppercase">{{ $institution->nombre}}</p>
			<p class="text-left uppercase">{{ $institution->responsable_factura }}</p>
			<p class="text-left uppercase">Dirección: {{ $institution->direccion }}</p>
			<p class="text-left">Telfs: {{ $institution->telefono }}</p>
		</div>
	</div> 
	<hr style="visibility: hidden">
	<div class="row facPension__border-bottom">
		<div class="col-xs-8  text-left">
			<p>CLIENTE:
				<span class="uppercase">{{ $factura->cliente->apellidos }} {{ $factura->cliente->nombres }}</span>
			</p>
		</div>
		<div class="col-xs-4  text-right">
			<p>Fecha: {{ $factura->created_at }}
		</div>
	</div>
</div>
<div class="row facPension__border-bottom">
	<div class="col-xs-8 ">
		<p>C.i/Ruc:
			<span class="uppercase"> {{ $factura->cliente->cedula_ruc }}</span>
		</p>
	</div>
	<div class="col-xs-4 text-right ">
			<p>Telefono: {{ $factura->cliente->telefono }}</p>
	</div>
</div>
<div class="row facPension__border-bottom">
	<div class="col-xs-10  ">
		<p>Dirección:
			<span class="uppercase"> {{ $factura->cliente->direccion }}</span>
		</p>
	</div>
</div>
<br>
<div class="row ">
	<div class="col-xs-6 ">
		<p>Estudiante:<br>
			<span class="uppercase"> {{ $student->apellidos }} {{ $student->nombres }} </span>
		</p>
	</div>
	<div class="col-xs-6 ">
		<p>Curso:<br>
			<span class="uppercase ">{{ $curso->grado }} {{ $curso->paralelo }}</span>
		</p>
	</div>
</div>
<br> <br>
<table class="table">
	<tr class="bgDark">
		<td colspan="2" class="text-center">Descripción</td>
		<td class="text-center">Valor</td>
	</tr>
	@foreach($factura->facturaDetalle as $fd)
		@php
			$pd = $pagos->where('id', $fd->idPagoDetalle)->first();
			$mes = '';
            switch($pd->pago->mes){
                case 1: $mes = "Enero"; break;
                case 2: $mes = "Febrero"; break;
                case 3: $mes = "Marzo"; break;
                case 4: $mes = "Abril"; break;
                case 5: $mes = "Mayo"; break;
                case 6: $mes = "Junio"; break;
                case 7: $mes = "Julio"; break;
                case 8: $mes = "Agosto"; break;
                case 9: $mes = "Septiembre"; break;
                case 10: $mes = "Octubre"; break;
                case 11: $mes = "Noviembre"; break;
                case 12: $mes = "Diciembre"; break;
            }
		@endphp
		@php
			$rubro = Rubro::find($pd->pago->idRubro);        
		@endphp
		@if ($pd->tipo == 'Matricula')
			<tr>
				<td colspan="2">
					<span class="uppercase">{{ $mes }} - {{ $rubro->tipo_rubro }}</span>
				</td>
				<td class="text-right">{{ $pd->pago->valor_autorizado }}</td>
			</tr>
			<tr>
				<td colspan="2">Descuento:
					<span class="uppercase">{{ $institution->descuentoInstitucional }}</span>
				</td>
				<td class="text-right">
					@php
						$descuento = $pd->pago->valor_autorizado - $pd->pago->valor_cancelar
					@endphp
					{{ $descuento }}
				</td>
			</tr>
		@endif
		<tr>
			<td colspan="2">
				<span class="uppercase"></span>
				<span class="uppercase">{{ $mes }} - {{ $rubro->tipo_rubro }}</span>
			</td>
			<td class="text-right">{{ $pd->pago->valor_cancelar }}</td>
		</tr>	
	@endforeach
	@if ($rubro->tipo_rubro == 'Pension')
		@foreach($student->student->becasDescuentos as $beca)
			@if (BecaDescuento::find($beca->idBeca)!=null)
				@php
					$b = BecaDescuento::find($beca->idBeca);
					$tipo = ($b->tipo == 'USD') ? '$' : '%';

					$total =  $pd->pago->valor_cancelar;
					$descuentoTotal = 0;
					if( strtoupper( $rubro->tipo_rubro ) == 'PENSION') {
						if(count($student->student->becasDescuentos) != 0) {
							$becaTotal = 0;
							foreach($student->student->becasDescuentos as $beca){
								$bd = BecaDescuento::find($beca->idBeca);
								if($bd->tipo == 'BECA'){
									if($bd->tipo_pago == "USD"){
										$becaTotal = $bd->valor;
									}else if($bd->tipo_pago == "PORCENTAJE"){
										$becaTotal = $total*($bd->valor/100);
									} 
								}
							}
							
							$descuentoTotal = $total - $becaTotal;
							$descuento = 0;
							foreach($student->student->becasDescuentos as $beca){
								$bd = BecaDescuento::find($beca->idBeca);
								if($bd->tipo == 'DESCUENTO'){
									if($bd->tipo_pago == "USD"){
										$descuento = $bd->valor;
									}else if($bd->tipo_pago == "PORCENTAJE"){
										$descuento = $descuentoTotal*($bd->valor/100);
									} 
								}
							}           
							$descuentoTotal = $descuentoTotal - $descuento ;
							$total = $descuentoTotal;                
						}
					}
				@endphp
				<tr>
					<td colspan="2">{{ $b->nombre }}</td>
					<td class="text-right">{{ $pd->pago->valor_cancelar - $descuentoTotal}}</td>
				</tr>
			@endif
		@endforeach
	@endif 	
	<tr>
		<td rowspan="2" width="70%">Forma de pago:
			<span class="uppercase">colecturía - {{ $rubro->tipo_rubro }} - us$ {{ $factura->subtotal }}</span>
		</td>
		<td class="text-right">Valor Tarjeta</td>
		<td class="text-right"></td>
	</tr>
	<tr>
		<td class="text-right">Sub Total</td>
		<td class="text-right">{{ $factura->total }}</td>
	</tr>
	<tr>
		<td>Usuario:
			<span class="uppercase">{{ $factura->user->apellidos }} {{ $factura->user->nombres }}</span>
		</td>
		<td class="text-right">0% IVA</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td class="text-right">Total</td>
		<td class="text-right">{{ $factura->total }}</td>
	</tr>
</table>
<div class="row">
	<div class="col-xs-12 text-center">
		<table class="facPension__table-formDePago w100">
			<tr>
				<td rowspan="2" class="text-center uppercase">Forma de pago</td>
				<td>Efectivo</td>
				<td width="20">{{ count($factura->tipoPago->where('tipo_pago', 'EFECTIVO') ) > 0 ? "X" : "" }}</td>
				<td>Tarjeta de credito</td>
				<td width="20">{{ count($factura->tipoPago->where('tipo_pago', 'TARJETA') ) > 0 ? "X" : "" }}</td>
			</tr>
			<tr>
				<td>Cheque</td>
				<td width="20">
						{{ count($factura->tipoPago->where('tipo_pago', 'CHEQUE') ) > 0 ? "X" : "" }}
				</td>
				<td>Otros</td>
				<td width="20"></td>
			</tr>
		</table>
	</div>
</div>
