<div class="">
	<div class="matricula__matriculacion-block">
	<h3 class="matricula__matriculacion-title">DATOS BÁSICOS</h3>
	</div>
	<div > 
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo Identificación<span class="valorError">*</span></label>
				<select class="form-control" name="ci" id="ci" onchange="ShowSelected();" required>
					<option > Seleccione</option>
					<option value="1" {{($data->identificacion) == 1 ? 'selected' : ''}}>Cédula</option>
					<option value="2" {{($data->identificacion) == 2 ? 'selected' : ''}}>Pasaporte</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label" id="cedula_pasaporte">Cédula/Pasaporte<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="n_identificacion" minlength="9" maxlength="10" placeholder="Ingrese los 10 dígitos de la cédula" value="{{old('ci', $data->ci)}}" required>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nombres <span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="100" placeholder="Nombres del estudiante" value="{{old('nombres', $data->nombres)}}" >
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Apellidos<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="apellidos" minlength="2" maxlength="100" placeholder="Apellidos del Estudiante" value="{{old('apellidos', $data->apellidos)}}" >
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo" id="sexo" required>
					<option > Seleccione</option>
					<option value="1" {{$dataProfile->sexo == '1' ? 'selected' : ''}}>Hombre</option>
					<option value="2" {{$dataProfile->sexo == '2' ? 'selected' : ''}}>Mujer</option>
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Género</label>
				<select class="form-control input-sm" name="genero" id="genero" required>
					<option > Seleccione</option>
					<option value="1" {{$dataProfile->genero == '1' ? 'selected' : ''}}>Masculino</option>
					<option value="2" {{$dataProfile->genero == '2' ? 'selected' : ''}}>Femenino</option>
				</select>
			</div>
			
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de nacimiento<span class="valorError">*</span></label>
				<input type="date" class="form-control input-sm" name="fechaNacimiento" value="{{old('fechaNacimiento', $data->fechaNacimiento)}}" required>
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Celular</label>
				<input type="text" class="form-control input-sm" name="celular_estudiante" placeholder="Celular del estudiante" value="{{old('celular_estudiante', $dataProfile->celular)}}">	
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Estado Civil</label>
				<select class="form-control input-sm" name="Estado_Civil" >
					<option > Seleccione</option>
					<option value="1" {{$dataProfile->genero == '1' ? 'selected' : ''}}>Soltero/a</option>
					<option value="2" {{$dataProfile->genero == '2' ? 'selected' : ''}}>Casado/a</option>
					<option value="3" {{$dataProfile->genero == '3' ? 'selected' : ''}}>Divorciado/a</option>
					<option value="4" {{$dataProfile->genero == '4' ? 'selected' : ''}}>Unión Libre</option>
					<option value="5" {{$dataProfile->genero == '5' ? 'selected' : ''}}>Viudo/a</option>
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">correo del estudiante</label>
				<input type="text" class="form-control input-sm" name="correoElectronico" placeholder="Correo" value="">
			</div>
	
		</div>
		
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">NACIONALIDAD</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">País Nacimiento</label>
				<select class="form-control input-sm" name="pais" id="pais_nacimiento">
					<option value=""> Seleccione </option>
					@foreach ($paises as $item)
					<option value="{{$item->id}}" {{$data->nacionalidad == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Etnia Estudiante</label>
				<select class="form-control input-sm" name="Etnia_Estudiante" id="Etnia_Estudiante">
					<option value="default"> Seleccione </option>
					<option value="1" {{$dataProfile->Etnia_estudiante == '1' ? 'selected' : ''}}>Indígena</option>
					<option value="2" {{$dataProfile->Etnia_estudiante == '2' ? 'selected' : ''}}>Afroecuatoriano</option>
					<option value="3" {{$dataProfile->Etnia_estudiante == '3' ? 'selected' : ''}}>Negro</option>
					<option value="4" {{$dataProfile->Etnia_estudiante == '4' ? 'selected' : ''}}>Mulato</option>
					<option value="5" {{$dataProfile->Etnia_estudiante == '5' ? 'selected' : ''}}>Montuvio</option>
					<option value="6" {{$dataProfile->Etnia_estudiante == '6' ? 'selected' : ''}}>Mestizo</option>
					<option value="7" {{$dataProfile->Etnia_estudiante == '7' ? 'selected' : ''}}>Blanco</option>
					<option value="8" {{$dataProfile->Etnia_estudiante == '8' ? 'selected' : ''}}>Otro</option>
					<option value="9" {{$dataProfile->Etnia_estudiante == '9' ? 'selected' : ''}}>No registra</option>
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Pueblo Y Nacionalidad</label>
				<select class="form-control input-sm" name="pueblo_nacionalidad" id="pueblo_nacionalidad">
					<option value=""> Seleccione </option>
					@foreach ($pueblos_nacionalidades as $item)
					<option value="{{$item->id}}" {{$dataProfile->pueblo_nacionalidad == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de ingreso al País</label>
				<input type="date" class="form-control input-sm" name="fecha_ingreso_pais" id="fecha_ingreso_pais" value="{{old('fecha_ingreso_pais', $dataProfile->fecha_ingreso_pais)}}">
				<input type="hidden" name="fecha_ingreso_pais2" id="fecha_ingreso_pais2" value="NA">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de expiración pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_expiracion_pasaporte" id="fecha_expiracion_pasaporteDT" value="{{old('fecha_expiracion_pasaporte', $dataProfile->fecha_expiracion_pasaporte)}}">
				<input type="hidden" name="fecha_ingreso_pais2" id="fecha_expiracion_pasaporte" value="NA">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de caducidad pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_caducidad_pasaporte" id="fecha_caducidad_pasaporteDT" value="{{old('fecha_caducidad_pasaporte', $dataProfile->fecha_caducidad_pasaporte)}}">
				<input type="hidden" name="fecha_ingreso_pais2" id="fecha_caducidad_pasaporte" value="NA">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Provincia de Nacimiento</label>
				<select class="form-control input-sm" name="provincia_nacimiento" id="provincia_nacimiento">
					<option value=""> Seleccione </option>
					@foreach ($provincias as $item)
					<option value="{{$item->id}}" {{$dataProfile->provincia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Cantón de Nacimiento</label>
				<select class="form-control input-sm" name="canton_nacimiento" id="canton_nacimiento">
					<option value=""> Seleccione </option>
					@foreach ($cantones as $item)
					<option value="{{$item->id}}" {{$dataProfile->canton == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				
			</div>
		</div>

		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INFORMACIÓN DE RESIDENCIA</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">País Residencia</label>
				<select class="form-control input-sm" name="pais_recidencia" id="pais_recidencia">
					<option value=""> Seleccione </option>
					@foreach ($paises as $item)
					<option value="{{$item->id}}" {{$dataProfile->pais_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Provincia de Residencia</label>
				<select class="form-control input-sm" name="provincia_recidencia" id="provincia_recidencia">
					<option value=""> Seleccione </option>
					@foreach ($provincias as $item)
					<option value="{{$item->id}}" {{$dataProfile->provincia_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Canton de Residencia</label>
				<select class="form-control input-sm" name="canton_recidencia" id="canton_recidencia">
					<option value=""> Seleccione </option>
					@foreach ($cantones as $item)
					<option value="{{$item->id}}" {{$dataProfile->canton_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad de Residencia<span class="valorError">*</span></label>
					<input type="text" class="form-control input-sm" name="ciudad"  maxlength="100" placeholder="Ciudad de Recidencia del estudiante" value="{{old('direccion', $dataProfile->ciudad_domicilio)}}" required>
			</div>
			<div class="col-lg-12 matricula__matriculacion__input">
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Dirección Domicilio<span class="valorError">*</span></label>
					<input type="text" class="form-control input-sm" name="direccion"  maxlength="100" placeholder="Dirección del domicilio del estudiante" value="{{old('direccion', $dataProfile->direccion_domicilio)}}" required>
			</div>
			</div>
		</div>	
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INFORMACIÓN DE ACADÉMICA</h3>
		</div>
		<div class="row">

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo De Colegio</label>
				<select class="form-control input-sm" name="tipoColegioId" required>
					<option default>Seleccione</option>
					<option value='1' {{$data->tipoColegioId == '1' ? 'selected' : ''}}>Fiscal</option>
					<option value='2' {{$data->tipoColegioId == '2' ? 'selected' : ''}}>Fiscomisional</option>
					<option value='3' {{$data->tipoColegioId == '3' ? 'selected' : ''}}>Particular</option>
					<option value='4' {{$data->tipoColegioId == '4' ? 'selected' : ''}}>Auditiva</option>
					<option value='5' {{$data->tipoColegioId == '5' ? 'selected' : ''}}>Municipal</option>
					<option value='6' {{$data->tipoColegioId == '6' ? 'selected' : ''}}>Extranjero</option>
					<option value='7' {{$data->tipoColegioId == '7' ? 'selected' : ''}}>no Registra</option>
				</select>		
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Modalidad De La Carrera</label>
					<select class="form-control input-sm" name="modalidadCarrera" required>
						<option default>Seleccione</option>
						<option value='1' {{$data->modalidadCarrera == '1' ? 'selected' : ''}}>Presencial</option>
						<option value='2' {{$data->modalidadCarrera == '2' ? 'selected' : ''}}>Semi-Presencial</option>
						<option value='3' {{$data->modalidadCarrera == '3' ? 'selected' : ''}}>Distancia</option>
						<option value='4' {{$data->modalidadCarrera == '4' ? 'selected' : ''}}>Dual</option>
					</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Jornada De La Carrera</label>
					<select class="form-control input-sm" name="jornadaCarrera" required>
						<option default>Seleccione</option>
						<option value='1' {{$data->jornadaCarrera == '1' ? 'selected' : ''}}>Matutina</option>
						<option value='2' {{$data->jornadaCarrera == '2' ? 'selected' : ''}}>Vespertina</option>
						<option value='3' {{$data->jornadaCarrera == '3' ? 'selected' : ''}}>Nocturna</option>
						<option value='4' {{$data->jornadaCarrera == '4' ? 'selected' : ''}}>Intensiva</option>
					</select>	
			</div>
			
			<div class="col-lg-3 matricula__matriculacion__input">
			
			</div>
			
		</div>	
		

        <div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">CONTACTOS DE EMERGENCIA</h3>
		</div>
		<div class="row">
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Primer Contacto Emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="contactoEmergencia" minlength="3" maxlength="100" placeholder="Nombres y Apellidos del contacto de emergencia" value="{{old('contactoEmergencia', $dataProfile->nombre_contacto_emergencia)}}">
			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono del contacto de emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="telefonoEmergencia" minlength="9" maxlength="10" placeholder="Teléfono del contacto para emergencias" value="{{old('telefonoEmergencia', $dataProfile->movil_contacto_emergencia)}}">
		
			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentesco<span class="valorError">*</span></label>
				<select class="form-control" name="parentezco_contacto_emergencia">
					<option value="">Seleccione un parentesco...</option>
					@foreach (config('pined.parentezcos') as $parentezco)
						<option {{old('parentezco_contacto_emergencia') == $parentezco ? 'selected' : ''}} {{$dataProfile->parentezco_contacto_emergencia == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach
					
				</select>
			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Segundo Contacto Emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="contactoEmergencia2" minlength="3" maxlength="100" placeholder="Nombres y Apellidos del contacto de emergencia" value="{{old('contactoEmergencia', $dataProfile->nombre_contacto_emergencia2)}}">
	
			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono del contacto de emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="telefonoEmergencia2" minlength="9" maxlength="10" placeholder="Teléfono del contacto para emergencias" value="{{old('telefonoEmergencia', $dataProfile->movil_contacto_emergencia2)}}">

			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentesco<span class="valorError">*</span></label>
				<select class="form-control" name="parentezco_contacto_emergencia2">
					<option value="">Seleccione un parentesco...</option>
					@foreach (config('pined.parentezcos') as $parentezco)
						<option {{old('parentezco_contacto_emergencia2') == $parentezco ? 'selected' : ''}} {{$dataProfile->parentezco_contacto_emergencia == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach
				</select>
		
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
			
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
			
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
			
			</div>
		</div>


        <div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INSTITUCIÓN ANTERIOR</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Institución Anterior</label>
				<input type="text" class="form-control input-sm" name="institucionAnterior" placeholder="Institución anterior, en caso de que exista" value="{{old('institucionAnterior', $data->institucionAnterior)}}">
	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Razones por el cambio</label>
				<input type="text" class="form-control input-sm" name="razon_Cambio" minlength="3" maxlength="250" placeholder="Razones de cambio, si existió" value="{{old('razonCambio', $data->razonCambio)}}">
	
			</div>
			<div class="col-lg-6 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Observaciones</label>
				<textarea class="form-control input-sm" name="observaciones" rows="4" cols="50">{{old('observaciones', $data->observaciones)}}</textarea>
	
			</div>
		</div>
	


		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">CARRERA A LA QUE POSTULA</h3>
		</div>
		<div class="row">
			
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Carrera<span class="valorError">*</span></label>
				<select class="form-control input-sm" name="curso" id="matricula-curso">
					@foreach($careers as $career)
						 	<option value="{{ $career ['id'] }}" {{ $dataProfile->idCurso == $career ['id'] ? 'selected' : '' }} >{{ $career ['nombre'] }}</option>
					@endforeach
				</select>
			</div>
            <div class="matricula__matriculacion__input" style="display:none">
				<label for="" class="matricula__matriculacion-label">Tipo de matricula</label>
				<select id="estado_matricula" class="form-control input-sm" name="matricula">
					@if ($dataProfile->tipo_matricula == 'Pre Matricula')
					<option value="Pre Matricula"
							{{ 'Pre Matricula' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Pre-Matricula</option>
					@endif 
					@if ($dataProfile->tipo_matricula == null)
						<option value="Pre Matricula"
								{{ 'Pre Matricula' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Pre-Matricula</option>
					@endif
				</select>
			</div>
            <div class="matricula__matriculacion__input">
				<!--<label for="" class="matricula__matriculacion-label">Curso<span class="valorError">*</span></label>-->
				<input type="hidden" class="form-control input-sm" name="seccion" value="EI">

				

				<select class="form-control input-sm" name="carrera" id="matricula-curso" style="display:none" >
					<option value="">Seleccionar...</option>
					<!--
					@foreach($courses->where('seccion', 'EI') as $course)
						<option data-seccion="{{ $course->seccion }}" value="{{ $course->id }}"  
							{{ $course->id == $dataProfile->idCurso ? ' selected' : '' }}>
							{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}
						</option>
					@endforeach
					
					@foreach($courses->where('seccion', 'EGB') as $course)
						<option data-seccion="{{ $course->seccion }}" value="{{ $course->id }}"  
							{{ $course->id == $dataProfile->idCurso ? ' selected' : '' }}>
							{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}
						</option>
					@endforeach
					@foreach($courses->where('seccion', 'BGU') as $course)
						<option data-seccion="{{ $course->seccion }}" value="{{ $course->id }}"  
							{{ $course->id == $dataProfile->idCurso ? ' selected' : '' }}>
							{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}
						</option>
					@endforeach
					-->
				
					

				</select>
			</div>
		</div>
	</div>

</div>
	
<script>
    /*Funcion para cambiar el label de cedula y pasaporte*/
function ShowSelected() { /* Para obtener el valor */
    var cod = document.getElementById("ci").value;
    var txt = document.getElementById("cedula_pasaporte").value;  
    /* Para obtener el texto */
    var combo = document.getElementById("ci");
    if(combo.options[combo.selectedIndex].value == 1){
        document.getElementById('cedula_pasaporte').innerText = "Cedula *";
    }else if(combo.options[combo.selectedIndex].value == 2){
        document.getElementById('cedula_pasaporte').innerText = "Pasaporte *";
    }else{
        document.getElementById('cedula_pasaporte').innerText = "Cedula / Pasaporte *";
    }
}
/*Funcionalidad para cambiar el geenera al seleccionar un sexo*/
document.getElementById("sexo").addEventListener("change", () => {
document.getElementById("genero").selectedIndex = document.getElementById("sexo").selectedIndex;});

    /*Funcion al escoger el pueblo y nacinalidad*/
    $(document).ready(function() {
$('#Etnia_Estudiante').change(function(e) {
    if ($(this).val() == "1") {
        $('#pueblo_nacionalidad option[value=""]').attr("selected",true);
    }else{
        $('#pueblo_nacionalidad option[value=34]').attr("selected",true);
        
    }
})
});

/*Desabilitadar los campos al seleccionar NO tiene discapacidad */
$(document).ready(function() {
$('#tiene_discapacidad').change(function(e) {
    if ($(this).val() === "1") {
        $('#Carnet_CONADIS').prop("disabled", false);
        $('#porcentaje_discapacidad').prop("disabled", false);
        $('#Tipo_discapacidad').prop("disabled", false);
        $('#Tipo_discapacidad option[value=""]').attr("selected",true);
        $('#Tipo_enfermedad_catastrófica').prop("disabled", false);
        $('#Tipo_enfermedad_catastrófica option[value=""]').attr("selected",true);
        
    } else {
        $('#Carnet_CONADIS').prop("disabled", true).attr("value","NA");
        $('#porcentaje_discapacidad').prop("disabled", true).attr("value","NA");
        $('#Tipo_discapacidad option[value=7]').attr("selected",true);
        $('#Tipo_discapacidad ').prop("disabled", true);
        $('#Tipo_enfermedad_catastrófica option[value=6]').attr("selected",true);
        $('#Tipo_enfermedad_catastrófica ').prop("disabled", true);

        
    }
})
});

/*Desabilitadar los campos al seleccionar un pais diferente a Ecuador */
$(document).ready(function() {
$('#pais_nacimiento').change(function(e) {
    if ($(this).val() === "56") {
        $('#fecha_ingreso_pais').prop("disabled", true);
        $('#fecha_expiracion_pasaporteDT').prop("disabled", true);
        $('#fecha_caducidad_pasaporteDT').prop("disabled", true);
        $('#provincia_nacimiento').prop("disabled", false);
        $('#canton_nacimiento').prop("disabled", false);
        
        
    } else {
        $('#fecha_ingreso_pais').prop("disabled", false);
        $('#fecha_expiracion_pasaporteDT').prop("disabled", false);
        $('#fecha_caducidad_pasaporteDT').prop("disabled", false);
        $('#provincia_nacimiento').prop("disabled", true);
        $('#canton_nacimiento').prop("disabled", true);
        //$('#fecha_expiracion_pasaporte').prop("disabled", true).attr("value","NA");
    }
})
});


$(document).ready(function() {
$('#pais_recidencia').change(function(e) {
    if ($(this).val() === "56") {	
        $('#provincia_recidencia').prop("disabled", false);
        $('#canton_recidencia').prop("disabled", false);
        
        
    } else {
        $('#provincia_recidencia').prop("disabled", true);
        $('#canton_recidencia').prop("disabled", true);
        //$('#fecha_expiracion_pasaporte').prop("disabled", true).attr("value","NA");
    }
})
});
$(document).ready(function() {
$('#haRealizadoPracticasPreprofesionales').change(function(e) {
    if ($(this).val() === "1") {	
        $('#sectorEconomicoPracticaProfesional').prop("disabled", false);
        $('#nroHorasPracticasPreprofesionalesPorPeriodo').prop("disabled", false);
        $('#entornoInstitucionalPracticasProfesionales').prop("disabled", false);
        
        
    } else {
        $('#sectorEconomicoPracticaProfesional').prop("disabled", true);
        $('#nroHorasPracticasPreprofesionalesPorPeriodo').prop("disabled", true);
        $('#entornoInstitucionalPracticasProfesionales').prop("disabled", true);
    }
})
});

$(document).ready(function() {
$('#participaEnProyectoVinculacionSociedad').change(function(e) {
    if ($(this).val() === "1") {	
        $('#tipoAlcanceProyectoVinculacionId').prop("disabled", false);
                    
    } else {
        $('#tipoAlcanceProyectoVinculacionId').prop("disabled", true);
        
    }
})
});


$(document).ready(function() {
$('#tipoBecaId').change(function(e) {
    if ($(this).val() === "1" || $(this).val() === "2") {	
        $('#primeraRazonBecaId').prop("disabled", false);
        $('#segundaRazonBecaId').prop("disabled", false);
        $('#terceraRazonBecaId').prop("disabled", false);
        $('#cuartaRazonBecaId').prop("disabled", false);
        $('#quintaRazonBecaId').prop("disabled", false);
        $('#sextaRazonBecaId').prop("disabled", false);
        $('#porcientoBecaCoberturaArancel').prop("disabled", false);
        $('#porcientoBecaCoberturaManuntencion').prop("disabled", false);
        $('#financiamientoBeca').prop("disabled", false);
        $('#montoAyudaEconomica').prop("disabled", false);
        $('#montoCreditoEducativo').prop("disabled", false);
        
                    
    } else {
        $('#primeraRazonBecaId').prop("disabled", true).attr("value","2");
        $('#segundaRazonBecaId').prop("disabled", true).attr("value","2");
        $('#terceraRazonBecaId').prop("disabled", true).attr("value","2");
        $('#cuartaRazonBecaId').prop("disabled", true).attr("value","2");
        $('#quintaRazonBecaId').prop("disabled", true).attr("value","2");
        $('#sextaRazonBecaId').prop("disabled", true).attr("value","2");
        $('#porcientoBecaCoberturaArancel').prop("disabled", true).attr("value","NA");
        $('#porcientoBecaCoberturaManuntencion').prop("disabled", true).attr("value","NA");
        $('#financiamientoBeca').prop("disabled", true).attr("value","NA");
        $('#montoAyudaEconomica').prop("disabled", true).attr("value","NA");
        $('#montoCreditoEducativo').prop("disabled", true).attr("value","NA");
        
    }
})
});


var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var id_curso = urlParams.get('idCarrera');
var idCursoCombo = document.getElementById('matricula-curso').value;

document.ready = document.getElementById("matricula-curso").value = id_curso;



</script>