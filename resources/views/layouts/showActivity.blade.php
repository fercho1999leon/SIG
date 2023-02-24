@php
use App\Permiso;
$permiso = Permiso::desbloqueo('grade_score');
if($permiso ==null || ($permiso != null && $permiso->editar == 1)){
    $readonly ="";
}else $readonly ="readonly='readonly'";
@endphp
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Editar Actividad</h4>
                </div>
                <div class="modal-body">
                    <div class="widget widget-tabs">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active" style="{{$accion}}">
                                    <a data-toggle="tab" href="#tab-4">GENERAL</a>
                                </li>
                                <li style="{{$accion}}">
                                    <a data-toggle="tab" href="#tab-5">DESCRIPCION</a>
                                </li>
                                <li style="{{$accion}}">
                                    <a data-toggle="tab" href="#tab-6">ADJUNTOS</a>
								</li>
								{{-- @if($Activity->recibirTareas != null) --}}
                                @if($accion !=''){{--debo mostrar recibidos aparte--}}
									<li>
										<a data-toggle="tab" href="#tab-7">RECIBIDOS</a>
									</li>
                                @endif
								{{-- @endif --}}
							</ul>
                            <form id="FormUpdateActivity" action="{{route('updateActividad')}}" method="POST"  enctype="multipart/form-data" >
                                {{csrf_field()}}
                                <input type="hidden" value="{{$Activity->id}}" name="id">
                                <input type="hidden" value="{{$idCurso}}" name="idCurso">
                                <input type="hidden" value="{{$idMateria}}" name="idMateria">
                                <div class="tab-content">

                                    <div id="tab-4" class="tab-pane active" style="{{$accion}}">
                                        <table class="table table-bordered" width="75%">
                                            <tbody>
                                                <tr>
                                                    <td width="25%" class="text-right" style="background: #EDF3F4">
                                                        <span>Nombre</span>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="nombre-update" name="nombre" value="{{$Activity->nombre}}">
                                                    </td>
                                                </tr>
                                                    <tr>
                                                        <td width="25%" class="text-right" style="background: #EDF3F4">
                                                            <span>Fecha de Inicio</span>
                                                        </td>
                                                        <td>
                                                            <input type="date" class="form-control" name="fechaInicio"  id="fechaInicio-update" value="{{$Activity->fechaInicio}}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%" class="text-right" style="background: #EDF3F4">
                                                            <span>Fecha de Entrega</span>
                                                        </td>
                                                        <td>
                                                            <input type="date" class="form-control" name="fechaEntrega" id="fechaEntrega-update" step="1" value="{{$Activity->fechaEntrega}}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%" class="text-right" style="background: #EDF3F4">
                                                            <span>Es calificado?</span>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="calificado"
                                                            @if($Activity->calificado)
                                                                checked
                                                            @endif
                                                            >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%" class="text-right" style="background: #EDF3F4">
                                                            <span>Permitir tareas?</span>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="recibirTareas" value="1"
                                                            @if($Activity->recibirTareas)
                                                                checked
                                                            @endif
                                                            >
                                                        </td>
													</tr>
													<tr>
                                                        <td width="25%" class="text-right" style="background: #EDF3F4">
                                                            <span>Fecha de Creación</span>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="creacion" readonly='readonly' step="1" value="{{$Activity->created_at}}">
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="tab-5" class="tab-pane" style="{{$accion}}">
                                        <textarea class="form-control" rows="5" id="descripcion-update" name="descripcion" >{{$Activity->descripcion}}</textarea>
                                    </div>
                                    <div id="tab-6" class="tab-pane" style="{{$accion}}">
                                        @if($Activity->adjuntos != null)
                                            <h3 class="underline">Adjunto</h3>
                                            <a href="{{ route('descargaAdjuntosActividad', ['archivo' => $Activity->adjuntos ]) }}">
                                                {{ $Activity->adjuntos }}</br>
                                            </a>
                                        @endif
                                        @if($permiso ==null || ($permiso != null && $permiso->editar == 1))
                                         Adjuntar archivo
                                         <input id="files-2" name="adjuntos" type="file" class="file">
                                         @endif
                                    </div>
                                    @if($accion !=''){{--debo mostrar recibidos aparte--}}
                                    {{-- @if($Activity->recibirTareas != null) --}}
                                    <div id="tab-7" class="tab-pane active">
										<div class="pined-table-responsive">
											<div class="alert alert-success" id="tareaDesbloqueadaMensaje" style="display:none">
												Tarea Desbloqueada
											</div>
											<table class="s-calificaciones">
												<tr class="table__bgBlue">
													<td class="no-border">#</td>
													<td class="no-border">Estudiante</td>
													@if($Activity->recibirTareas != null)
														<td class="no-border">Tarea Adjuntada</td>
														<td class="no-border">Estado</td>
														<td class="no-border">Acción</td>
													@endif
													<td class="no-border">Notas</td>
													<td class="no-border" width="300">Observacion</td>
												</tr>
												@foreach($students as $student)
												<tr>
													<td class="text-center">{{$i++}}</td>
													<td>{{ $student->apellidos }} {{ $student->nombres }}</td>
													@if($Activity->recibirTareas != null)
														<td>
															@foreach ($deberes->where('idEstudiante', $student->idStudent) as $deber)
                                                                @php
                                                                $materia = App\Matter::findOrFail($idMateria);
                                                                $carpeta = 'public/deberes_adjuntos/curso_'.$idCurso.'/'.substr($materia->nombre, 0 ,25).'/parcial_'.$Activity->parcial.'/Insumo_'.$Activity->idInsumo.'/'.substr($Activity->nombre, 0 ,25).'/'.$deber->adjunto;
                                                                @endphp
																<a download href="{{Storage::url("$carpeta")}}">
																	{{ substr($deber->adjunto,0,25) }}{{strlen($deber->adjunto) > 25 ? '...' : ''}}
																</a>
															@endforeach
														</td>
														{{-- validar para que este activo mientras caduque HECTOR FUENTES --}}
														@foreach ($deberes->where('idEstudiante', $student->idStudent) as $deber)
															@if ($Activity->fechaEntrega >= $today)
																<td class="{{$deber->enviado == 1 ? 'btn__tareaBloqueo-bloqueo' : 'btn__tareaBloqueo-desbloqueo'}}" id="deber_{{$deber->id}}"></td>
															@else
																<td class="{{$deber->bloqueo == 1 ? 'btn__tareaBloqueo-bloqueo' : 'btn__tareaBloqueo-desbloqueo'}}" id="deber_{{$deber->id}}"></td>
															@endif
														@endforeach
														<td>
															@foreach ($deberes->where('idEstudiante', $student->idStudent) as $deber)
																@if ($Activity->fechaEntrega >= $today)
																	<button {{$deber->disabled == 1 ? 'disabled' : ''}} type="submit" class="btn no-border bg-none m-0 {{$deber->disabled == 0 ? 'desbloquearEstudiante' : ''}}" idDeber="{{$deber->id}}">
																		<i class="fa fa-lock" aria-hidden="true"></i>
																	</button>
																@else
																	<button type="submit"  class="btn no-border bg-none m-0 desbloquearEstudianteCaducado" idDeber="{{$deber->id}}">
																		<i class="fa fa-lock" aria-hidden="true"></i>
																	</button>
																@endif
															@endforeach
														</td>
													@endif
													@php
														$calificaciones = App\Calificacion::query()
															->where('idActividad', $Activity->id)
															->where('idEstudiante', $student->idStudent)
															->where('idInsumo', $Activity->idInsumo)
															->first();
													@endphp
													<td>
														<input name="notasAlumnos[{{$student->idStudent}}]"
														@if ($calificaciones != null)
															@if ($configuracion != null)
																@if(strcmp($configuracion->valor,"1"))
																	disabled
																@endif
															@endif
														@endif
                                                        {{$readonly}}
														class="actualizarNota text-center border-gray-200 border w-16"
														class="form-control"
														type="text"
														@if ($calificaciones != null)
															value="{{$calificaciones->nota}}"
														@else
															value="0"
														@endif
														>
													</td>
													<td>
														<input name="observacionAlumnos[{{$student->idStudent}}]"
															{{$readonly}}
															class="text-center border-gray-200 border w-16"
															class="form-control"
															type="text"
															style="WIDTH: 300px; HEIGHT: 25px"
															@if ($calificaciones != null)
																value="{{$calificaciones->observacion}}"
															@else
																value=" "
															@endif
														>
													</td>
													<input type="hidden" name="idActividad" value="{{$Activity->id}}">
													<input type="hidden" name="idInsumo" value="{{$Activity->idInsumo}}">
												</tr>
												@endforeach
											</table>
										</div>
									</div>
                                    {{-- @endif --}}
                                    @endif

                                </div>
                           	</form>
                        </div>
                  	</div>
              	</div>
                <div id="data2"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                     @if($permiso ==null || ($permiso != null && $permiso->editar == 1))
                    <button type="button" class="btn btn-primary" id="submit-form-update">Guardar</button>
                    @endif
                </div>
            </div>

		</div>
