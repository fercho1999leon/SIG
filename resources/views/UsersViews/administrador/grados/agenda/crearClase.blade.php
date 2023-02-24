@extends('layouts.master2') 
@section('content')
<a class="button-br" href=" {{route('ver_CursoAgenda', [
		'id' => $matter->idCurso, 'fecha='.request('fecha')
	])}} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	<!-- Incluir el nav_bar_top Cerrar Sesion -->
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 seleccion-curso">
			<h2 class="title-page">AGENDA ESCOLAR</h2>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a href="{{ route('ver_CursoAgenda',['id' => $course->id, 'fecha='.request('fecha')])}}""> {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a class="no-pointer"> crear </a>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="pined-table-responsive">
					<form method="post" action="{{ route('storeClaseAdministrador', $matter->id) }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@include('partials._formularioActividad', [
							'btn' => 'Guardar'
						])
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection 