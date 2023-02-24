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
				<h2 class="title-page">Crear nuevo Representante</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{ route('representante.store') }}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" value="Representante" name="tipo_usuario">
					<input type="hidden" name="id_estudiante" value="{{$estudiante->id}}">
					<div class="panel p-4 matricula__matriculacion">
						@include('partials.fichas.fichaRepresentante')
						<div class="flex flex-col lg:flex-row lg:justify-between">
							<div>
								<div class="flex flex-column mt-4">
									<span class="text-xl mb-3 flex items-center" style="font-size:16px">
										<label class="font-light mb-0" for="financiero">¿Este usuario tambien es el representante financiero?</label>
										<input id="financiero" class="mt-0" type="checkbox" name="crearCliente" style="margin-left:5px">
									</span>
									<span class="text-xl mb-3 flex items-center" style="font-size:16px">
										<label class="font-light mb-0" for="padre">¿Este usuario tambien es el padre de familia?</label>
										<input id="padre" class="mt-0" type="checkbox" name="crearPadre" style="margin-left:5px">
									</span>
								</div>
							</div>
							<div>
								<div class="text-right">
									<button type="submit" class="mb-1 btn btn-primary btn-lg">Crear Representante</button>
								</div>
								<input type="hidden" value="Representante" name="cargo">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
    <script src="{{ secure_asset('js/theme-js.js') }}"></script>
<script>
$(document).ready(function() {
	$("#ocultar_admision").hide();//oculto valores de correo
	$("#ver_admision").show();//mostrar mensaje de Usuario y contraseña
	});
	// Mostrando el formulario para crear el cliente
	$('#financiero').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilCliente').css('display', 'grid')
		}
		$('#creacionPerfilCliente').css('display', 'none')
	})

	// Mostrando el formulario para crear el padre
	$('#padre').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilPadre').css('display', 'grid')
		}
		$('#creacionPerfilPadre').css('display', 'none')
	})
</script>

