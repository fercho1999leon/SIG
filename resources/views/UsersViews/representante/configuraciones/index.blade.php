@extends('layouts.master')
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="panel panel-default p-1">
				<form action="">
					<div class="r-configuraciones-container">
						<h2 class="text-center text-color7 uppercase">Datos de Acceso <small class="r-configuraciones__student-name">Miguel Vinicio bonifaz Calderon</small> </h2>
						<label for="nombre">Correo</label>
						<input type="text" id="nombre" class="form-control mb-1">
						<label for="contraseña">Password</label>
						<div class="mostrarContraseña">
							<input clas type="password" id="contraseña" class="form-control">
							<a>
								<div class="eye-slash"></div>
								<img src="{{secure_asset('img/eye.svg')}}" width="25">
							</a>
						</div>
						<div class="text-center mt-1">
							<input value="Guardar" type="submit" class="btn btn-lg bg_color7 mb-1">
						</div>
				</form>
			</div>
		</div>
		</div>
	</div>
	<script>
		const inputPass = document.querySelector('.mostrarContraseña input')
		const a = document.querySelector('.mostrarContraseña a');
		const passEye = document.querySelector('.eye-slash'); 

		a.addEventListener('click', function() {
			if(inputPass.type === "password") {
				inputPass.type = 'text';
				passEye.style.opacity = 1;
			} else{
				passEye.style.opacity = 0;
				inputPass.type = 'password';
			}
		})

	</script>
@endsection