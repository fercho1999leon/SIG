<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">Financiero</h4>
		</div>
		<div class="modal-body">
			<div class="representante__modalActividad">
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$user->ci}}
						<span>Cédula</span>
					</div>
					<div>
						{{$user->correo}}
						<span>Correo</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$user->nombres}}
						<span>Nombres</span>
					</div>
					<div>
						{{$user->apellidos}}
						<span>Apellidos</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$user->sexo}}
						<span>Sexo</span>
					</div>
					<div>
						{{$user->fNacimiento}}
						<span>Fecha de nacimiento</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$user->movil}}
						<span>Teléfono movil</span>
					</div>
					<div>
						@if ($user->url_imagen != null)
							<a download href="{{Storage::url($user->url_imagen)}}">Descargar</a>
						@else
							No tiene foto
						@endif
						<span>Foto</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$user->bio}}
					<span>Biografía</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$user->dDomicilio}}
						<span>Dirección domicilio</span>
					</div>
					<div>
						{{$user->tDomicilio}}
						<span>Teléfono domicilio</span>
					</div>
				</h3>
			</div>
		</div>
	</div>
</div>
