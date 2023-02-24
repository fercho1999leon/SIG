<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">Bloqueos</h4>
		</div>
		<div class="modal-body">
			@foreach ($dataProfile->bloqueos as $bloqueo)
				<p class="modalBloqueo__p">{{$bloqueo->nombre}}</p>
			@endforeach
		</div>
	</div>
</div>