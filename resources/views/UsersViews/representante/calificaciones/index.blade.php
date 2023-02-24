@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<a class="button-br" href="{{route('hijo',['hijo' =>  $hijo->idStudent])}}">
    <button><img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper border-bottom white-bg" style="background: #ebebed">
		<div class="row wrapper border-bottom white-bg">
			<div class="repProfileHijo--cont">
				<figure class="repProfileHijo__resumen--img">
					<img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
					@if (strlen($parcial)!=2)
						@if ($comportamiento != null)
							<div class="represetante__comportamiento__hijo">
								<h2 class="m-0">
									COMPORTAMIENTO: {{$comportamiento->nota}}
									<br><small>{{$comportamiento->observacion}}</small>
								</h2>
							</div>
						@endif <br>
						@if($course->seccion != "EI"  && $course->grado !="Primero" )
							<h2 class="m-0">PROMEDIO
								{{ strlen($parcial) > 3 ? " PARCIAL:  ".$prm->promedio : " QUIMESTRAL:  ".$prm->promedioEstudiante }}
							</h2>
						@endif
					@endif
				</figure>
				<div class="repProfileHijo__resumen--info">
					<h3 class="repProfileHijo__resumen--name">{{$hijo->nombres}} {{$hijo->apellidos}}</h3>
					<hr>
					<div class="repProfileHijo__resumen--curso">
						<h4><strong>Curso: </strong> {{ $course->grado}} {{ $course->paralelo}} {{ $course->especializacion}}</h4>
						<h4><strong>Dirigente: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif</h4>
					</div>
					<div class="representante__calificaciones__libreta-download">
						<select class="selectpicker form-control" id="selParciales">
							@foreach($unidad as $und)
								<optgroup label="{{$und->nombre}}">
									@php
									$parcialP = $parciales->where('idUnidad', $und->id);
									@endphp
									@foreach($parcialP as $par )
										<option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
									@endforeach
									<option value="{{$und->identificador."Q"}}" {{$und->identificador."Q" == $parcial ? 'selected' : ''}} >{{$und->nombre}}</option>
								</optgroup>
							@endforeach
						</select>
						@if($mostrar_libreta->valor == '1')
							@if($course->seccion == "EI"  || $course->grado=="Primero" )
								@if ((strlen($parcial))>3)
									<a target="_blank" href="{{ route('destrezaEstudiante', ['idEstudiante' => $hijo->idStudent, 'idCurso' => $course->id, 'parcial' => $parcial])}}"
									class="btn btn-primary">Libreta
									</a>
									<a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumno', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $hijo->idStudent]) }}" class="btn btn-primary">
										Libreta Quimestral
									</a>
									<a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumnoDetallada', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $hijo->idStudent]) }}" class="btn btn-primary">
										Libreta Quimestral Detallada
									</a>
								@else
									<a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumno', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $hijo->idStudent]) }}" class="btn btn-primary">
										Libreta Quimestral
									</a>
									<a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumnoDetallada', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $hijo->idStudent]) }}" class="btn btn-primary">
										Libreta Quimestral Detallada
									</a>
								@endif
							@else
								@if (strlen($parcial)>3)
									<a target="_blank" href="{{ route('reporteEstudiante', ['idEstudiante' => $hijo->idStudent, 'idCurso' => $course->id, 'parcial' => $parcial])}}"
										class="btn btn-primary">Libreta Parcial
									</a>
									<a target="_blank" href="{{ route('libretaParcialConRefuerzoAlumno', ['idEstudiante' => $hijo->idStudent, 'parcial' => $parcial]) }}" class="btn btn-primary">
										Libretas Parcial-RA
									</a>
									<a target="_blank" href="{{ route('libretaQuimestreEstudiante', ['idCurso' => $course->id, 'quimestre' => $quimestre , 'idAlumno' => $hijo->idStudent ]) }}" class="btn btn-primary">
										Libreta Quimestral
									</a>
									<a target="_blank" href="{{ route('libretaAnualEstudiante', [ 'idAlumno' => $hijo->id ]) }}" class="btn btn-primary">
										Libreta Anual
									</a>
								@else
									<a target="_blank" href="{{ route('libretaQuimestreEstudiante', ['idCurso' => $course->id, 'quimestre' => $quimestre, 'idAlumno' => $hijo->idStudent ]) }}" class="btn btn-primary">
										Libreta Quimestral
									</a>
									<a target="_blank" href="{{ route('libretaAnualEstudiante', [ 'idAlumno' => $hijo->id ]) }}" class="btn btn-primary">
										Libreta Anual
									</a>
								@endif
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="r-calificacioneshijo-grid">
				@if($course->seccion == "EI"  || $course->grado=="Primero" )
					@foreach($matters as $matter)
						<!-- Debe mejoararse el método de obtención de materias para destrezas y visualziacion en perfiles representante/estudiantes-->
						@if($matter->visible!=0 && $matter->principal!=0)
						<div class="r-calificacioneshijo-item ibox m-0">
							<header class="r-calificaciones-header relative">
								<img src="{{secure_asset('img/CURSO.svg')}}" class="r-calificaciones-iconCurso" width="16" alt="">
								<h3 id="destrezaNombre" class="r-calificacioneshijo-materia destrezaNombre">{{ $matter->nombre }}</h3>
								<a class="collapse-link representante__notasInicial-iconMore">
									<img src="{{secure_asset('img/circleMore.svg')}}" width="20" alt="">
								</a>
							</header>
							<section class="r-calificaciones-section">
								<div class="ibox-content p-0 no-border" style="display: none;">
									@if(count($destrezas->where('id', $matter->id) ) > 0)
										@foreach($destrezas->where('id', $matter->id) as $destreza)
											<div class="calificaciones-insumoContainer">
												<strong class="r-calificaciones-insumo destrezaDescripcion">
													@if( strlen($destreza->nombre)>50 )
														{{ substr($destreza->nombre, 0, 30) }}...
													@else
														{{$destreza->nombre}}
													@endif
												</strong>
												@php
													$jsonSupply = json_decode( $destreza->calificacion );
													$notaDestreza = "";
													foreach($jsonSupply as $key => $json){
														if($key == $hijo->idStudent)
															$notaDestreza = $json;
													}
												@endphp
												<div style="display:flex; justify-content:flex-end;">
													<!--
													<a href="#" class="modalDestreza" style="width:15px">
														<img src="{{secure_asset('img/informacion-boton.svg')}}" alt="" width="15">
													</a>
													-->
													<span class="r-destreza__notaCualitativa destrezaNota"> {{ $notaDestreza }} </span>
												</div>
											</div>
										@endforeach
									@else
										<div class="calificaciones-insumoContainer">
											<strong class="r-calificaciones-insumo">Esta clase no tiene destrezas Asignadas</strong>
										</div>
									@endif
								</div>
							</section>
						</div>
						@endif
					@endforeach
				@else
					@foreach($matters as $matter)
						@php
							$struct = ($matter->idEstructura != null);
							$promedioM = $promediosmateria->where('materiaId', $matter->id)->first();
							if (strlen($parcial) > 3) {
								$promedios = new \Illuminate\Support\Collection($promedioM->insumos);
							} else {
								$promedios = new \Illuminate\Support\Collection($promedioM->parciales);
								$examenQuimestral = $promedios->where('indicador',$parcial)->first();
							}
						@endphp
						<div class="r-calificacioneshijo-item ibox m-0">
							<header class="r-calificaciones-header">
								<img src="{{secure_asset('img/CURSO.svg')}}" class="r-calificaciones-iconCurso" width="16" alt="">
								@if (strlen($parcial) > 3)
									@if($promedioM->promedioInicial != $promedioM->promedioFinal)
										<p class="no-margin rep-ra">R.A.</p>
									@endif
								@endif
								<h3 class="r-calificacioneshijo-materia">
									{{$matter->nombre}}
								</h3>
								<hr class="r-calificaciones-hr">
								<strong class="r-calificaciones-nota">
									<div></div>
									@if (!$struct)
										<div>{{ ((strlen($parcial) == 2) ? bcdiv($examenQuimestral->promediop, '1', 2) : ((strlen($parcial) > 3) ? bcdiv($promedioM->promedioFinal, '1', 2) : bcdiv($promedioM->promedioquimestral, '1', 2)) ) }}</div>
									@else
										<div>{{ ( (strlen($parcial) == 2) ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$examenQuimestral->promediop)['nota'] : ((strlen($parcial) > 3) ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$promedioM->promedioFinal)['nota'] : App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$promedioM->promedioquimestral)['nota'] ) ) }}</div>
									@endif
									@if (strlen($parcial) !== 2)
										<a class="collapse-link">
											<img src="{{secure_asset('img/circleMore.svg')}}" width="20" alt="">
										</a>
									@endif
								</strong>
							</header>
							@if (strlen($parcial) > 2)
								<section class="r-calificaciones-section ">
									<div class="ibox-content p-0 no-border" style="display: none;">
										@foreach($promedios as $supply)
											<div class="calificaciones-insumoContainer">
												<strong class="r-calificaciones-insumo">
													{{ ( (strlen($parcial) == 4) ? $supply->nombre : ((strlen($supply->indicador) == 3) ? 'Parcial '.substr(($supply->indicador),1,1) : 'Examen')) }} : 
													@if (!$struct)
														{{ strlen($parcial) == 4 ? bcdiv($supply->nota, '1', 2) : bcdiv($supply->promediop, '1', 2)}}
													@else
														{{ strlen($parcial) == 4 ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,bcdiv($supply->nota, '1', 2))['nota'] : App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,bcdiv($supply->promediop, '1', 2))['nota'] }}
													@endif
												</strong>
												@if (strlen($parcial) > 3)
													<div class="text-right">
														<a class="getInsumo" route="{{ route('insumoDetallesRepresentante',['alumno' => $hijo->idStudent, 'insumo' => $supply->insumoId, 'parcial' => $parcial]) }}" href="">
															@if( $supply->refuerzo > 0)
																<img src="{{secure_asset('img/informacion-boton-red')}}.svg" alt="" width="15">
															@else
																<img src="{{secure_asset('img/informacion-boton')}}.svg" alt="" width="15">
															@endif
														</a>
													</div>
												@endif
											</div>
										@endforeach
									</div>
								</section>
							@endif
						</div>
					@endforeach
					@if( $matterDHI!=null && strlen($parcial) != 2)
					<div class="r-calificacioneshijo-item ibox m-0">
						<header class="r-calificaciones-header">
							<img src="{{secure_asset('img/CURSO.svg')}}" class="r-calificaciones-iconCurso" width="16" alt="">
							<h3 class="r-calificacioneshijo-materia">
								{{$matterDHI->nombre}}
							</h3>
							<hr class="r-calificaciones-hr">
							<strong class="r-calificaciones-nota">
								<div></div>
								<div>
									@if ($dhi->valor == 'PARCIAL')
										@if (strlen($parcial)==3)
											@php $dhinota= substr($parcial,0,2); @endphp
											{{$matterDHI->$dhinota}}
										@else
											{{$matterDHI->$parcial}}
										@endif
									@else
										@if (strlen($parcial)==4)
											@php $dhinota= substr($parcial,2,2); @endphp
											{{$matterDHI->dhinota}}
										@else
											{{$matterDHI->$parcial}}
										@endif
									@endif
								</div>
							</strong>
						</header>
					</div>
					@endif
				@endif
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="detalleInsumo" tabindex="-1" role="dialog" aria-labelledby="">
</div>

