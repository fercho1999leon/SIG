<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">Cliente</h4>
		</div>
		<div class="modal-body">
			<div class="representante__modalActividad">
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$data->ci}}
					<span>CI</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->nombres}}
						<span>Nombres</span>
					</div>
					<div>
						{{$data->apellidos}}
						<span>Apellidos</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->sexo}}
						<span>Sexo</span>
					</div>
					<div>
						{{$data->parentezco}}
						<span>Parentezco</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->fNacimiento}}
						<span>Fecha de nacimiento</span>
					</div>
					<div>
						{{$data->estado_civil}}
						<span>Estado civil</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->fallecido == 1 ? 'Si' : 'No'}}
						<span>Fallecido</span>
					</div>
					<div>
						{{$data->correo}}
						<span>Correo</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->movil}}
						<span>Telefono/Móvil</span>
					</div>
					<div>
						{{$data->bio}}
						<span>Biografía</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->autorizadoRetirarEstudiante == 1 ? 'Si' : 'No'}}
						<span>Autorizado para retirar estudiante</span>
					</div>
					<div>
						{{$data->religion}}
						<span>Religión</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->ciudadDomicilio}}
						<span>Ciudad Domicilio</span>
					</div>
					<div>
						{{$data->direccionDomicilio}}
						<span>Dirección Domicilio</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$data->telefonoDomicilio}}
					<span>Teléfono Domicilio</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->ciudadTrabajo}}
						<span>Ciudad Trabajo</span>
					</div>
					<div>
						{{$data->direccionTrabajo}}
						<span>Dirección Trabajo</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->telefonoTrabajo}}
						<span>Teléfono Trabajo</span>
					</div>
					<div>
						{{$data->cargoTrabajo}}
						<span>Cargo/Actividad</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->lugarTrabajo}}
						<span>Lugar Trabajo</span>
					</div>
					<div>
						{{$data->profesion}}
						<span>Profesión</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->ex_alumno == 1 ? 'Si' : 'No'}}
						<span>Ex Alumno</span>
					</div>
					<div>
						{{$data->fecha_promocion}}
						<span>Fecha de promoción</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->fecha_ingreso_pais}}
						<span>Fecha de ingreso al País</span>
					</div>
					<div>
						{{$data->fecha_expiracion_pasaporte}}
						<span>Fecha de expiración pasaporte</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$data->fecha_caducidad_pasaporte}}
					<span>Fecha de caducidad pasaporte</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->nacionalidad}}
						<span>Nacionalidad</span>
					</div>
					<div>
						{{$data->lugarNacimiento}}
						<span>Lugar de nacimiento</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->provincia}}
						<span>Provincia</span>
					</div>
					<div>
						{{$data->canton}}
						<span>Canton</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$data->parroquia}}
					<span>Parroquia</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$data->estudios}}
					<span>Estudios</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->clinica}}
						<span>Clínica</span>
					</div>
					<div>
						{{$data->indicaciones}}
						<span>Indicaciones</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->tipoSangre}}
						<span>Tipo de sangre</span>
					</div>
					<div>
						{{$data->contactoEmergencia}}
						<span>Contacto de Emergencia</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->telefonoEmergencia}}
						<span>Telefono de emergencia</span>
					</div>
					<div>
						{{$data->observacionEmergencia}}
						<span>Observación(Emergencia)</span>
					</div>
				</h3>
			</div>
		</div>
	</div>
</div>
