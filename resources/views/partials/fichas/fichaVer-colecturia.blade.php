<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">Colecturía</h4>
		</div>
		<div class="modal-body">
			<div class="representante__modalActividad">
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$colecturia->ci}}
					<span>CI</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$colecturia->nombres}}
						<span>Nombres</span>
					</div>
					<div>
						{{$colecturia->apellidos}}
						<span>Apellidos</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$colecturia->sexo}}
						<span>Sexo</span>
					</div>
					<div>
						{{$colecturia->fNacimiento}}
						<span>Fecha de nacimiento</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$colecturia->correo}}
						<span>Correo</span>
					</div>
					<div>
						{{$colecturia->movil}}
						<span>Celular</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$colecturia->bio}}
						<span>Biografia</span>
					</div>
					<div>
						{{$colecturia->caja->numero_caja}}
						<span>Numero de caja</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$colecturia->dDomicilio}}
						<span>Dirección del domicilio</span>
					</div>
					<div>
						{{$colecturia->tDomicilio}}
						<span>Teléfono del domicilio</span>
					</div>
				</h3>
			</div>
		</div>
	</div>
</div>
