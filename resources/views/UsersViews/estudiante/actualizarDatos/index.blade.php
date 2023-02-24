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
				
			</div>
		</div>
		<br>
		<form id="createStudent" method="post" action="{{ route('actualizarEstudiantePost', $data->id) }}" enctype="multipart/form-data">
			
          
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="idStuden" value="{{$data->id}}">
			@include('UsersViews.estudiante.actualizarDatos.actualizar', [
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
				'button' => 'Actualizar Datos',
                'buttonCXC' => 'aa',
				'modalRepresentante' => true,
				'nuevaMatricula' => false,
				'crear' => false
			])
		</form>
		
@endsection
@section('scripts')
<script>
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
