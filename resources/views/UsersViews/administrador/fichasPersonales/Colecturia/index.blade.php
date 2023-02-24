@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('colecturia.index');
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
			<div class="col-lg-12 titulo-separacion">
				<h2 class="title-page">Fichas del Personal Colecturia</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
			<div class="agregarSeccionCont">
				<a href="{{route('colecturia.create')}}">
					<button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Nuevo Personal Académico</button>
				</a>
			</div>
			@endif
			<hr class="dirConfiguraciones__instituto--hr">
			<form method="get">
				<div class="a-matricula__estudiantes">
					<input type="search" name="search" id="admin-search" placeholder="Buscar..." class="inputSearch" value="">
				</div>
			</form>
			<div id="admin-list" class="a-listaPersonal">
				@foreach($users as $user)
					<div class="fAdministrativo">
						<div class="a-personal-administrativo__card relative">
							<img class="shadow a-icono-administrativo"
								alt="image" src="{{secure_asset('img/personal/personal_gris.svg')}}" />
							<p  class="a-nombre-administrativo">{{$user->apellidos}} {{$user->nombres}}</p>
							<span class="a-meta">{{$user->cargo}}</span>
							<hr class="a-hr-administrativo">
							<div class="text-center a-personal-administrativo__icons">
								<div>
									<span>
										<a data-route="{{route('colecturia.show', $user)}}" class="icon__ver">
											<i class="fa fa-eye"></i>
										</a>
									</span>
									@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<span>
										<a href="{{route('colecturia.edit', $user)}}" class="icon__editar">
											<i class="fa fa-pencil"></i>
										</a>
									</span>
									@endif
									@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
									<span>
										<form action="{{route('colecturia.destroy', $user)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este usuario?')" >
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
				{{ $users->links() }}
			</div>
		</div>
	</div>
	{{-- modal ver colecturia --}}
	<div class="modal fade" id="detalleColector" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	</div>
@endsection
@section('scripts')
<script>
	$('.icon__ver').click(function() {
		$.ajax({
			type: "GET",
			url: $(this).data('route'),
			success: function (response) {
				$('#detalleColector').html(response)
				$('#detalleColector').modal('show')
			}, error: function() {
				console.log('sucedio un error')
			}
		});
	})
</script>
@endsection
