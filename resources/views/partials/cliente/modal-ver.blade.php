<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">Cliente</h4>
		</div>
		<div class="modal-body">
			<div class="representante__modalActividad">
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$cliente->cedula_ruc}}
					<span>{{strlen($cliente->cedula_ruc) == 10 ? 'Cédula' : 'Ruc'}}</span>
					</div>
					<div>
						{{$cliente->nacionalidad}}
					<span>Nacionalidad</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$cliente->nombres}}
						<span>Nombres</span>
					</div>
					<div>
						{{$cliente->apellidos}}
						<span>Apellidos</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$cliente->correo}}
						<span>Correo</span>
					</div>
					<div>
						{{$cliente->direccion}}
						<span>Celular</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$cliente->parentezco}}
						<span>Parentezco</span>
					</div>
					<div>
						{{$cliente->fecha_nacimiento}}
						<span>Fecha de nacimiento</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$cliente->telefono_domicilio}}
						<span>Telefono Domicilio</span>
					</div>
					<div>
						{{$cliente->profesion}}
						<span>Profesión</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$cliente->lugar_trabajo}}
						<span>Lugar de trabajo</span>
					</div>
					<div>
						{{$cliente->telefono_trabajo}}
						<span>Telefono del trabajo</span>
					</div>
				</h3>
			</div>
		</div>
	</div>
</div>
