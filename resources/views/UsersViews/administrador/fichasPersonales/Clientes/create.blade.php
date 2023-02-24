@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('clients.index')}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Creación Cliente:</h2>
		    </div>
		</div>
		<div class="wrapper wrapper-content">
			<form method="post" action="{{ route('clients.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				@include('partials.fichas.formularioCliente', ['btn' => 'Crear Cliente'])
			</form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
	// Mostrando el formulario para crear el cliente
	$('#representante').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilRepresentante').css('display', 'grid')
		}
		$('#creacionPerfilRepresentante').css('display', 'none')
	})

	// Mostrando el formulario para crear el padre
	$('#padre').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilPadre').css('display', 'grid')
		}
		$('#creacionPerfilPadre').css('display', 'none')
	})
</script>
@endsection

