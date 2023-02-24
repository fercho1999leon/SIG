@extends('layouts.master-reportes')
@section('content')
	@section('style')
		<style>
			.table td,
			.table th { 
				font-size: 8.5pt !important;
			}
		</style>
	@endsection
	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="20%">
				<div class="header__logo" style="text-align:left">
					<img 
						@if(DB::table('institution')->where('id', '1')->first()->logo == null)                    
							src="{{ secure_asset('img/logo/logo.png') }}"
						@else
							src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  
						@endif 
					alt="" width="70">
				</div>
			</th>
			<th class="no-border" width="75%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
				</div>
			</th>
			<th class="no-border" width="5%">
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border text-center bold">PAGARÉ CON VENCIMIENTOS SUCESIVOS</td>
		</tr>
		<tr>
			<td class="no-border text-right">
				<br>
			</td>
		</tr>
		<tr>
			<td class="no-border">
				Debo(emos) y pagaré(mos) solidaria e incondicionalmente a la orden de "{{$institution->nombre}}" a 10 meses vista, en la ciudad de {{$institution->ciudad}}, {{$institution->direccion}}, en las oficinas de la {{$institution->nombre}}, la cantidad de {{bcdiv($pagoTotal, '1', 2)}} dólares de los Estados Unidos de América, plazo que corre desde la fecha de suscripción hasta la fecha de vencimiento, suma de dinero que pagaré(mos) mediante 10 cuotas iguales y sucesivas de {{$valorMes}} dólares de los Estados Unidos de América cada una, que corresponden al pago de capital, debiendo pagarse irrevocablemente de acuerdo a la tabla de amortización siguiente:
			</td>
		</tr>
		<tr>
			<td class="no-border">
				<br>
				<table class="table">
					<tr>
						<td class="text-center">No. Cuota</td>
						<td class="text-center">Pensión</td>
						<td class="text-center">Fecha de pago</td>
						<td class="text-center">Valor</td>
					</tr>
					@php
						$cont=1;
					@endphp
					@foreach ($pagos as $pago)
						@if(strToUpper($pago->pago->rubro->tipo_rubro) == 'PENSION')
							<tr>
								<td width="5" class="text-center">{{$cont++}}</td>
								<td>
									{{$pago->pago->rubro->tipo_rubro}} {{App\Fechas::obtenerMes($pago->pago->mes)}}
								</td>
								<td class="text-center">{{$fecha_pago[$pago->id]}}</td>
								<td class="text-center">${{$valor_cancelar[$pago->id]}}</td>
							</tr>
						@endif
					@endforeach
				</table>
			</td>
		</tr>
		<tr>
			<td class="no-border">
				En caso de mora en el pago de uno o más de los valores de capital, el acreedor podrá declarar de plazo vencido anticipado todas las obligaciones que estuvieren vigentes, aún cuando no estuvieren vencidas, y proceder al recaudo judicial de todo lo debido, bastando para ello la simple afirmación que el acreedor hiciere respecto de la mora en el escrito de demanda. <br><br>
				
				Me (nos) obligo (amos) además a cubrir todos los impuestos, tasas, gastos judiciales y extrajudiciales, inclusive honorarios profesionales de abogados del acreedor, que ocasione el cobro de este pagaré, siendo suficiente prueba para establecer tales gastos la mera aseveración del acreedor.<br><br>
				
				Al fiel cumplimiento de lo convenido me (nos) obligo (amos) con todos mis (nuestros) bienes presentes y futuros.
				Renuncio (amos) domicilio y a toda ley, beneficio de exclusión o excepción, o cualquier tipo de recurso o beneficio que pudiere favorecerme (nos) en juicio o fuera de él.<br><br>
				
				Renuncio (amos) también al derecho de interponer el recurso de apelación y el de hecho de las providencias que se
				expidieren en el juicio o juicios que, en relación al presente documento, se diere(n) lugar.<br><br>
				
				Sin protesto. Exímase de presentación para el pago y de avisos por falta del mismo.<br><br>
				
				Quedo (amos) sometido (s) a los jueces o tribunales a los que elija el acreedor, para cuyo efecto renuncio (amos) fuero, jurisdicción, domicilio y vecindad. Dejo (amos) constancia que el presente documento que firmo (amos) es totalmente negociable y transferible.<br><br>
				
				En el evento de ser el deudor una persona juridica las declaraciones constantes en el presente documento se entienden efectuadas por su representante legal a nombre de ella.<br><br>
				
				Para constancia se firma en la ciudad de Guayaquil, el dia {{App\Fechas::fechaActual()}}.
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<table class="table">
		
		<td width="40%" class="text-center no-border">
			<span style="display:inline-block;width:100%;border-top:black solid 1px;margin-top:3px">
				<span class="uppercase">
					{{$student->representante->apellidos}} {{$student->representante->nombres}}
				</span>
				<br>
				El (la) Representante
			</span>
		</td>
		<td class="no-border" width="10%"></td>
		<td width="50%" class="text-center no-border">
			<span style="display:inline-block;width:100%;border-top:black solid 1px;margin-top:3px">
				{{$institution->nombre}}
				<span class="uppercase" style="color: white">
					nombre de financiero pendiente<br>
				</span>
			</span>
		</td>
	</table>
	<table class="table">
		<tr>
			<td class="no-border">Cédula: {{$student->representante->ci}}</td>
		</tr>
		<tr>
			<td class="no-border">Dirección: {{$student->representante->dDomicilio}}</td>
		</tr>
		<tr>
			<td class="no-border">Teléfono: {{$student->representante->movil}}</td>
		</tr>
		<tr>
			<td class="no-border">ACEPTO TODAS LAS CONDICIONES Y OBLIGACIONES.</td>
		</tr>
	</table>
@endsection