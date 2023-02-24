@extends('layouts.master2') 
@section('content')

<a class="button-br" 
	@if (request('semanal') != null)
		href=" {{route('ver_CursoAgenda.semanal', ['id' => $matter->idCurso,'fecha='.request('fecha')])}} 
	@else
		href=" {{route('ver_CursoAgenda', ['id' => $matter->idCurso,'fecha='.request('fecha')])}} 
	@endif
	">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>

<div id="page-wrapper" class="gray-bg dashbard-1">
	<!-- Incluir el nav_bar_top Cerrar Sesion -->
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">AGENDA ESCOLAR <small>Editar</small></h2>
			<div class="lg:flex">
				<a target="_blank" class="btn btn-black sm:mb-0 lg:mt-0 lg:ml-2 " data-toggle="modal" data-target="#crearObservacion" href="">Crear Observación</a>
			</div>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a href="{{ route('ver_CursoAgenda',['id' => $course->id,'fecha='.request('fecha')])}}""> {{$course->grado}} {{$course->paralelo}} {{$course->especialzacion}} </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a class="no-pointer"> editar </a>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-lg-12">
			<div class="panel panel-default pined-table-responsive">
				<form method="post" action="{{ route('updateClaseAdministrador', $classDay->id) }}" enctype="multipart/form-data">
					<input type="hidden" name="semanal" value="{{request('semanal')}}">
					<input name="_method" type="hidden" value="PUT">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					{{-- Formulario para crear actividad --}}
					@include('partials._formularioActividad', [
						'btn' => 'Actualizar'
					])
				</form>
			</div>
		</div>
	</div>
	
	{{-- Modal Crear Observación --}}
	@include('partials.agenda._modalCrearObservacion', [
		'route' => 'ClaseObservacionAdministrador'
	])
	{{-- Modal Editar Observación --}}
	@include('partials.agenda._modalEditarObservacion', [
		'routeUpdate' => 'ClaseObservacionAdministradorUpdate'
	])
	{{-- Observación Estudiante --}}
	@include('partials.agenda._observacionEstudiantes', [
		'routeDelete' => 'ClaseObservacionAdministradorDestroy'
	])
</div>
@endsection 
