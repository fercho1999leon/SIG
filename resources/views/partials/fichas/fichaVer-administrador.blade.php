<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">Secretaría</h4>
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
						{{$data->fNacimiento}}
						<span>Fecha de nacimiento</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->correo}}
						<span>Correo</span>
					</div>
					<div>
						{{$data->movil}}
						<span>Celular</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$data->bio}}
					<span>Biografia</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$data->dDomicilio}}
						<span>Dirección del domicilio</span>
					</div>
					<div>
						{{$data->tDomicilio}}
						<span>Teléfono del domicilio</span>
					</div>
				</h3>
			</div>
		</div>
	</div>
</div>
