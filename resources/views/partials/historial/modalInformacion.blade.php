<!-- Modal Mas información del usuario-->
@php
	use App\Usuario;
	$usuario = Usuario::find($user->userid);
@endphp
<div class="modal fade" id="modalMasInformacion{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">
				{{$user->apellidos}} {{$user->nombres}}
			</h4>
		</div>
		<div class="modal-body">
			<h4>Perfil: {{$user->cargo}}</h4>
			<h4>Correo: {{$user->correo}}</h4>
			<h4>El usuario fue creado:
				{{$usuario->created_at}}
			</h4>
			<h4>El usuario accedio por ultima vez: 
				{{$usuario->last_login}}
			</h4>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
		</div>
	</div>
</div>