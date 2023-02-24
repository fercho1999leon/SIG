@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{route('transporte')}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Transporte <small>Editar Ruta</small></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 mt-1">
			<div class="panel pl-1 pr-1 matricula__matriculacion">
				<form action="{{route('transporte-update', $transporte->id)}}" method="post">
					{{ method_field('PUT') }}
					@include('partials.transporte.transporte-formulario', [
						'button' => 'ACTUALIZAR TRANSPORTE'
					])
				</form>
			</div>
		</div>
	</div>
</div>
@endsection