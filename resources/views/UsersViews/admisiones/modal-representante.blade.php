<div class="modal-dialog dirModalAgregarGrado modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
				<h3 class="modal-title">Datos Generales del Represnetante</h3>
			</div>
		<div class="modal-body">
			<div class="representante__modalActividad">
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$representante->ci}}
					<span>CI</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->nombres}}
						<span>Nombres</span>
					</div>
					<div>
						{{$representante->apellidos}}
						<span>Apellidos</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->sexo}}
						<span>Sexo</span>
					</div>
					<div>
						{{$representante->nacionalidad}}
						<span>Nacionalidad</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->fNacimiento}}
						<span>Fecha de nacimiento</span>
					</div>
					<div>
						{{$representante->correo}}
						<span>Correo</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->movil}}
						<span>Teléfono Movil</span>
					</div>
					<div>
						@if ($representante->url_imagen != null)
							<a href="{{"/storage/$representante->url_imagen"}}" download="">Descargar</a>
						@else
							No tiene foto
						@endif
						<span>Foto</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->profesion}}
						<span>Profesión</span>
					</div>
					<div>
						{{$representante->lugar_trabajo}}
						<span>Lugar trabajo</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$representante->telefono_trabajo}}
					<span>Telefono trabajo</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->ex_alumno == 1 ? 'Si' : 'No'}}
						<span>Ex Alumno</span>
					</div>
					<div>
						{{$representante->fecha_promocion}}
						<span>Fecha promoción</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->fecha_ingreso}}
						<span>Fecha de ingreso</span>
					</div>
					<div>
						{{$representante->fecha_estado_migratorio}}
						<span>Fecha estado migratorio</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->fecha_exp_pasaporte}}
						<span>Fecha expiración pasaporte</span>
					</div>
					<div>
						{{$representante->fecha_caducidad_pasaporte}}
						<span>Fecha caducidad pasaporte</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$representante->bio}}
					<span>Biografía</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$representante->dDomicilio}}
						<span>Dirección domicilio</span>
					</div>
					<div>
						{{$representante->tDomicilio}}
						<span>Teléfono del domicilio</span>
					</div>
				</h3>
			</div>
			</div>
	</div>
</div>
