@extends('layouts.master')
@section('content')
<div class="lblCargando-container">
	<h3 class="lblCargando" id="lblCargando" style="display: none;"></h3>
</div>
<a class="button-br" href="{{route('InsumosAdmin',['id' =>  $matter->id, 'parcial' => $parcial])}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg noBefore titulo-separacion">
		<h2 class="title-page">
			<i class="fa fa-edit icon__title text-color3">
				{{ $curso->grado }} {{ $curso->paralelo }} {{ $curso->especializacion }} : {{ $matter->nombre }}
			</i> Recuperación supletorio, remedial, gracia.
		</h2>
	</div>
	<div class="wrapper wrapper-content dir-calificaciones mb350" id="alumnos">
		<!-- Todas Las Materias -->
		<div>
			<div class="white-bg p-1">
				<div class="pined-table-responsive">
					<table class="s-calificaciones adminTable__recuperaciones">
						<tr>
							<td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
							@foreach ($unidad as $uni)
							<td class="text-center bold uppercase">Ciclo</td>
							@endforeach
							<td class="text-center bold uppercase">supletorio</td>

							<td class="text-center bold uppercase">p. final</td>
							{{--<td class="text-center bold uppercase">estado</td>--}}
						</tr>
						@php $cont = 0;@endphp
						@foreach($students as $student)
						<tr>
							@php
							$promedio = $sabana->where('estudianteId', $student->id)->first();
							if($promedio){
								$materiap = new \Illuminate\Support\Collection($promedio->materias);
								$promediosP = $materiap->where('materiaId', $matter->id)->first();
								$parcialesp = new \Illuminate\Support\Collection($promediosP->quimestres);
							}else{
								$materiap = null;
								$promediosP = null;
								$parcialesp = null;
							}
							@endphp
							<td class="text-center">
								<kbd class="uppercase" id="lbl-{{$student->id}}">a</kbd>
							</td>
							<td class="uppercase">
								{{ $student->apellidos }} {{ $student->nombres }}
							</td>
							@php $s = 0;$promediosQ = null; @endphp
							@foreach ($unidad as $uni)
								@php
									if($parcialesp){
										$parcialperiodico = App\ParcialPeriodico::parcialP($uni->id);
										if($parcialperiodico->find('identificador',(($parcialesp[$s])->parciales)[$s]->indicador)){
											$promediosQ = ($parcialesp[$s])->parciales;
										}
										//$promediosQ = $parcialesp->where('indicador', $uni->identificador)->first();
									}else{
										$promediosQ = null;
									}
								@endphp
								<td class="text-center" id="pq{{$cont}}-{{$student->id}}">{{ $promediosQ ? bcdiv( $promediosQ[$s]->promediop, '1', 2)  : null}}</td>

								<td>
									<input type="text" id="sup-{{$student->id}}" student_id="{{ $student->id}}" supply_id="{{$supRecuperacion->id}}" name="{{route('calificacionesUpdateAdmin',['activity' => $supletorio->id,'student' => $student->id])}}" class="form-control inputQuimestral__note actualizarNota" value="{{$promediosP ? $promediosP->supletorio : null}}">
								</td>

								<td class="text-center" id="total-{{$student->id}}">{{$promediosP ? $promediosP->supletorio : null}}</td>

								@php $s++; @endphp
							@endforeach
							<!--{{-- <td class="text-center" id="pq1-{{$student->id}}">{{  bcdiv( $promedioQ1[$student->id], '1', 2) }}</td>
							<td class="text-center" id="pq2-{{$student->id}}">{{  bcdiv( $promedioQ2[$student->id], '1', 2) }}</td> --}}-->

							{{-- para usuarios que haya desaprobado, usar la siguiente clase -> adminTable__recuperaciones-desaprobado --}}
							{{--<td class="text-center adminTable__recuperaciones-aprobado" id="resultado-{{$student->id}}"></td>--}}
						</tr>
						@php $cont++; @endphp
						@endforeach
					</table>
				</div>
				<div class="text-center">
					<a class="btn btn-success btn-lg" href="{{ route('recuperacionesAdmin',[ 'idMateria' => $matter->id, 'idCurso' => $matter->idCurso, 'idCiclo' => $ciclo, 'parcial' => $parcial]) }}">Guardar</a>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalMat1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h3 class="modal-title uppercase" id="curso-modal">
							<i class="fa fa-bookmark text-color7"></i>Información de la Asignatura
						</h3>
					</div>
					<div class="modal-body ">
						<div class="row">
							<div class="col-lg-12">
								<div class="pined-table-responsive">
									<table class="s-calificaciones w100">
										<tr>
											<td class="bg_color7 text-right fz19">Nombre</td>
											<td class="text-left fz19">Ciencias Naturales</td>
										</tr>
										<tr>
											<td class="bg_color7 text-right fz19">Aporta al promedio</td>
											<td class="text-left fz19">Si</td>
										</tr>
										<tr>
											<td class="bg_color7 text-right fz19">Cuantitativa</td>
											<td class="text-left fz19">Si</td>
										</tr>
										<tr>
											<td class="bg_color7 text-right fz19">Clase</td>
											<td class="text-left fz19">Ciencias Naturales</td>
										</tr>
										<tr>
											<td class="bg_color7 text-right fz19">Referencia</td>
											<td class="text-left fz19">Octavo A | Educación General Básica</td>
										</tr>
										<tr>
											<td class="bg_color7 text-right fz19">Profesor</td>
											<td class="text-left fz19">Mery Urbina Andaluz</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var studentsID = [
		@foreach($students as $student) {
			
				id:"{{$student->id}}"
			
		},
		@endforeach
	];

	function calcular() {
		for (i = 0; i < studentsID.length; i++) {
			
			q1 = 0;

			if (parseFloat($("#pq" + i + "-" + (studentsID[i])['id']).text()) < parseFloat($("#sup-" + (studentsID[i])['id']).val())) {
				q1 = parseFloat($("#sup-" + (studentsID[i])['id']).val());
			} else {
				q1 = parseFloat($("#pq" + i + "-" + (studentsID[i])['id']).text());
			}

			/*if( parseFloat($('#pq1-'+studentsID[i]).text()) < parseFloat($('#rq1-'+studentsID[i]).val()) && parseFloat($('#pq1-'+studentsID[i]).text()) < parseFloat($('#pq2-'+studentsID[i]).text()) ){
				q1 = parseFloat($('#rq1-'+studentsID[i]).val());
			}else{
				q1 = parseFloat($('#pq1-'+studentsID[i]).text());
			}*/
			q2 = 0;/*
			if(parseFloat($('#pq2-'+studentsID[i]).text()) < parseFloat($('#rq1-'+studentsID[i]).val()) && parseFloat($('#pq1-'+studentsID[i]).text()) > parseFloat($('#pq2-'+studentsID[i]).text()) ){
				q2 = parseFloat($('#rq1-'+studentsID[i]).val());
			}else{
				q2 = parseFloat($('#pq2-'+studentsID[i]).text());
			}*/
			//if (q1 != 0 && q2 != 0) {
			if (q1 != 0) {
				total = parseFloat($('#total-' + (studentsID[i])['id']).text());
				if (total < 7 && total >= 5) {
					$('#rq1-' + (studentsID[i])['id']).prop('disabled', false);
					$('#resultado-' + (studentsID[i])['id']).text('Notas Incompletas');
					if (parseFloat($('#sup-' + (studentsID[i])['id']).val()) != 0) {

						if (parseFloat($('#sup-' + (studentsID[i])['id']).val()) >= 7) {
							$('#total-' + (studentsID[i])['id']).text(7);
							$('#resultado-' + (studentsID[i])['id']).text('Aprobado');
							$('#lbl-' + (studentsID[i])['id']).text('A');
							$('#rem-' + (studentsID[i])['id']).prop('disabled', false);
							$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
						} else if (parseFloat($('#sup-' + (studentsID[i])['id']).val()) < 7) {
							$('#total-' + (studentsID[i])['id']).text(total);
							$('#rem-' + (studentsID[i])['id']).prop('disabled', false);
							$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
							if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) != 0) {
								if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) >= 7) {
									$('#total-' + (studentsID[i])['id']).text(7);
									$('#resultado-' + (studentsID[i])['id']).text('Aprobado');
									$('#lbl-' + (studentsID[i])['id']).text('A');
									$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
								} else if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) < 7) {
									$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
									if (parseFloat($('#gra-' + (studentsID[i])['id']).val()) != 0) {
										$('#rem-' + (studentsID[i])['id']).prop('disabled', false);
										if (parseFloat($('#gra-' + (studentsID[i])['id']).val()) >= 7) {
											$('#total-' + (studentsID[i])['id']).text(7);
											$('#resultado-' + (studentsID[i])['id']).text('Aprobado');
											$('#lbl-' + (studentsID[i])['id']).text('A');
										} else if (parseFloat($('#gra-' + (studentsID[i])['id']).val()) < 7) {
											$('#resultado-' + (studentsID[i])['id']).text('Reprobado');
											$('#lbl-' + (studentsID[i])['id']).text('R');
											$('#resultado-' + (studentsID[i])['id']).toggleClass('adminTable__recuperaciones-desaprobado');
										}
									}
								}
							} else if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) == 0) {
								$('#total-' + (studentsID[i])['id']).text(total);
								$('#rq1-' + (studentsID[i])['id']).prop('disabled', false);
								$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
							}
						}
					} else if (parseFloat($('#sup-' + (studentsID[i])['id']).val()) == 0) {
						$('#total-' + (studentsID[i])['id']).text(total);
						$('#rq1-' + (studentsID[i])['id']).prop('disabled', false);
						$('#rem-' + (studentsID[i])['id']).prop('disabled', false);
						$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
					}
				} else if (total < 5) {
					$('#total-' + (studentsID[i])['id']).text(total);
					$('#resultado-' + (studentsID[i])['id']).text('Notas Incompletas');
					$('#rq1-' + (studentsID[i])['id']).prop('disabled', false);
					$('#sup-' + (studentsID[i])['id']).prop('disabled', false);
					if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) != 0) {
						if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) >= 7) {
							$('#total-' + (studentsID[i])['id']).text(7);
							$('#resultado-' + (studentsID[i])['id']).text('Aprobado');
							$('#lbl-' + (studentsID[i])['id']).text('A');
							$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
						} else if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) < 7) {
							$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
							if (parseFloat($('#gra-' + (studentsID[i])['id']).val()) != 0) {
								if (parseFloat($('#gra-' + (studentsID[i])['id']).val()) >= 7) {
									$('#total-' + (studentsID[i])['id']).text(7);
									$('#resultado-' + (studentsID[i])['id']).text('Aprobado');
									$('#lbl-' + (studentsID[i])['id']).text('A');
								} else if (parseFloat($('#gra-' + (studentsID[i])['id']).val()) < 7) {
									$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
									$('#resultado-' + (studentsID[i])['id']).text('Reprobado');
									$('#lbl-' + (studentsID[i])['id']).text('R');
									$('#resultado-' + (studentsID[i])['id']).toggleClass('adminTable__recuperaciones-desaprobado');
								}
							}
						}
					} else if (parseFloat($('#rem-' + (studentsID[i])['id']).val()) == 0) {
						$('#total-' + (studentsID[i])['id']).text(total);
						$('#sup-' + (studentsID[i])['id']).prop('disabled', false);
						$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
					}
				} else if (total >= 7) {

					$('#sup-' + (studentsID[i])['id']).prop('disabled', false);
					$('#rem-' + (studentsID[i])['id']).prop('disabled', false);
					$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
					$('#total-' + (studentsID[i])['id']).text(total);
					$('#resultado-' + (studentsID[i])['id']).text('Aprobado');
					$('#lbl-' + (studentsID[i])['id']).text('A');
				}
			} else {
				$('#resultado-' + (studentsID[i])['id']).text('Notas Incompletas');
				$('#rq1-' + (studentsID[i])['id']).prop('disabled', false);
				$('#sup-' + (studentsID[i])['id']).prop('disabled', false);
				$('#rem-' + (studentsID[i])['id']).prop('disabled', false);
				$('#gra-' + (studentsID[i])['id']).prop('disabled', false);
			}
		}
	}

	$('.actualizarNota').change(function(e) {
		e.preventDefault();
		var masde10 = /^[1-9]+[1-9]+$/;
		var letras = /^[a-zA-Z]+$/;

		if ($(this).val().match(masde10) || $(this).val().match(letras)) {
			$(this).val("0");
			return;
		} else {
			var ruta = $(this).attr('name');
			var nota = $(this).val()
			var student = $(this).attr('student_id');
			var supply = $(this).attr('supply_id');
			$.ajax({
				url: ruta,
				type: "POST",
				data: {
					nota: nota,
					student: student,
					supply: supply
				},
				beforeSend: function() {
					$('#lblCargando').removeClass("lblCargando-error");
					$('#lblCargando').addClass("lblCargando");
					$('#lblCargando').text('Subiendo notas...').show();
				},
				error: function(xhr, status, error) {
					var response = JSON.parse(xhr.responseText)
					$.each(response, function(index, value) {
						$('#lblCargando').removeClass("lblCargando-error");
						$('#lblCargando').addClass("lblCargando");
						$('#lblCargando').text('Ingrese por favor un numero').show();
						$('#lblCargando').addClass("lblCargando-error");
					});
				}
			});
			calcular();
			// cargarPromedios();
		}
	});

	calcular();
</script>
@endsection