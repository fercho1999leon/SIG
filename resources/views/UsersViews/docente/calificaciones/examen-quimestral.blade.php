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
        <h1 class="title-page"> {{$matter->nombre}}</h1>
        <h2 class="title-page"><i class="fa fa-edit icon__title text-color3">
			</i> Examen del Quimestre
        </h2>
        <select class="select__header form-control" id="mySelect">
            @foreach($unidad as $und)
                <option value="{{$und->identificador}}" {{$und->identificador == $quimestre ? 'selected' : ''}}>
                    {{$und->nombre}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="wrapper wrapper-content dir-calificaciones mb350" id="alumnos">
        <!-- Todas Las Materias -->
        <div>
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones">
                        <tr>
                            <td colspan="2"  class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            @foreach($parcialP as $par)
                                <td class="text-center bold uppercase">{{($par->identificador == 'q2' || $par->identificador == 'q1') ? 'EX' : substr($par->identificador, 0, 2)}}</td>
                            @endforeach
                            <td class="text-center bold uppercase"> promedio</td>
                        </tr>
                        @foreach($students as $student)
						<tr>
							<td class="text-center">{{ $loop->iteration }}</td>
							<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
                            @php
                                $promedio = $data->where('estudianteId', $student->idStudent)->first();
                                $materiap = new \Illuminate\Support\Collection($promedio->materias);
                                $promediosP = $materiap->where('materiaId', $matter->id)->first();
                                $parcialesp = new \Illuminate\Support\Collection($promediosP->parciales);
                                $examenq = $parcialesp->where('indicador', $quimestre)->first();
                            @endphp
                            @foreach($parcialesp as $prom)
                                @if(strlen($prom->indicador) != 2)
                                    <td class="text-center">
                                        {{ bcdiv($prom->promediop, '1', 2) }}
                                    </td>
                                @endif
                            @endforeach
							<td>
								<input type="text"
                                    student_id="{{ $student->idStudent}}" supply_id="{{$supply->id}}"
                                    name="{{route('calificacionesUpdate',['activity' => $activity->id,'student' =>  $student->idStudent])}}"
                                    class="form-control inputQuimestral__note actualizarNota" value="{{$examenq->promediop}}"
                                    @if (($examenq->promediop > 0) && ($editar->valor == 0)) disabled @endif
                                >
							</td>
							<td class="text-center" id="total{{$student->idStudent}}">
                                @if($examenq->promediop != 0)
                                    {{$promediosP->promedioquimestral}}
                                @endif
                            </td>
						</tr>
                        @endforeach
                    </table>
				</div>
				<div class="text-center">
					<a href="{{route('examenQuimestralD',['materia' => $matter->id, 'quimestre' => $quimestre ]) }}" class="btn btn-success btn-lg">Guardar</a>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#mySelect').change( function() {
        var id = "{{$matter->id}}";
        window.location.href = "{{ route('examenQuimestralDocente',[ 'materia' => $matter->id]) }}"+ "/" +  $('#mySelect').val();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
        }
    });
</script>
@endsection
