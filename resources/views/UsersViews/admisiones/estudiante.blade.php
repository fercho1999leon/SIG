@extends('UsersViews.admisiones.style')
<a class="button-br" href="{{route('admision_datos', $data->ci)}}">
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
		        <h2 class="title-page">Editar Estudiante:</h2>
			<div class="wrapper wrapper-content">
			<form method="post" action="{{route('updateEstudiante',$data->id)}}">
				<input type="hidden" value="{{$data->id}}" name="id_estudiante">
				<input type="hidden" value="{{$institution->id}}" name="id_cliente">
				<input name="_method" type="hidden" value="PUT">
				{{ csrf_field() }}
				<div class="panel pl-8 pr-8 matricula__matriculacion">
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DATOS BÁSICOS</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Cédula/Pasaporte<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="ci" minlength="10" maxlength="10" placeholder="Ingrese los 10 digitos de la cédula" value="{{old('ci', $data->ci)}}" required>
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nombres <span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="100" placeholder="Nombres del estudiante" value="{{old('nombres', $data->nombres)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Apellidos<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="apellidos" minlength="2" maxlength="100" placeholder="Apellidos del Estudiante" value="{{old('apellidos', $data->apellidos)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo" required>
					<option value="Masculino" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Masculino</option>
					<option value="Femenino" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Femenino</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de nacimiento<span class="valorError">*</span></label>
				<input type="date" class="form-control input-sm" name="fechaNacimiento" value="{{old('fechaNacimiento', $data->fechaNacimiento)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Celular</label>
				<input type="text" class="form-control input-sm" name="celular_estudiante" placeholder="Celular del estudiante" value="{{old('celular_estudiante', $dataProfile->celular)}}">
			</div>

				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Correo</label>
					<input type="email" class="form-control input-sm" name="correo" placeholder="Correo del estudiante" value="{{old('correo', $data->profile->correo)}}" readonly="readonly">
				</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Con quien vive</label>
				<input type="text" class="form-control input-sm" name="con_quien_vive" placeholder="" value="{{old('con_quien_vive', $dataProfile->con_quien_vive)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Disciplina o deporte que practica</label>
				<input type="text" class="form-control input-sm" name="disciplina_practica" placeholder="" value="{{old('disciplina_practica', $dataProfile->disciplina_practica)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Actividad artística que practica:</label>
				<input type="text" class="form-control input-sm" name="actividad_artistica" placeholder="" value="{{old('actividad_artistica', $dataProfile->actividad_artistica)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DIRECCIÓN DOMICILIO</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad de domicilio<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="ciudad" minlength="3" maxlength="100" placeholder="Ciudad de residencia del estudiante" value="{{old('ciudad', $dataProfile->ciudad_domicilio)}}" required>
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Dirección Domicilio<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="direccion" minlength="5" maxlength="100" placeholder="Direccion del domicilio del estudiante" value="{{old('direccion', $dataProfile->direccion_domicilio)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Domicilio Telefono</label>
				<input type="text" class="form-control input-sm" name="telefono" minlength="8" maxlength="10" placeholder="Teléfonos de la residencia o movil del estudiante" value="{{old('telefono', $dataProfile->telefono_movil)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo de vivienda</label>
				<input type="text" class="form-control input-sm" name="tipoVivienda" minlength="3" maxlength="100" placeholder="Tipo de vivienda que reside el estudiante" value="{{old('tipoVivienda', $dataProfile->tipo_vivienda)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">NACIONALIDAD</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nacionalidad</label>
				<input type="text" class="form-control input-sm" name="nacionalidad" placeholder="Tipo de nacionalidad" value="{{old('nacionalidad', $dataProfile->nacionalidad)}}">
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Lugar de Nacimiento</label>
				<input type="text" class="form-control input-sm" name="lugarNacimiento" minlength="3" maxlength="100" placeholder="Lugar de nacimiento del estudiante" value="{{old('lugarNacimiento', $data->lugarNacimiento)}}">
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Provincia</label>
				<input type="text" class="form-control input-sm" name="provincia" placeholder="Provincia" value="{{old('provincia', $data->provincia)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Canton/Ciudad</label>
				<input type="text" class="form-control input-sm" name="canton" placeholder="Canton" value="{{old('canton', $data->canton)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parroquia</label>
				<input type="text" class="form-control input-sm" name="parroquia" placeholder="Parroquia" value="{{old('parroquia', $data->parroquia)}}">
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de ingreso al País</label>
				<input type="date" class="form-control input-sm" name="fecha_ingreso_pais" value="{{old('fecha_ingreso_pais', $dataProfile->fecha_ingreso_pais)}}">
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de expiración pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_expiracion_pasaporte" value="{{old('fecha_expiracion_pasaporte', $dataProfile->fecha_expiracion_pasaporte)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de caducidad pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_caducidad_pasaporte" value="{{old('fecha_caducidad_pasaporte', $dataProfile->fecha_caducidad_pasaporte)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DATOS MÉDICOS</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Clínica / Hosp. de preferencia</label>
				<input type="text" class="form-control input-sm" name="clinica" placeholder="Clinica/Hospital de preferencia para el estudiante" value="{{old('clinica', $dataProfile->hospital)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo de sangre</label>
				<input type="text" class="form-control input-sm" name="tipoSangre" placeholder="Tipo de sangre del estudiante" value="{{old('tipoSangre', $data->tipoSangre)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Indicaciones</label>
				<input type="text" class="form-control input-sm" name="indicaciones" placeholder="Alguna indicación médica" value="{{old('indicaciones', $dataProfile->indicaciones)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Alergia</label>
				<input type="text" class="form-control input-sm" name="alergias" placeholder="Alergia que posee el estudiante" value="{{old('alergias', $dataProfile->alergias)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Enfermedad</label>
				<input type="text" class="form-control input-sm" name="enfermedad" placeholder="Algún tipo de enfermedad que posee el estudiante" value="{{old('enfermedad', $dataProfile->enfermedad)}}">
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Inclusión</label>
 				<div class="matricula__radio-botones">
					<div class="flex items-center">
						<label for="inclusion_si">
							Si
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="inclusion" id="inclusion_si" value="Si"
								{{$dataProfile->inclusion == 1 ? 'checked' : ''}}
							>
					</div>
					<div class="flex items-center matricula__radio-div">
						<label for="inclusion_no">
							No
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="inclusion" id="inclusion_no" value="No"
								@if ($dataProfile->inclusion != null)
									{{$dataProfile->inclusion == 0 ? 'checked' : ''}}
								@else
									checked
								@endif
							>
					</div>
				</div>
			</div>
			<div id="inclusion_div_vacio" style="{{$dataProfile->inclusion == 1 ? 'display:none' : ''}}"></div>
			<div class="matricula__matriculacion__input"  id="tipo_carnet_inclusion" style="{{$dataProfile->inclusion == 0 ? 'display:none' : ''}}">
				<label for="" class="matricula__matriculacion-label">Numero de carnet</label>
				<input type="text" class="form-control input-sm" name="numero_carnet" placeholder="Ingrese la identificación del carnet" value="{{old('numero_carnet', $dataProfile->numero_carnet)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Discapacidad</label>
				<select name="discapacidad" class="form-control input-sm" onchange="functionDiscapacidad2(this.value)">
					<option value="">Ninguna</option>
					<option {{$dataProfile->discapacidad === 'Sensorial' ? 'selected' : ''}} value="Sensorial">Sensorial</option>
					<option {{$dataProfile->discapacidad === 'Motor A' ? 'selected' : ''}} value="Motor A">Motor A</option>
					<option {{$dataProfile->discapacidad === 'Intelectual' ? 'selected' : ''}} value="Intelectual">Intelectual</option>
					<option {{$dataProfile->discapacidad === 'Otras' ? 'selected' : ''}} value="Otras">Otras</option>
				</select>
			</div>
			<div id="discapacidad_div_vacio" style="{{$dataProfile->discapacidad == '' ? 'display:inline-block' : 'display:none'}}"></div>
			<div class="matricula__matriculacion__input" id="block__porcentaje" style="{{$dataProfile->discapacidad != '' ? 'display:inline-block' : 'display:none'}}">
				<label for="" class="matricula__matriculacion-label">Porcentaje de la discapacidad</label>
				<div class="porcentaje_discapacidad">
					<input type="text" class="form-control input-sm" name="porcentaje_discapacidad" value="{{old('porcentaje_discapacidad', $dataProfile->porcentaje_discapacidad)}}">
					<p class="porcentaje_discapacidad__porcentaje">%</p>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">MOVILIZACIÓN</h3>
		<div>
			<div>
				<div class="matricula__movilizacion-item">
					<label for="se_va_solo" class="cursor-pointer mb-0 mr-6">¿Se va solo? </label>
					<input style="margin: 0 !important" id="se_va_solo" type="checkbox" name="se_va_solo" {{$dataProfile->se_va_solo === 1 ? 'checked' : ''}}>
				</div>
			</div>
			<div></div>
		</div>
	</div>
	-->
	<!--
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">REPRESENTANTE</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Representante</label>
				<select class="form-control js-example-basic-single" name="idRepresentante" class="form-control">
					<option value="">Ninguno</option>
					@foreach($users->where('cargo', 'Representante') as $user)
						<option value="{{ $user->id }}"
							{{ $dataProfile->idRepresentante == $user->id ? ' selected' : '' }}>
							{{ $user->apellidos}} {{ $user->nombres}}
						</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>-->
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DATOS PADRES</h3>
		<div>
			<!--<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Padre</label>
				<select class="js-example-basic-single form-control input-sm" name="idPadre">
					<option value="">Ninguno</option>
					@foreach($padres as $father)
						<option value="{{ $father->id}}"{{ ($father->id == $data->idPadre ) ? ' selected' : '' }}>{{ $father->apellidos}} {{ $father->nombres}} </option>
					@endforeach
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Madre</label>
				<select class="js-example-basic-single form-control input-sm" name="idMadre">
					<option value="">Ninguno</option>
					@foreach($madres as $mother)
						<option value="{{ $mother->id}}" {{ ($mother->id == $data->idMadre ) ? ' selected' : '' }}>{{ $mother->apellidos}} {{ $mother->nombres}}</option>
					@endforeach
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Estado Civil Padres</label>
				<select name="estado_civil_padres" class="form-control input-sm">
					<option value="">Escoja una opción...</option>
					<option {{$dataProfile->estado_civil_padres == 'Casados' ? ' selected' : ''}} value="Casados">Casados</option>
					<option {{$dataProfile->estado_civil_padres == 'Divorciados' ? ' selected' : ''}} value="Divorciados">Divorciados</option>
					<option {{$dataProfile->estado_civil_padres == 'Separados' ? ' selected' : ''}} value="Separados">Separados</option>
					<option {{$dataProfile->estado_civil_padres == 'Union Libre' ? ' selected' : ''}} value="Union Libre">Unión Libre</option>
					<option {{$dataProfile->estado_civil_padres == 'Otros' ? ' selected' : ''}} value="Otros">Otros</option>
				</select>
			</div>
			<div></div>-->
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ingreso Familiar</label>
				<input type="text" class="form-control input-sm" name="ingreso_familiar" placeholder="Aproximación de la cantidad que gana la Familia" value="{{old('ingreso_familiar', $dataProfile->ingreso_familiar)}}">
			</div>
			</div>
		</div>
		<!--	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">REPRESENTANTE FINANCIERO</h3>
		<div>
			<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Representante Financiero</label>
					<select name="idCliente" class="form-control js-example-basic-single">
						<option value="">Escoja un cliente...</option>
						@foreach($clients as $client)
							<option {{$dataProfile->idCliente == $client->id ? 'selected' : ''}} value="{{$client->id}}">{{$client->apellidos}} {{$client->nombres}}</option>
						@endforeach
					</select>

			</div>

			</div>-->
		</div>
		<div class="text-right">
				<button type="submit" class="mb-1 btn btn-primary btn-lg">Actualizar Estudiante</button>
		</div>
	</div>
</div>

			</form>
        </div>
       </div>
	</div>
</div>
</div>
<script src="{{ secure_asset('js/theme-js.js') }}"></script>
<script type="text/javascript">
function functionDiscapacidad2(value) {
		if (value != '') {
			document.getElementById('block__porcentaje').style.display = 'inline-block';
			document.getElementById('discapacidad_div_vacio').style.display = 'none';
		} else {
			document.getElementById('block__porcentaje').style.display = 'none';
			document.getElementById('discapacidad_div_vacio').style.display = 'inline-block';
		}
	}
</script>

