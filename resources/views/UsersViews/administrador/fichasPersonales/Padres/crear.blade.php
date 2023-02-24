@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('padres') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Creación De Fichas Personales Padre / Madre:</h2>
		    </div>
		</div>
		<div class="wrapper wrapper-content">
	        <form method="post" action="{{ route('padresCrearStore') }}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				@include('partials.fichas.fichasPadresFormulario', ['btn' => 'CREAR'])
			</form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
	// Mostrando el formulario para crear el padre
	$('#representante').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilRepresentante').css('display', 'grid')
		}
		$('#creacionPerfilRepresentante').css('display', 'none')
	})
</script>
@endsection

