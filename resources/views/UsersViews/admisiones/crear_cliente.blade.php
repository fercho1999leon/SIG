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
		        <h2 class="title-page">Creación Cliente:</h2>
		    <div class="wrapper wrapper-content">
			<form method="post" action="{{ route('cliente.store') }}" enctype="multipart/form-data">
				<input type="hidden" name="id_estudiante" value="{{$estudiante->id}}">
				{{ csrf_field() }}
				@include('partials.fichas.formularioCliente', ['btn' => 'Crear Cliente'])
			</form>
        </div>
    </div>
<script src="{{ secure_asset('js/theme-js.js') }}"></script>
<script type="text/javascript">
	// Mostrando el formulario para crear el padre
	$('#padre').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilPadre').css('display', 'grid')
		}
		$('#creacionPerfilPadre').css('display', 'none')
	})
</script>

