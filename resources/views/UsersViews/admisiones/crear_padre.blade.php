@extends('UsersViews.admisiones.style')
<a class="button-br" href="{{route('admision_datos', $estudiante->ci)}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
<div class="row wrapper white-bg ">
	@if (count($errors) > 0)
    <div class="alert alert-danger">
    	<p>Corrige los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<div class="container">
				<div class="row mt-5">
					<div class="col-md-12">
				@if($parentezco=='P')
		        <h2 class="title-page">Creación De Ficha Personal del Padre:</h2>
		        @elseif($parentezco=='M')
		        <h2 class="title-page">Creación De Ficha Personal de la Madre:</h2>
		        @else
		        <h2 class="title-page">Creación De Ficha Personal:</h2>
		        @endif
		    </div>
		</div>
		<div class="wrapper wrapper-content">
	        <form method="post" action="{{ route('padre.store') }}" enctype="multipart/form-data">
	        	<input type="hidden" name="id_estudiante" value="{{$estudiante->id}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				@include('partials.fichas.fichasPadresFormulario', ['btn' => 'CREAR'])
			</form>
        </div>
    </div>
    <script src="{{ secure_asset('js/theme-js.js') }}"></script>
    <script>
	// Mostrando el formulario para crear el padre
	$('#representante').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilRepresentante').css('display', 'grid')
		}
		$('#creacionPerfilRepresentante').css('display', 'none')
	})
</script>



		        