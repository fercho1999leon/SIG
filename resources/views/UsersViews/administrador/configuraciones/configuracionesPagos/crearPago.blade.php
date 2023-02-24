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
				<small>Crear Pago</small>
			</h2>
		</div>
	</div>
	<div class="row wrapper white-bg directorPerfil-info"></div>
	<div class="row mt-1">
		<div class="col-xs-12">
			<div class="max-w-3xl mx-auto md:flex md:justify-center">
				<div class="bg-white p-6 rounded md:mr-6" style="width:500px">
					<form method="post" action="{{ route('configuraciones_CrearPagoEnviar', $idCurso) }}">
						<input name="_method" type="hidden" value="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="">
							<h2 class="text-center text-color3">
								Curso:
								@foreach($courses as $course)
									@if($course->id==$idCurso)
										{{ $course->grado}} {{ $course->paralelo}} {{ $course->especializacion}}
									@endif
								@endforeach
							</h2>
							<div class="mb-1">
								<strong>MES: </strong>
								<select class="form-control" name="mes" required>
									<option value="1">Enero</option>
									<option value="2">Febrero</option>
									<option value="3">Marzo</option>
									<option value="4">Abril</option>
									<option value="5">Mayo</option>
									<option value="6">Junio</option>
									<option value="7">Julio</option>
									<option value="8">Agosto</option>
									<option value="9">Septiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>
								</select>
							</div>
							<div class="mb-1">
								<strong>TIPO: </strong>
								<select class="form-control" name="tipo" id="tipo-rubro" required>
									<option value="">Escoja un rubro</option>
									@forelse ($rubros as $rubro)
										<option url="{{route('rubro.show', $rubro)}}" value="{{$rubro->id}}">{{$rubro->tipo_rubro}}</option>
									@empty
										<option value="">No existen rubros.</option>
									@endforelse
								</select>
							</div>
							<div class="mb-1">
								<strong>TIPO EMISION: </strong>
								<div class="matricula__matriculacion__input">
									<div class="matricula__seccionMensaje" id="rubro">
										Escoja un rubro
									</div>
								</div>
							</div>
							<div class="mb-1">
								<strong>AÑO: </strong>
								<select class="form-control" name="ano" required>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
								</select>
							</div>
							<div class="mb-1">
								<strong>DESCRIPCIÓN: </strong>
								<textarea class="form-control" name="descripcion"></textarea>
							</div>
							<div class="mb-1">
								<strong>VALOR AUTORIZADO: </strong>
								<input class="form-control" name="valor_autorizado" type="number" step="0.01" min="0.00" required>
							</div>
							<div class="mb-1">
								<strong>VALOR A CANCELAR: </strong>
								<input class="form-control" name="valor_cancelar" type="number" step="0.01" min="0.00" required>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-primary btn-lg">GUARDAR</button>
							</div>
						</div>
					</form>
				</div>
				<div class="bg-white p-6 mt-6 rounded md:mt-0" style="width:200px">
					<div class="bg-white p-6 rounded mt-6 md:mt-0">
						<button class="w-full btn btn-primary" data-toggle="modal" data-target="#myModal">Crear rubro</button>
						@foreach ($rubros as $rubro)
							<div class="mt-6 flex justify-between configuracionesPagos__rubro-item">
								{{$rubro->tipo_rubro}}
								<form action="{{route('rubro.destroy', $rubro)}}" method="post">
									{{ csrf_field() }}
									{{method_field('DELETE')}}
									<button class="bg-none no-border p-0" type="submit">
										<i class="fa fa-trash icon__eliminar"></i>
									</button>
								</form>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Crear Rubro-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Creación Rubro</h4>
				</div>
				<form action="{{route('rubro.store')}}" method="post">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="mb-6">
							<label for="">Rubro</label>
							<input name="tipo_rubro" type="text" class="form-control" required>
						</div>
						<div>
							<label for="">Tipo de Emisión</label>
							<select name="tipo_emision" class="form-control" required>
								<option value="factura">Factura</option>
								<option value="recibo">Recibo</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Crear Rubro</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
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
@endsection