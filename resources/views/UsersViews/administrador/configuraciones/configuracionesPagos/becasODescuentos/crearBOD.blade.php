@extends('layouts.master') 
@section('content')
<!--<a class="button-br" href="{{ route('configuracionesPagos') }}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>-->
<a class="button-br" href="{{ route('becas')}}">
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
				<form method="post" action="{{ route('storeBOD') }}">
					<input name="_method" type="hidden" value="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="configuracionesPago__crearPago">
						<div class="mb-1">
							<strong class="mt-1">TIPO: </strong>
							<select class="form-control" name="tipo" required>
								<option value="BECA">Beca</option>
								<option value="DESCUENTO">Descuento</option>
							</select>
						</div>
						<div class="mb-1">
							<strong>NOMBRE: </strong>
							<input class="form-control" name="nombre" type="text" required>
						</div>
						<div class="mb-1">
							<strong>DESCRIPCION: </strong>
							<input class="form-control" name="descripcion" type="text" required>
						</div>
						<div class="mb-1">
								<strong class="mt-1">TIPO PAGO: </strong>
								<select class="form-control" name="tipo_pago" required>
									<option value="USD">USD</option>
									<option value="PORCENTAJE">Porcentaje</option>
								</select>
						</div>
						<div class="mb-1">
							<strong>VALOR: </strong>
							<input class="form-control" name="valor" type="number" step="0.01" min="0.00">
						</div>						
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-lg mb-2">GUARDAR</button>
						</div> 	
					</div>				
				</form>
        </div>
	</div>
</div>
@endsection