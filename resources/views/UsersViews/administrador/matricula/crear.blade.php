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
		<div class="col-lg-12">
			<h2 class="title-page">Matrícula Estudiantil:
				<small>Agregar Nuevo Estudiante</small>
			</h2>
		</div>
	</div>
	<br>
	<form method="post" id="form-create-student" action="{{ route('matricula_Crear') }}" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		@include('partials.matricula.matricula', [
			'reporte_pagos' => false,
			'beca' => false,
			'descuento' => false,
			'numeroMatricula' => false,
			'transporte' => true,
			'nivel' => false,
			'retirado' => false,
			'periodo' => false,
			'bloquear' => false,
			'acceso' => false,
			'button' => 'Matricular Estudiante',
			'modalRepresentante' => false,
			'nuevaMatricula' => true,
			'crear' => true
		])
	</form>
</div>
@section('scripts')
<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
	var curso = $('#matricula-curso');
	var seccion = $('#matricula-seccion');
	var seccionSelect = $('#matricula-seccion-select');
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
</script>
	
@endsection
<script>

</script>
@endsection