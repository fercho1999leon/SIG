@extends('layouts.master2') 
@section('content')
<a class="button-br" 
	@if (request('semanal'))
		href=" {{route('agenda_Docente.semanal', 'fecha='.request('fecha'))}}"
	@else
		href=" {{route('agenda_Docente', [ 'fecha='.request('fecha')])}} "
	@endif
	>
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	<!-- Incluir el nav_bar_top Cerrar Sesion -->
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">AGENDA<small>Editar</small></h2>
			<div class="lg:flex">
				<a target="_blank" class="btn btn-black sm:mb-0 lg:mt-0 lg:ml-2 " data-toggle="modal" data-target="#crearObservacion" href="">Crear Observación</a>
			</div>
		</div>
	</div>
	<div class="row mt-1">
		<form method="post" action="{{ route('agenda_Docente_updateHora', [$classDay->id])}}" enctype="multipart/form-data">
			<input name="_method" type="hidden" value="PUT">
			<input type="hidden" name="semanal" value="{{request('semanal')}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="pined-table-responsive">
						<!--Modal(Desactivado)-->
						<div class="agendaEscolar__crearTarea-grid">
							<div>
								<h3>
									{{ $matter->nombre }}  -  {{ $course->grado }}  {{ $course->paralelo }} {{ $course->especializacion }}
								</h3>
							</div>
							<div class="agendaEscolar__crearTarea-materia-parcial">
								<p>FECHA DE CREACIÓN: {{$classDay->created_at}}</p>
							</div>
							<div class="agendaEscolar__crearTarea-materia-parcial">
								<p>PARCIAL: {{$classDay->parcial}}</p>
								<input type="date" class="form-control" value="{{ $classDay->fecha}}" name="fecha" id="fecha" step="1">
							</div>
							<input type="text" class="form-control" placeholder="Nombre.." name="nombre" value="{{ $classDay->nombre }}">
							<textarea class="form-control" rows="6" placeholder="Descripción de los detalles de la clase" name="descripcion">{{ $classDay->descripcion }}</textarea>
							<input type="text" class="form-control" placeholder="Link video.." name="linkVideo" value="{{$classDay->linkVideo}}">
							<textarea class="form-control" rows="2" placeholder="Observaciones" name="observacion">{{ $classDay->observacion }}</textarea>
							<div>
								@if ($classDay->adjuntos != null)
									<div>
										<a download href="{{Storage::url("adjuntos/$classDay->adjuntos")}}" class="btn btn-primary">{{$classDay->adjuntos}}</a>
									</div>
								@endif
								<span class="nuevoMensaje__adjuntos-aviso">(Solo se puede adjuntar 1 archivo hasta 5 Mb)</span>
								<input type="file" name="adjunto">
							</div>						</div>
						<div class="col-lg-12 text-center mt-1">
							<button type="submit" class="btn btn-primary btn-lg">ACTUALIZAR</button>
						</div> 
					</div>
				</div>
			</div>
		</form>
	</div>
	{{-- Observaciones --}}
	@include('partials.agenda._observacionEstudiantes', [
		'routeDelete' => 'agenda_Docente_destroyObservacion'
	])
</div>
{{-- Modal Creación Observación --}}
@include('partials.agenda._modalCrearObservacion', [
	'route' => 'agenda_Docente_storeObservacion',
])
{{-- Modal Editar Observación --}}
@include('partials.agenda._modalEditarObservacion', [
	'routeUpdate' => 'agenda_Docente_updateObservacion'
])
@endsection