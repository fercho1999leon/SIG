<!-- Modal Mas información del usuario-->
<div class="modal fade" id="modalMasInformacion{{$estudiante->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">
				{{$estudiante->apellidos}} {{$estudiante->nombres}}
			</h4>
		</div>
		<div class="modal-body">
			<h4>Perfil: {{$estudiante->cargo}}</h4>
			<h4>Correo: {{$estudiante->correo}}</h4>
			<h4>Creado: {{$estudiante->created_at}}</h4>
			<h4>Ultima vez: {{$estudiante->last_login}}</h4>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
		</div>
		</div>
	</div>
</div>