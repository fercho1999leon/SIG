@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('representantes') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
		<div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Crear nuevo Representante</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="/FichasPersonales/administrativos/crear" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" value="Representante" name="tipo_usuario">
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
@endsection
@section('scripts')
<script>
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
@endsection

