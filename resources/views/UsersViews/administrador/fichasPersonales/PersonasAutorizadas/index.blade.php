@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('personas-autorizadas.index');
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Personas Autorizadas</h2>
		    </div>
		</div>
		<div class="wrapper wrapper-content">
			@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
	        <div class="agregarSeccionCont">
				<a href="{{route('personas-autorizadas.create')}}">
					<button class="btn dirConfiguraciones__instituto--agregarInfo">Agregar persona autorizada</button>
				</a>
			</div>
			@endif
			<form class="mt-6" method="get">
				<div class="a-matricula__estudiantes">
					<input type="search" name="search" id="admin-search" placeholder="Buscar..." class="inputSearch" value="{{request()->search}}">
				</div>
			</form>
			<div class="a-listaPersonal mt-10">
				@foreach($personasAutorizadas as $user)
					<div class="fDocente">
						<div class="a-personal-administrativo__card">
							<p id="docente" class="nombreDocente">{{ $user->nombres }}</p>
							<hr class="a-hr-administrativo">
							<div class="a-personal-administrativo__icons">
								<div></div>
								<div>
									<span>
										<a href="{{route('personas-autorizadas.show', $user)}}" class="icon__ver">
											<i class="fa fa-eye"></i>
										</a>
									</span>
									@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<span>
										<a href="{{route('personas-autorizadas.edit', $user)}}" class="icon__editar">
											<i class="fa fa-pencil"></i>
										</a>
									</span>
									@endif
									@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
									<span>
										<form action="{{route('personas-autorizadas.destroy', $user)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este usuario?')" >
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
				{{ $personasAutorizadas->links() }}
			</div>
        </div>
    </div>
@endsection