<script>
$('#submit-form-update').click(function(e){
    $('#FormUpdateActivity').submit();
});
$("#files-2").fileinput();
let msg = $('#tareaDesbloqueadaMensaje')
let today = '{{$today}}'
let fechaCaducidad = '{{$Activity->fechaEntrega}}'
if (fechaCaducidad >= today) {
	var route = "{{route('desbloquearTarea')}}"
	var btnDesbloqueo = $('.desbloquearEstudiante')
} else {
	var route = "{{route('desbloquearTareaCaducada')}}"
	var btnDesbloqueo = $('.desbloquearEstudianteCaducado')
}
function mensajeBloqueo($mensaje) {
	msg.text($mensaje)
	msg.fadeIn('slow')
}

btnDesbloqueo.click(function(e) {
	e.preventDefault()
	let btn = $(this);
	let msg = $('#tareaDesbloqueadaMensaje')
	$.ajax({
		type: 'POST',
		url: route,
		data: {
			'_token': $('input[name=_token]').val(),
			idDeber: $(this).attr('idDeber')
		},success: function (result, status, xhr) {
			var idDeber = btn.attr('idDeber')
			var td = $('#deber_'+idDeber)
			if (td.hasClass('btn__tareaBloqueo-desbloqueo')) {
				td.removeClass('btn__tareaBloqueo-desbloqueo')
				td.addClass('btn__tareaBloqueo-bloqueo')
			} else {
				td.removeClass('btn__tareaBloqueo-bloqueo')
				td.addClass('btn__tareaBloqueo-desbloqueo')
			}
			setTimeout(() => {
				msg.fadeOut('slow')
			}, 3000);
		}, error: function() {
			alert('Algo salio mal.')
		}
	})
})

</script>
<script>

	$('.actualizarNota').change(function (e) {
		var masde10 = /^[1-9]+[1-9]+$/;
		var letras = /^[a-zA-Z]+$/;
		var notaMinima = parseInt('{{$nota_minima->valor}}')
		if( $(this).val().match(masde10) || $(this).val().match(letras) || parseInt($(this).val()) > 10 || parseInt($(this).val()) < notaMinima){
			$(this).val("0");
			return;
		}
	});
</script>
