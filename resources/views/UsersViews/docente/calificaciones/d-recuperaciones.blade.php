@extends('layouts.master') 
@section('content')
<div class="lblCargando-container">
    <h3 class="lblCargando" id="lblCargando" style="display: none;"></h3>
</div>
<a class="button-br" href="{{route('MateriasDocente',['idMateria' =>  $matter->id, 'parcial' => 'p1q1'])}}">
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
								<td class="text-center bold uppercase">{{$uni->identificador}}</td>
							@endforeach
							<td class="text-center bold uppercase">Rec</td>
							<td class="text-center bold uppercase">supletorio</td>
							<td class="text-center bold uppercase">remedial</td>
							<td class="text-center bold uppercase">gracia</td>
							<td class="text-center bold uppercase">p. final</td>
							<td class="text-center bold uppercase">estado</td>
						</tr>
						@foreach($students as $student)
						<tr>
							@php
								$promedio = $sabana->where('estudianteId', $student->idStudent)->first();
                                $materiap = new \Illuminate\Support\Collection($promedio->materias);
                                $promediosP = $materiap->where('materiaId', $matter->id)->first();
								$parcialesp = new \Illuminate\Support\Collection($promediosP->quimestres);
							@endphp
							<td class="text-center">
								<kbd class="uppercase" id="lbl-{{$student->id}}">a</kbd>
							</td>
							<td class="uppercase">
								{{ $student->apellidos }} {{ $student->nombres }}
							</td>
							@php $s = 0; @endphp
							@foreach ($unidad as $uni)
								@php
									$s++;
									$promediosQ = $parcialesp->where('indicador', $uni->identificador)->first();
								@endphp
								<td class="text-center" id="pq{{$s}}-{{$student->idStudent}}">{{  bcdiv( $promediosQ->promediop, '1', 2) }}</td>
							@endforeach
							<td>
								<input type="text" 
									id="rq1-{{$student->idStudent}}" student_id="{{ $student->idStudent}}" supply_id="{{$supRecuperacion->id}}"
                                    name="{{route('calificacionesUpdate',['activity' => $actRecuperacion1->id,'student' => $student->idStudent])}}"
                                    class="form-control inputQuimestral__note actualizarNota" value="{{ $promediosP->recuperatorio }}"
								>
							</td>
							<td>
								<input type="text" 
									id="sup-{{$student->idStudent}}" student_id="{{ $student->idStudent}}" supply_id="{{$supRecuperacion->id}}"   
                                    name="{{route('calificacionesUpdate',['activity' => $supletorio->id,'student' =>  $student->idStudent])}}" 
                                    class="form-control inputQuimestral__note actualizarNota" value="{{ $promediosP->supletorio }}"
								>
							</td>
							<td>
								<input type="text" 
									id="rem-{{$student->idStudent}}" student_id="{{ $student->idStudent}}" supply_id="{{$supRecuperacion->id}}"   
                                    name="{{route('calificacionesUpdate',['activity' => $remedial->id,'student' => $student->idStudent])}}" 
                                    class="form-control inputQuimestral__note actualizarNota" value="{{ $promediosP->remedial }}"
								>
							</td>
							<td>
								<input type="text" 
									id="gra-{{$student->idStudent}}" student_id="{{ $student->idStudent}}" supply_id="{{$supRecuperacion->id}}"   
                                    name="{{route('calificacionesUpdate',['activity' => $gracia->id,'student' => $student->idStudent])}}" 
                                    class="form-control inputQuimestral__note actualizarNota" value="{{ $promediosP->gracia }}"
								>
							</td>
							<td class="text-center" id="total-{{$student->idStudent}}">{{$promediosP->promedioFinal}}</td>
							{{-- para usuarios que haya desaprobado, usar la siguiente clase -> adminTable__recuperaciones-desaprobado --}}
							<td class="text-center adminTable__recuperaciones-aprobado" id="resultado-{{$student->idStudent}}">aprobado</td>
						</tr>
						@endforeach
					</table>
				</div>
				<div class="text-center">
					<a class="btn btn-success btn-lg" href="{{ route('MateriasDocente',['id' => $matter->id, 'parcial' => 'p1q1']) }}">Guardar</a>
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
		@foreach($students as $student)
			{{ $student->idStudent}},
		@endforeach
	];
	
	function calcular(){
		for(i = 0; i < studentsID.length; i++){
			q1 = 0;
			if( parseFloat($('#pq1-'+studentsID[i]).text()) < parseFloat($('#rq1-'+studentsID[i]).val()) && parseFloat($('#pq1-'+studentsID[i]).text()) < parseFloat($('#pq2-'+studentsID[i]).text()) ){
				q1 = parseFloat($('#rq1-'+studentsID[i]).val());
			}else{
				q1 = parseFloat($('#pq1-'+studentsID[i]).text());
			}
			q2 = 0;
			if(parseFloat($('#pq2-'+studentsID[i]).text()) < parseFloat($('#rq1-'+studentsID[i]).val()) && parseFloat($('#pq1-'+studentsID[i]).text()) > parseFloat($('#pq2-'+studentsID[i]).text()) ){
				q2 = parseFloat($('#rq1-'+studentsID[i]).val());
			}else{
				q2 = parseFloat($('#pq2-'+studentsID[i]).text());
			}
			if (q1 != 0 && q2 != 0) {
				total = parseFloat($('#total-'+studentsID[i]).text());
				if (total < 7 && total >= 5) {
					$('#rq1-'+studentsID[i]).prop('disabled', true);
					$('#resultado-'+studentsID[i]).text('Notas Incompletas');
					if (parseFloat($('#sup-'+studentsID[i]).val()) !=0){
						if( parseFloat($('#sup-'+studentsID[i]).val()) >= 7 ){
							$('#total-'+studentsID[i]).text(7);
							$('#resultado-'+studentsID[i]).text('Aprobado');
							$('#lbl-'+studentsID[i]).text('A');
							$('#rem-'+studentsID[i]).prop('disabled', true);
							$('#gra-'+studentsID[i]).prop('disabled', true);
						}else if(parseFloat($('#sup-'+studentsID[i]).val()) < 7){
							$('#total-'+studentsID[i]).text(total);
							$('#rem-'+studentsID[i]).prop('disabled', false);
							$('#gra-'+studentsID[i]).prop('disabled', true);
							if (parseFloat($('#rem-'+studentsID[i]).val()) !=0){
								if( parseFloat($('#rem-'+studentsID[i]).val()) >= 7 ){
									$('#total-'+studentsID[i]).text(7);
									$('#resultado-'+studentsID[i]).text('Aprobado');
									$('#lbl-'+studentsID[i]).text('A');
									$('#gra-'+studentsID[i]).prop('disabled', true);
								}else if(parseFloat($('#rem-'+studentsID[i]).val()) < 7){
									$('#gra-'+studentsID[i]).prop('disabled', false);
									if (parseFloat($('#gra-'+studentsID[i]).val()) !=0){
										$('#rem-'+studentsID[i]).prop('disabled', false);
										if( parseFloat($('#gra-'+studentsID[i]).val()) >= 7 ){
											$('#total-'+studentsID[i]).text(7);
											$('#resultado-'+studentsID[i]).text('Aprobado');
											$('#lbl-'+studentsID[i]).text('A');
										}else if ( parseFloat($('#gra-'+studentsID[i]).val()) < 7 ){
											$('#resultado-'+studentsID[i]).text('Reprobado');
											$('#lbl-'+studentsID[i]).text('R');
											$('#resultado-'+studentsID[i]).toggleClass('adminTable__recuperaciones-desaprobado');
										}
									}
								}
							}else if (parseFloat($('#rem-'+studentsID[i]).val()) == 0 ){
								$('#total-'+studentsID[i]).text(total);
								$('#rq1-'+studentsID[i]).prop('disabled', true);
								$('#gra-'+studentsID[i]).prop('disabled', true);
							}
						}
					}else if (parseFloat($('#sup-'+studentsID[i]).val()) == 0 ){
						$('#total-'+studentsID[i]).text(total);
						$('#rq1-'+studentsID[i]).prop('disabled', true);
						$('#rem-'+studentsID[i]).prop('disabled', true);
						$('#gra-'+studentsID[i]).prop('disabled', true);
					}
				}else if (total < 5){
					$('#total-'+studentsID[i]).text(total);
					$('#resultado-'+studentsID[i]).text('Notas Incompletas');
					$('#rq1-'+studentsID[i]).prop('disabled', true);
					$('#sup-'+studentsID[i]).prop('disabled', true);
					if (parseFloat($('#rem-'+studentsID[i]).val()) !=0){
						if( parseFloat($('#rem-'+studentsID[i]).val()) >= 7 ){
							$('#total-'+studentsID[i]).text(7);
							$('#resultado-'+studentsID[i]).text('Aprobado');
							$('#lbl-'+studentsID[i]).text('A');
							$('#gra-'+studentsID[i]).prop('disabled', true);
						}else if(parseFloat($('#rem-'+studentsID[i]).val()) < 7){
							$('#gra-'+studentsID[i]).prop('disabled', false);
							if( parseFloat($('#gra-'+studentsID[i]).val()) != 0 ){
								if( parseFloat($('#gra-'+studentsID[i]).val()) >= 7 ){
									$('#total-'+studentsID[i]).text(7);
									$('#resultado-'+studentsID[i]).text('Aprobado');
									$('#lbl-'+studentsID[i]).text('A');
								}else if ( parseFloat($('#gra-'+studentsID[i]).val()) < 7 ){
									$('#gra-'+studentsID[i]).prop('disabled', false);
									$('#resultado-'+studentsID[i]).text('Reprobado');
									$('#lbl-'+studentsID[i]).text('R');
									$('#resultado-'+studentsID[i]).toggleClass('adminTable__recuperaciones-desaprobado');
								}
							}
						}
					}else if (parseFloat($('#rem-'+studentsID[i]).val()) == 0 ){
						$('#total-'+studentsID[i]).text(total);
						$('#sup-'+studentsID[i]).prop('disabled', true);
						$('#gra-'+studentsID[i]).prop('disabled', true);
					}
				}else if (total >= 7){
					$('#sup-'+studentsID[i]).prop('disabled', true);
					$('#rem-'+studentsID[i]).prop('disabled', true);
					$('#gra-'+studentsID[i]).prop('disabled', true);
					$('#total-'+studentsID[i]).text(total);
					$('#resultado-'+studentsID[i]).text('Aprobado');
					$('#lbl-'+studentsID[i]).text('A');
				}
			}else {
				$('#resultado-'+studentsID[i]).text('Notas Incompletas');
				$('#rq1-'+studentsID[i]).prop('disabled', true);
				$('#sup-'+studentsID[i]).prop('disabled', true);
				$('#rem-'+studentsID[i]).prop('disabled', true);
				$('#gra-'+studentsID[i]).prop('disabled', true);
			}
		}
	}
	$('.actualizarNota').change(function (e) {
		e.preventDefault();
		var masde10 = /^[1-9]+[1-9]+$/;
		var letras = /^[a-zA-Z]+$/;
		var notaMinima = parseFloat('{{$nota_minima->valor}}')
		if( $(this).val().match(masde10) || $(this).val().match(letras) || parseFloat($(this).val()) > 10 || parseFloat($(this).val()) < notaMinima){
			$(this).val("0");
			return;
		}else{
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
				beforeSend: function () {
					$('#lblCargando').removeClass( "lblCargando-error" );
					$('#lblCargando').addClass( "lblCargando" );
					$('#lblCargando').text('Subiendo notas...').show();
				},
				error: function (xhr, status, error) {
					var response = JSON.parse(xhr.responseText)
					$.each(response, function (index, value) {
						$('#lblCargando').text('Ingrese por favor un numero').show();
						$('#lblCargando').addClass( "lblCargando-error" );
					});
				}
			});
			calcular();
			// cargarPromedios();
		}
	});
calcular()

</script>
@endsection
