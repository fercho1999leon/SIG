@php
	use App\Rubro;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Aviso de Vencimiento</title>
</head>
<style>
.table td,
.table th { 
	font-size: 7pt !important;
}
</style>
<body>
	<table class="table">
		<tr>
			<th>
				<h2>
					AVISO DE VENCIMIENTO
				</h2>
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<th class="text-left">
				GUAYAQUIL, {{ $fecha }}
			</th>
		</tr>
		<tr>
			<th class="text-left">
				Señor Padre de Familia de la Estudiante <b>{{ $student->apellidos }} {{ $student->nombres }}</b><br>del {{ $student->course->grado }} {{ $student->course->paralelo }}
			</th>
		</tr>
		<tr>
			<th class="text-left">
				De mis consideraciones:
			</th>
		</tr>
		<tr>
			<th class="text-left">
				Por la presente comunico a Ud. que revisados nuestros registros encontramos valores vencidos o por vencer de su representado siendo los siguientes rubros de PENSIÓN:
			</th>
		</tr>
	</table>
	@php
		$totalRubro = 0;
	@endphp
	@foreach($pagosPendientes as $pago)
	@php
		$rubro = Rubro::find($pago->pago()->first()->idRubro);        
	@endphp
	<div style="display:inline-block; width:33%;">
		<table class="table">
			<tr>
				<td>Rubro</td>
				<td class="text-center">valor</td>
			</tr>
			<tr>
				<td>
					{{ $rubro->tipo_rubro }} 
					{{ App\Fechas::obtenerMes($pago->pago()->first()->mes) }}
				</td>
				@php
					$total =  $pago->pago()->first()->valor_cancelar;
					$descuentoTotal = 0;
					if( strtoupper($rubro->tipo_rubro) == 'Pension') {
						if(count($student->becasDescuentos) != 0) {
							$becaTotal = 0;
							foreach($student->becasDescuentos as $beca){
								$bd = App\BecaDescuento::find($beca->idBeca);
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
							foreach($student->becasDescuentos as $beca){
								$bd = App\BecaDescuento::find($beca->idBeca);
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
				<td class="text-center">{{ $total }}</td>
				@php
					$totalRubro += $total;
				@endphp
			</tr>
		</table>
	</div>
	@endforeach
	<table class="table">
		<tr>
			<th class="text-left">
				Que Suman un Valor de: <b>US${{ $totalRubro }}</b>
			</th>
		</tr>
		<tr>
			<th class="text-left">
				Pagar dentro  {{$dia_pago < 2 ? " del primer día" : " de los ".$dia_pago." días"}} de cada mes
			</th>
		</tr>
		<tr>
			<th class="text-left">
				Atentamente, <br>COLECTURÍA 
			</th>
		</tr>
	</table>
</body>
</html>