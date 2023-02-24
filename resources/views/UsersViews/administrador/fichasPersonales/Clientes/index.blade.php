@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('clientes.index');
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Fichas Personales Clientes</h2>
		    </div>
		</div>
		<div class="wrapper wrapper-content">
			@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
	        <div class="agregarSeccionCont">
				<a href="{{route('clients.create')}}">
					<button class="btn dirConfiguraciones__instituto--agregarInfo">Agregar nuevo Cliente</button>
				</a>
			</div>
			@endif
			<hr class="dirConfiguraciones__instituto--hr">
        	<form method="get">
				<div class="a-matricula__estudiantes">
					<input type="search" name="search" id="admin-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
				</div>
			</form>
			<div id="admin-list" class="a-listaPersonal">
				@foreach($clientes as $cliente)
					<div class="fDocente">
						<div class="a-personal-administrativo__card">
							<p id="docente" class="nombreDocente">{{ $cliente->apellidos }} {{ $cliente->nombres }}</p>
							<hr class="a-hr-administrativo">
							<div class="a-personal-administrativo__icons">
								<div></div>
								<div>
									<span>
										<a href="" data-url="{{route('clients.show', $cliente->id)}}" class="icon__ver">
											<i class="fa fa-eye"></i>
										</a>
									</span>
									@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<span>
										<a href="{{ route('clients.edit', $cliente->id) }}" class="icon__editar">
											<i class="fa fa-pencil"></i>
										</a>
									</span>
									@endif
									@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
									<span>
										<form action="{{route('clients.destroy', $cliente->id)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este usuario?')" >
											<input name="_method" type="hidden" value="DELETE">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<button type="submit" class="icon__eliminar-btn">
												<i class="fa fa-trash"></i>
											</button>
										</form>
									</span>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="matricula__pagination">
				{{ $clientes->links() }}
			</div>
        </div>
	</div>
	{{-- modal para  --}}
	<div class="modal fade" id="detalleCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	</div>
@endsection
@section('scripts')
	<script>
		// Abriendo el modal para mostrar la información del cliente
		$('.icon__ver').click(function(e) {
			var route =($(this).data('url'))
			e.preventDefault();
			$.ajax({
				type: "GET",
				url: route,
				success: function (response) {
					$('#detalleCliente').html(response)
					$('#detalleCliente').modal('show')
				}, error: function() {
					alert('Sucedio un error.')
				}
			});
		})
	</script>
@endsection
