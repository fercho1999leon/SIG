@extends('layouts.master')
@section('content')

	<a class="button-br" href=" {{route('matricula') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
	<div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
		<div class="row wrapper white-bg directorPerfil-info">
			<div class="col-lg-12 titulo-separacion">
				<h2 class="title-page">Estudiante:
					<small>{{ $data->nombres }} {{ $data->apellidos }}</small>
				</h2>
					<button class="btn btn-primary" onclick="paseDeAnio();" {{$PaseDeAnio ==0 ? 'disabled':''}}>Pasar de año</button >
			</div>
		</div>
		<br>
		<form id="createStudent" method="post" action="{{ route('matriculaActualizar', $data->id) }}" enctype="multipart/form-data">
			<input name="_method" type="hidden" value="PUT">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			@include('partials.matricula.matricula', [
				'reporte_pagos' => true,
				'beca' => true,
				'descuento' => true,
				'numeroMatricula' => true,
				'transporte' => true,
				'nivel' => true,
				'retirado' => true,
				'periodo' => true,
				'bloquear' => true,
				'acceso' => true,
				'button' => 'Actualizar Estudiante',
				'buttonCXC' => 'Actualizar y Crear Cuenta por Cobrar',
				'modalRepresentante' => true,
				'nuevaMatricula' => false,
				'crear' => false
			])
		</form>
		<!-- Modal -->
		<div class="modal fade" id="modalTabRep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">REPRESENTANTE</h4>
					</div>
					<div class="modal-body">
						<div class="">
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab-10">Info</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab-11">Representados</a>
									</li>
								</ul>
								@if( $data-> idRepresentante!=null )
								<div class="tab-content">
									<div id="tab-10" class="tab-pane active">
										<div class="grid-form mt-2">
											<h2 class="no-margin grid-form-p">Nombres</h2>
											<div>
												<div class="matriculaVerDatos">
													@foreach( $users as $user )
														@if( $data->idRepresentante == $user->id)
															{{ $user->nombres }}
														@endif
													@endforeach
												</div>
											</div>
											<h2 class="no-margin grid-form-p">Apellidos</h2>
											<div>
												<div class="matriculaVerDatos">
													@foreach( $users as $user )
														@if( $data->idRepresentante == $user->id)
															{{ $user->apellidos }}
														@endif
													@endforeach
												</div>
											</div>
											<h2 class="no-margin grid-form-p">C.I.</h2>
											<div>
												<div class="matriculaVerDatos">
													@foreach( $users as $user )
														@if( $data->idRepresentante == $user->id)
															{{ $user->ci }}
														@endif
													@endforeach
												</div>
											</div>
											<h2 class="no-margin grid-form-p">Correo</h2>
											<div>
												<div class="matriculaVerDatos">
													@foreach( $users as $user )
														@if( $data->idRepresentante == $user->id)
															{{ $user->correo }}
														@endif
													@endforeach
												</div>
											</div>
										</div>
									</div>
									<div id="tab-11" class="tab-pane">
										@foreach($list as $repre)
										<div class="matricula__representados">
											<li style="display: inline-block">
												<h4 class="no-margin">
													{{ $repre->nombres }} {{ $repre->apellidos }}
												</h4>
												<h4 class="no-margin pull-right">
													@foreach($courses as $course)
														@if($repre->idCurso== $course->id)
															{{ $course->grado }} {{ $course->paralelo }}
														@endif
													@endforeach
												</h4>
											</li>
										</div>
										@endforeach
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="pasarDeAnio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Pasar de año, curso actual: {{$cursoActual}} </h4>
			</div>
			<form id="form-pasar-de-periodo" action="{{route('pasarDePeriodoLectivo', $data)}}" method="post">
				<div class="modal-body">
					{{ csrf_field() }}
					<div class="mb-6">
						<label for="">Por favor, seleccione a que curso irá el estudiante</label>
						<select name="idCurso" class="form-control">
							@foreach ($nextYearCourses as $course)
								<option value="{{$course->id}}"> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}</option>
							@endforeach
						</select>
					</div>
					<div>
						<label for="">Tipo de Matricula</label>
						<select class="form-control" name="tipo_matricula">
							<option value="Ordinaria">Ordinaria</option>
							<option value="Extraordinaria">Extraordinaria</option>
							<option value="Pre Matricula">Pre-Matricula</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btn-pasar-de-periodo" class="btn btn-primary">Pasar de año</button>
				</div>
			</form>
			</div>
		</div>
		</div>
		@if($errors->any())
			<div id="show-error" class="modal fade in" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">ERROR EN PROCESOS</h4>
						</div>
						@foreach($errors->all() as $value)
							<div class="alert alert-danger" role="alert">Error {{$value}}</div>
						@endforeach
				</div>
			</div>  
		@endif
		
@endsection
@section('scripts')
<script>
	@if(session()->has('message'))
		Swal.fire(
			'El estudiante ha pasado de ciclo!',
			'',
			'success'
		);
	@endif
</script>
<script>
	
	$('#show-error').modal();
	//$('#show-message').modal();
    var pasar_periodo = document.getElementById('btn-pasar-de-periodo')
    pasar_periodo.addEventListener('click', function() {
        this.setAttribute('disabled', true)
        document.getElementById('form-pasar-de-periodo').submit()
    });

	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
	var curso = $('#matricula-curso');
	var seccion = $('#matricula-seccion');
	var seccionSelect = $('#matricula-seccion-select');

	let sec = curso.find(':selected').data('seccion')
	if(sec == 'EI') {
		seccion.html('Educación Inicial')
	} else if(sec == 'EGB') {
		seccion.html('Educación General Básica')
	} else if(sec == 'BGU'){
		seccion.html('Bachillerato General Unificado')
	} else {
		seccion.html('Seleccione un curso')
	}

	if(curso && seccion && seccionSelect) {
		curso.change(function() {
			let sec = $(this).find(':selected').data('seccion')
			seccionSelect.val(sec)
			if(sec == 'EI') {
				seccion.html('Educación Inicial')
			} else if(sec == 'EGB') {
				seccion.html('Educación General Básica')
			} else if(sec == 'BGU'){
				seccion.html('Bachillerato General Unificado')
			} else {
				seccion.html('Seleccione un curso')
			}
		})
	} else {
		console.log('no se puedo encontrar el id');
	}
	function paseDeAnio(){
		$('#pasarDeAnio').modal('show');
	}
</script>
@endsection
