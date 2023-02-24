@extends('layouts.master2') 
@section('content')
<a class="button-br" href="{{ route('grade_agenda') }}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	<!-- Incluir el nav_bar_top Cerrar Sesion -->
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">AGENDA ESCOLAR</h2>
			<div class="title-page lg:flex">
				<a class="btn btn-black mt-0 mb-0" href="{{route('ver_CursoAgenda', [$course->id, 'fecha='.request('fecha')])}}">Diario</a>
			</div>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a href=""> {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}  </a>
				</div>
			</div>
		</div>
	</div>
	@include('partials.agenda._semanal', [
		'admin' => true,
		'perfil' => ''
	])
@endsection 