{{-- Modal Destreza  --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title uppercase" id="myModalLabel">Nombre de la Destreza</h3>
			</div>
			<div class="modal-body">
				<h4 class="uppercase" id="NombreDestreza"></h4>
				<label class="bold" for="">Descripción:</label>
				<h4 id="DescripcionDestreza"></h4>
				<div class="text-center">
					<span class="r-destreza__notaCualitativa-modal" id="CalificacionDestreza">
					</span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script>
	var route = $('.getInsumo');
	route.click(function(e) {
		e.preventDefault();
		$.ajax({
			type: "GET",
			url: $(this).attr('route'),
			success: function (result, status, xhr) {
				console.log(result)
				$('#detalleInsumo').html(result)
				$('#detalleInsumo').modal('show')
			}, error: function (xhr, status, error) {
				alert('Algo salio mal.')
			}
		});
	})
	$('#selParciales').change( function() {
		var id = "{{ $hijo->idStudent }}";
		window.location.href = "{{ route('calificacionesRepresentante') }}/" + id + "/" +  $('#selParciales').val();
	});
	$('.modalDestreza').click( (el) => {
		console.log( $(el).parent().parent().parent().parent().parent().find('.destrezaNombre') )
		console.log( $(el).parent().parent().parent().parent().parent().find('.destrezaDescripcion') )
		console.log( $(el).parent().parent().parent().parent().parent().find('.destrezaNota') )
		$('#NombreDestreza').text( $(el).closest('.destrezaNombre').text() )
		$('#DescripcionDestreza').text( $(el).closest('.destrezaDescripcion').text() )
		$('#CalificacionDestreza').text( $(el).closest('.destrezaNota').text() )
		$("#myModal").modal()
	})
</script>
@endsection