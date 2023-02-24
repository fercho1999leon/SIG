@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{route('configuracionesPagos')}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg">
		<div class="col-lg-12">
			<h2 class="title-page">Configuraciones
				<small>Editar Pagos</small>
			</h2>
		</div>
	</div>
	<div class="row wrapper white-bg directorPerfil-info"></div>
		<div class="row mt-1">
			<div class="col-xs-12">
				<form method="post" action="{{ route('configuraciones_ActualizarPago', $id) }}">
					<input name="_method" type="hidden" value="PUT">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="configuracionesPago__crearPago bg-white">
						<h2 class="text-center text-color3">
							Curso:
							{{ $course->grado}} {{ $course->paralelo}}
						</h2>
						<div class="mb-1">
							<strong>MES: </strong>
							<select class="form-control" name="mes">
								<option value="1" {{ (1 == $pago->mes ) ? ' selected' : '' }}>Enero</option>
								<option value="2" {{ (2 == $pago->mes ) ? ' selected' : '' }}>Febrero</option>
								<option value="3" {{ (3 == $pago->mes ) ? ' selected' : '' }}>Marzo</option>
								<option value="4" {{ (4 == $pago->mes ) ? ' selected' : '' }}>Abril</option>
								<option value="5" {{ (5 == $pago->mes ) ? ' selected' : '' }}>Mayo</option>
								<option value="6" {{ (6 == $pago->mes ) ? ' selected' : '' }}>Junio</option>
								<option value="7" {{ (7 == $pago->mes ) ? ' selected' : '' }}>Julio</option>
								<option value="8" {{ (8 == $pago->mes ) ? ' selected' : '' }}>Agosto</option>
								<option value="9" {{ (9 == $pago->mes ) ? ' selected' : '' }}>Septiembre</option>
								<option value="10" {{ (10 == $pago->mes ) ? ' selected' : '' }}>Octubre</option>
								<option value="11" {{ (11 == $pago->mes ) ? ' selected' : '' }}>Noviembre</option>
								<option value="12" {{ (12 == $pago->mes ) ? ' selected' : '' }}>Diciembre</option>
							</select>
						</div>
						<div class="mb-1">
							<strong>TIPO: </strong>
							<select class="form-control" name="tipo" id="tipo-rubro" required>
								<option value="">Escoja un rubro</option>
								@forelse ($rubros as $rubro)
									<option url="{{route('rubro.show', $rubro)}}" {{$pago->rubro->id !== $rubro->id ?:'selected'}} value="{{$rubro->id}}">{{$rubro->tipo_rubro}}</option>
								@empty
									<option value="">No existen rubros.</option>
								@endforelse
							</select>
						</div>
						<div class="mb-1">
							<strong>TIPO EMISION: </strong>
							<div class="matricula__matriculacion__input">
								<div class="matricula__seccionMensaje" id="rubro">
									{{$pago->rubro->tipo_emision}}
								</div>
							</div>
						</div>
						<div class="mb-1">
							<strong>AÑO: </strong>
							<select class="form-control" name="ano" required>
								<option {{$pago->anio !== 2019 ?: 'selected'}} value="2019">2019</option>
								<option {{$pago->anio !== 2020 ?: 'selected'}} value="2020">2020</option>
								<option {{$pago->anio !== 2021 ?: 'selected'}} value="2021">2021</option>
							</select>
						</div>
						<div class="mb-1">
							<strong>DESCRIPCIÓN: </strong>
							<textarea class="form-control" name="descripcion" required>{{ $pago->descripcion }}</textarea>
						</div>
						<div class="mb-1">
							<strong>VALOR AUTORIZADO: </strong>
							<input class="form-control" name="valor_autorizado" type="number" step="0.01" min="0.00" required value="{{ $pago->valor_autorizado }}">
						</div>
						<div class="mb-1">
							<strong>VALOR A CANCELAR: </strong>
							<input class="form-control" name="valor_cancelar" type="number" step="0.01" min="0.00" required value="{{ $pago->valor_cancelar }}">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-lg">ACTUALIZAR</button>
						</div> 
					</div>
				</form>
			</div>
		</div>
</div>
@endsection
@section('scripts')
	<script>
		var tipoRubro = $('#tipo-rubro');
		tipoRubro.change(function() {
			var idRubro = $(this).val();
			$.ajax({
				type: "GET",
				url: `/Configuraciones/Pagos/rubro/${idRubro}`,
				success: function (result, status, xhr) {
					$('#rubro').text(result.tipo_emision)
				}, error() {
					$('#rubro').text('Escoja un rubro')
				}
			});
		})
	</script>
@endsection