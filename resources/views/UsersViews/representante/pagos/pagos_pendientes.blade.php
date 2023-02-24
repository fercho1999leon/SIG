@extends('layouts.master')
@section('content')
@php
	use App\Rubro;
@endphp
<style>
	td {
		padding: 8px !important;
	}
</style>
<a class="button-br" href="{{route('hijo', $hijo)}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Pagos <small>/ {{$hijo->apellidos}} {{$hijo->nombres}} </small></h2>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-xs-12">
			<table class="s-calificaciones w100 white-bg">
				<tr class="table__bgBlue uppercase">
					<td class="text-center">Pagar</td>
					<td class="text-center">Mes - Año</td>
					<td class="text-center">Tipo</td>
					<td class="text-center">Valor</td>
					<td class="text-center">Descuento o Beca</td>
					<td class="text-center">Estado</td>
				</tr>
				@foreach ($pagos as $pago)
				@php
					// $rubro = Rubro::find($pago->idRubro);  
				@endphp
					<tr><td class="text-center">
						@if($pago->estado==='PENDIENTE')
						<input type="checkbox" name="" id="">
						@endif
					</td>
						<td class="text-center">
							{{ $pago->pago->mes == '1' ? 'Enero' : ''}}
							{{ $pago->pago->mes == '2' ? 'Febrero' : ''}}
							{{ $pago->pago->mes == '3' ? 'Marzo' : ''}}
							{{ $pago->pago->mes == '4' ? 'Abril' : ''}}
							{{ $pago->pago->mes == '5' ? 'Mayo' : ''}}
							{{ $pago->pago->mes == '6' ? 'Junio' : ''}}
							{{ $pago->pago->mes == '7' ? 'Julio' : ''}}
							{{ $pago->pago->mes == '8' ? 'Agosto' : ''}}
							{{ $pago->pago->mes == '9' ? 'Septiembre' : ''}}
							{{ $pago->pago->mes == '10' ? 'Octubre' : ''}}
							{{ $pago->pago->mes == '11' ? 'Noviembre' : ''}}
							{{ $pago->pago->mes == '12' ? 'Diciembre' : ''}}
							{{ $pago->pago->mes == 'Ambiente_Digital' ? 'Ambiente Digital' : ''}}
							{{ $pago->pago->mes == 'Robotica_Educativa' ? 'Robotica Educativa' : ''}}
						</td>
						<td class="text-center">
							{{-- {{ $rubro->tipo_rubro == 'Ambiente_Digital' ? 'Ambiente Digital' : ''}}
							{{ $rubro->tipo_rubro == 'Robotica_Educativa' ? 'Robotica Educativa' : ''}}
							{{ $rubro->tipo_rubro == 'Matricula' ? 'Matricula' : ''}}
							{{ $rubro->tipo_rubro == 'Pension' ? 'Pension' : ''}}
							{{ $rubro->tipo_rubro == 'Otro' ? 'Otro' : ''}} --}}
						</td>
						<td class="text-center">${{ $pago->pago->valor_cancelar }}</td>
						<td class="text-center">
							{{-- @if(count($hijo->becasDescuentos) != 0)
								{{ $becas->find($student->becasDescuentos->first()->idBeca)->tipo }} 
								{{ $becas->find($student->becasDescuentos->first()->idBeca)->valor }}
								<i class="fa fa-info-circle" aria-hidden="true"></i>
							@else
								-
							@endif --}}
						</td>
						<td class="text-center bold">
							{{$pago->estado}}
						</td>
					</tr>
				@endforeach
			</table>
			<input class="btn btn-primary" type="button" name="PEL" value="Pago en Linea">
		</div>
	</div>
</div>
@endsection