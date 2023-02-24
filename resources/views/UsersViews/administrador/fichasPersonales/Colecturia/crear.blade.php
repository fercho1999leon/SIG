@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('colecturia.index')}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Crear nuevo usuario en Colecturía</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="wrapper wrapper-content">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="row">
				<form action="{{route('colecturia.store')}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" name="perfil" value="Colecturia">
					@include('partials.fichas.formularioColecturia', [
						'edit' => false,
						'numero_caja' => true,
						'btn' => 'Colecturía'
					])
				</form>
			</div>
		</div>
    </div>
@endsection

