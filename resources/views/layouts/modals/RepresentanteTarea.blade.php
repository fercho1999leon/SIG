<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title uppercase" id="myModalLabel">Detalles de la actividad</h4>
		</div>
		<div class="modal-body">
			<div class="representante__modalActividad">
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$matter->nombre}}
					<span>Asignatura</span>
					</div>
					<div>
						{{$activity->created_at}}
						<span>Fecha</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{ $supply->nombre }}
					<span>Insumo</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
                    {{$activity->nombre}}
					<span>Actividad</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$activity->descripcion ?? '-'}}
					<span>Descripción</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad--border-bottom">
					{{$docente->apellidos}} {{$docente->nombres}}
					<span>Docente</span>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						{{$activity->fechaInicio}}
						<span>Inicio</span>
					</div>
					<div>
						{{$activity->fechaEntrega}}
						<span>Finaliza</span>
					</div>
				</h3>
				<h3 class="transporte__unidad__datos representante__modalActividad__fechas representante__modalActividad--border-bottom">
					<div>
						@if($activity->calificado == 0)
							NO
						@else
							Si
						@endif
						<span>Calificado</span>
					</div>
					<div>
						@if($activity->adjuntos != null)
							<a href="{{ route('descargaAdjuntosActividad', ['archivo' => $activity->adjuntos ]) }}">
								{{ $activity->adjuntos }}
							</a>
						@else
							No existen adjuntos en esta actividad.
						@endif
						<span>Adjunto</span>
					</div>
				</h3>
			</div>
		</div>
	</div>
</div>
