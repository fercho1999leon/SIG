@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('representantes');
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        @php
        	$tipo_usuario = 'Representante';
        @endphp
        <div class="row wrapper white-bg ">
			<div class="col-lg-12 titulo-separacion">
				@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
				<h2 class="title-page">Fichas del Personal {{$tipo_usuario == 'Administrador' ? 'Administrativo' : $tipo_usuario }}</h2>
				@if ($tipo_usuario == 'Docente')
					<a target="_blank" class="btn btn-black" href="{{route('reporteDocentesGeneral')}}">Reporte Docentes</a>
				@endif
				@endif
			</div>
		</div>
		<div class="wrapper wrapper-content">
			@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
			<div class="agregarSeccionCont">
				<a href="{{ route('administrativos_crear') }}?tipo_usuario={{$tipo_usuario}}">
					<button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Nuevo Representante</button>
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
				@foreach($data as $admin)
					<div class="fAdministrativo">
						<div class="a-personal-administrativo__card relative">
							<p id="admin" class="a-nombre-administrativo">{{ $admin->apellidos }} {{ $admin->nombres }}</p>
							<span class="a-meta">{{ $admin->cargo }}</span>
							<hr class="a-hr-administrativo">
							<div class="text-center a-personal-administrativo__icons">
								@if ($tipo_usuario == 'Docente')
									@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
									<div>
										<a href="{{route('reportePorDocente', $admin->id)}}" class="pinedTooltip mr-05" target="_blank">
											<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
											<span class="pinedTooltipH">Reporte Docente</span>
										</a>
									</div>
									@endif
								@else
									<div></div>
								@endif
								<div>
									<span>
										<a data-route="{{route('representante.show', $admin)}}" class="icon__ver">
											<i class="fa fa-eye"></i>
										</a>
									</span>
									@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<span>
										<a href="{{route('administrativos_update',['type'=>$tipo_usuario,'user' =>  $admin->id])}}" class="icon__editar">
											<i class="fa fa-pencil"></i>
										</a>
									</span>
									@endif
									@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
									<span>
										<form action="{{route('administrativos_update_delete',['user'   =>  $admin->id])}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este usuario?')" >
											<input name="_method" type="hidden" value="DELETE">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<button type="submit" class="icon__eliminar-btn fz19">
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
				{{ $data->links() }}
			</div>
		</div>
	</div>
	{{-- modal para ver la información del representante --}}
	<div class="modal fade" id="detalleRepresentante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	</div>
@endsection
@section('scripts')
<script>
	$('.icon__ver').click(function() {
		$.ajax({
			type: "GET",
			url: $(this).data('route'),
			success: function (response) {
				$('#detalleRepresentante').html(response)
				$('#detalleRepresentante').modal('show')
			}, error: function() {
				console.log('Sucedio error al traer la información del padre')
			}
		});
	})

</script>
@endsection
