@php
	$rol = Sentinel::getUser()->roles()->first()->name;
	$user_data = session('user_data');
	$permiso = App\Permiso::desbloqueo('home');
	if($rol == 'Estudiante'){
		$student2 = App\Student2::where('idProfile', $user_data->id)->first()->profilePerYear()->first();
        //dd($student2);
	}
@endphp
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
			<div class="widget widget-tabs">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#tab-1">GENERAL</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-2">DOMICILIO</a>
						</li>
                        @if($rol == 'Representante')
							<li>
								<a data-toggle="tab" href="#tab-4">MÉDICA</a>
							</li>
                        @endif
							<li>
                                <a data-toggle="tab" href="#tab-eb2">CORREO DE ACCESO</a>
                            </li>
					</ul>
					<div class="tab-content">
						<div id="tab-1" class="tab-pane active">
							{!! Form::open(array('route' => 'editUserGeneralData')) !!}
							<div class="grid-form">
								<p class="grid-form-p no-margin">Nombres:</p>
								<input class="form-control input-sm " name="nombres" value="{{ $user_data->nombres }}" type='text' disabled>
								<input class="form-control input-sm " style="display: none;" name="nombres" value="{{ $user_data->nombres }}" type='text'> 
								<p class="grid-form-p no-margin">Apellidos:</p>
								<input class="form-control input-sm" name="apellidos" value="{{ $user_data->apellidos }}" type='text' disabled>
								<input class="form-control input-sm" style="display: none;" name="apellidos" value="{{ $user_data->apellidos }}" type='text'>
								<p class="grid-form-p no-margin">C.I:</p>
								<input class="form-control input-sm" name="ci" value="{{ $user_data->ci }}" type='text' disabled>
								<input class="form-control input-sm" style="display: none;" name="ci" value="{{ $user_data->ci }}" type='text'>
								<p class="grid-form-p no-margin">Correo:</p>
								<input class="form-control input-sm" name="correo" value="{{$user_data->correo}}" type='text' disabled>
								<input class="form-control input-sm" style="display: none;" name="correo" value="{{$user_data->correo}}" type='text'>
								<p class="grid-form-p no-margin">Teléfono móvil:</p>
								<input class="form-control input-sm" name="movil" value="{{$rol == 'Estudiante' ? $student2->celular : $user_data->movil}}" type='text' disabled>
								<input class="form-control input-sm" style="display: none;" name="movil" value="{{$rol == 'Estudiante' ? $student2->celular : $user_data->movil}}" type='text'>
							</div>
						</div>
						<div id="tab-2" class="tab-pane">
							<div class="grid-form">
								<p class="grid-form-p no-margin">Dirección:</p>
								<input class="form-control input-sm" name="dDomicilio" value="{{$rol == 'Estudiante' ? $student2->direccion_domicilio : $user_data->dDomicilio}}" type='text'>
								<p class="grid-form-p no-margin">Teléfono domicilio:</p>
								<input class="form-control input-sm" name="tDomicilio" value="{{$rol == 'Estudiante' ? $student2->student()->first()->telefono : $user_data->tDomicilio }}" type='text'>
							</div>
						</div>
						@if(($rol == 'Representante'))
							<div id="tab-4" class="tab-pane">
								<div class="grid-form">
									<p class="grid-form-p no-margin">Teléfono de emergencia:</p>
									<input type="text" name="numero_emergencia" class="form-control" value="{{$user_data->numero_emergencia}}">
								</div>
							</div>
                            <div id="tab-eb2" class="tab-pane">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="panel panel-default p-1">
                                        <div class="r-configuraciones-container">
                                            <h2 class="text-center text-color7 uppercase">Datos de Acceso</h2>
                                            <label for="nombre">Correo</label>
                                            <input type="email" name="email" class="form-control mb-1" value="{{$user_data->correo}}">
                                            <label for="contraseña">Password</label>
                                            <div class="mostrarContraseña">
                                                <input type="password" class="form-control " name="password">
                                                <a>
                                                    <div class="eye-slash"></div>
                                                    <img src="{{secure_asset('img/eye.svg')}}" width="25">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
							<div id="tab-eb2" class="tab-pane">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="panel panel-default p-1">
                                        <div class="r-configuraciones-container">
                                            <h2 class="text-center text-color7 uppercase">Datos de Acceso
                                            </h2>
                                            <label for="nombre">Correo</label>
                                            <input type="email" name="email" class="form-control mb-1" value="{{$user_data->correo}}" disabled>
											<input type="email" name="email" class="form-control mb-1" style="display: none;" value="{{$user_data->correo}}">
                                            <label for="contraseña">Password</label>
                                            <div class="mostrarContraseña">
                                                <input type="password" class="form-control " name="password" >
                                                <a>
                                                    <div class="eye-slash"></div>
                                                    <img src="{{secure_asset('img/eye.svg')}}" width="25">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div id="tab-3" class="tab-pane">
								<div class="grid-form">
									<p class="no-margin grid-form-p">Teléfono de emergencia:</p>
									<input class="form-control input-sm" name="numero_emergencia" value="{{ $user_data->numero_emergencia }}" type='text'>
									<p class="no-margin grid-form-p">Enfermedad que padece:</p>
									<input class="form-control input-sm" name="enfermedad" value="{{ $user_data->enfermedad }}" type='text'>
									<p class="no-margin grid-form-p">Observación:</p>
									<input class="form-control input-sm" name="observacion" value="{{ $user_data->observacion }}" type='text'>
									<p class="no-margin grid-form-p">Grupo Sanguíneo:</p>
									{!! Form::select('grupo_sanguineo', ['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'], $user_data->grupo_sanguineo) !!}
								</div>
							</div>
						@endif
					</div>
                    @if($permiso == null || ($permiso != null && $permiso->editar == 1))
					<div class="text-left mt-1">
						<input type="submit" value="Guardar" class="btn btn-success">
					</div>
                    @endif
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="col-lg-2"></div>
	</div>
</div>
<script>
	const inputPass = document.querySelector('.mostrarContraseña input')
	const a = document.querySelector('.mostrarContraseña a');
	const passEye = document.querySelector('.eye-slash');

	a.addEventListener('click', function () {
		if (inputPass.type === "password") {
			inputPass.type = 'text';
			passEye.style.opacity = 1;
		} else {
			passEye.style.opacity = 0;
			inputPass.type = 'password';
		}
	})
</script>