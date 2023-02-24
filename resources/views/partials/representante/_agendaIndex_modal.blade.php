<!-- Modal -->
<div class="modal fade" id="detallesActividad{{$hour->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">
					<img src="{{secure_asset('img/CURSO.png')}}" width="12" alt="">
					{{$matter->nombre}}
				</h4>
			</div>
			<div class="modal-body">
				<div class="transporte__unidad__datos mb-6">
					<p class="mb-0"> {{ $hour->created_at }}</p>
					<span class="bold">Fecha</span>
				</div>
				<div class="transporte__unidad__datos mb-6">
					<p class="mb-0"> {{ $hour->nombre }} </p>
					<span class="bold">Nombre</span>
				</div>
				<div class="transporte__unidad__datos mb-6">
					<textarea readonly="readonly" cols="50%" rows="5">{{ $hour->descripcion }}</textarea>
					<span class="bold">Descripción</span>
				</div>
				@if ($hour->linkVideo != null)
				<div class="transporte__unidad__datos mb-6">
					<p class="mb-0">
						<a target="_blank" href="{{$hour->linkVideo}}">{{$hour->linkVideo}}</a>
					</p>
					<span class="bold">Video</span>
				</div>
				@endif
				@if ($hour->observacion != null)
				<div class="transporte__unidad__datos mb-6">
					<p class="mb-0"> {{ $hour->observacion }}</p>
					<span class="bold">Observación</span>
				</div>
				@endif
				@if ($hour->adjuntos != null)
				<div class="transporte__unidad__datos mb-6">
					<a download="" class="btn btn-primary" href="{{Storage::url("adjuntos/$hour->adjuntos")}}">{{$hour->adjuntos}}</a>
					<span class="bold">Adjunto</span>
				</div>
				@endif
				@if ($hour->observacionEstudiantes->isNotEmpty())
				<div class="transporte__unidad__datos mb-6">
					<div class="alert alert-success">
						<h3 class="mt-0 mb-0">Observación</h3>
						@foreach($hour->observacionEstudiantes as $obs)
						@if($obs->idEstudiante === $hijo->idStudent)						
						<p>{{$obs->observacion}}</p>
						@if ($obs->adjunto != null)
							<h3 class="mt-4 mb-0">Adjunto</h3>
							<a href="{{Storage::url('adjuntos/'.$obs->adjunto)}}" download>{{$obs->adjunto}}</a>
						@endif
						@endif
						@endforeach
					</div>
				</div>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>