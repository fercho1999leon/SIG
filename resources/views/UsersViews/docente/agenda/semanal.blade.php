@extends('layouts.master2') 
@section('content')
@php
	$user = Sentinel::getUser();
	$tutor = App\Administrative::where(['userid' => $user->id, 'cargo' => 'Docente'])->first();
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
	<!-- Incluir el nav_bar_top Cerrar Sesion -->
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">AGENDA</h2>
			<div class="lg:flex">
				<a href="{{route('agenda_Docente', 'fecha='.request('fecha'))}}" class="btn btn-black sm:mb-0 lg:mt-0 lg:ml-2 w-48">Diario</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 mt-2">
			@include('partials.agenda._semanal', [
				'admin' => true,
				'perfil' => 'docente'
			])
		</div>
	</div>
</div>
@endsection 

