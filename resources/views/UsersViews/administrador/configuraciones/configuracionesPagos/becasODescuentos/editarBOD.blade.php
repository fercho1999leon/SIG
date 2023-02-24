@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{ route('becas') }}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg">
		<div class="col-lg-12">
			<h2 class="title-page">Becas o Descuentos
				<small>Pagos</small>
			</h2>
		</div>
	</div>
	<div class="row mt-1">
		<div class="col-xs-12">
			<form method="post" action="{{ route('updateBOD', $bod->id) }}">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="configuracionesPago__crearPago">
					<div class="mb-1">
						<strong class="mt-1">TIPO: </strong>
						<select class="form-control" name="tipo" required>
							<option value="BECA" {{ ("BECA" == $bod->tipo ) ? ' selected' : '' }}>Beca</option>
							<option value="DESCUENTO" {{ ("DESCUENTO" == $bod->tipo ) ? ' selected' : '' }}>Descuento</option>
						</select>
					</div>
					<div class="mb-1">
						<strong>NOMBRE: </strong>
						<textarea class="form-control" name="nombre" required> {{ $bod->nombre }}</textarea>
					</div>
					<div class="mb-1">
						<strong>DESCRIPCIÓN: </strong>
						<textarea class="form-control" name="descripcion" required>{{ $bod->descripcion }}</textarea>
					</div>
					<div class="mb-1">
						<strong class="mt-1">TIPO PAGO: </strong>
						<select name="tipo_pago" class="form-control" required>
							<option value="USD" {{ ("USD" == $bod->tipo_pago ) ? ' selected' : '' }}>USD</option>
							<option value="PORCENTAJE" {{ ("PORCENTAJE" == $bod->tipo_pago ) ? ' selected' : '' }}>DESCUENTO</option>
						</select>
					</div>
					<div class="mb-1">
						<strong>VALOR: </strong>
						<input class="form-control" name="valor" type="number" step="0.01" min="0.00" value="{{ $bod->valor }}">
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary btn-lg">GUARDAR</button>
					</div> 
				</div>
			</form>
        </div>
	</div>
</div>
@endsection