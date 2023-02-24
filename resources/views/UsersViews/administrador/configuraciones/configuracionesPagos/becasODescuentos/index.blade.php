@extends('layouts.master') 
@section('content')
<!--<a class="button-br" href="{{ route('configuracionesPagos') }}">
	<button>
		<img src="../img/return.png" alt="" width="17"> Regresar
	</button>
</a>-->
<a class="button-br" href="{{route('configuraciones')}}">
	<button>
		<img src="../img/return.png" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Becas o Descuentos
				<small>Pagos</small>
			</h2>
			<a href="{{route('crearBOD')}}" class="destreza__destreza-crear title-page table__bgBlue">
				CREAR BECAS O DESCUENTO
			</a>
		</div>
	</div>
	<div class="row mt-1">
		<div class="col-xs-12">
			<div class="panel panel-default p-1">
				<div class="table-responsive">
                	<table class="table table-pag-hist">
	                    <thead>
	                        <tr>
	                            <th>#</th>
								<th>Tipo</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Tipo de pago</th>
	                            <th>Valor o porcentaje a descontar</th>
	                            <th>Acción</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($bod as $iterator)
	                        <tr id="{{$iterator->id}}">
	                            <td>{{ $loop->iteration }}</td>
	                            <td>{{ $iterator->tipo }}</td>
	                            <td>{{ $iterator->nombre }}</td>
	                            <td>{{ $iterator->descripcion }}</td>
								<td>{{ $iterator->tipo_pago }}</td>
								<td>{{ $iterator->valor }}</td>
	                            <td>
	                            	<a href="{{ route('editarBOD', $iterator->id) }}">Editar</a>
									<div class="icon__eliminar-form form-delete" onclick="eliminarDescuento({{$iterator->id}}, '{{$iterator->tipo}}')" >
										<input name="_method" type="hidden" value="DELETE">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<button type="submit" class="icon__eliminar-btn">
											<i class="fa fa-trash"></i>
										</button>
					                </div>
	                            </td>
	                        </tr>
	                        @endforeach
	                    </tbody>
                	</table>
                </div>
        	</div>        
        </div>
	</div>
	
</div>
@endsection
@section('scripts')
<script>
	var url = window.location.origin
	function eliminarDescuento(idDescuento, tipo) {
		console.log(idDescuento,tipo)
		Swal.fire({
			title: 'Seguro desea eliminar est'+ (tipo == 'BECA' ? 'a Beca?' : 'e Descuento?'),
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI',
			cancelButtonText: 'NO'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: `${url}/Configuraciones/Eliminar Beca o Descuento/${idDescuento}`,
						data: {
							'_token': $('input[name=_token]').val(),
							'_method': 'DELETE'
						},
						success: function (response) {
							$('#'+idDescuento).css('display', 'none')
							Swal.fire(
								tipo+' Eliminado con exito!',
								'',
								'success'
							)
						}, error: function(response) {
							alert('Algo salio mal.')
						}
					});
					
			}
		})
	}
</script>
@endsection