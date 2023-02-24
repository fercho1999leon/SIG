@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<a class="button-br" href="{{route('hijo',['hijo' =>  $student->idStudent])}}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div style="background: #ebebed">
        <div >
            <div class="repProfileHijo--cont">
                <figure class="repProfileHijo__resumen--img">
					<img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
                    <div class="represetante__comportamiento__hijo">
                        @if (strlen($parcial)!=2)
                            @if ($comportamiento != null )
                                <h2 class="m-0">
                                    COMPORTAMIENTO: {{$comportamiento->nota}} <br>
                                    <small>{{$comportamiento->observacion}}</small>
                                </h2>
                            @endif <br>
                            @if($course->seccion != "EI"  && $course->grado !="Primero" )
                                <h2 class="m-0">PROMEDIO
                                    {{ strlen($parcial) > 3 ? " PARCIAL:  ".$promediogo->promedio : " QUIMESTRAL:  ".$promediogo->promedioEstudiante }}
                                </h2>
                            @endif
                        @endif
                    </div>
                </figure>
                <div class="repProfileHijo__resumen--info">
                    <h3 class="repProfileHijo__resumen--name">{{$student->nombres}} {{$student->apellidos}}</h3>
                    <hr>
                    <div class="repProfileHijo__resumen--curso">
                        <h4><strong>Curso: </strong> {{ $course->grado}} {{ $course->paralelo}}</h4>
                        {{--<h4><strong>Dirigente: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif</h4>--}}
                    </div>
                    <select class="selectpicker form-control select__header" id="selParciales" style="display: none">
                        @foreach($unidad as $und)
                            <optgroup label="{{$und->nombre}}">
                                @php
                                $parcialP = App\ParcialPeriodico::parcialP($und->id);
                                @endphp
                                @foreach($parcialP as $par )
                                    <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                                @endforeach
                                <option value="{{$und->identificador."Q"}}" {{$und->identificador."Q" == $parcial ? 'selected' : ''}} >{{$und->nombre}}</option>
                            </optgroup>
                        @endforeach
                    </select>
                    @if($mostrar_libreta->valor == '1')
                        {{--@if($course->seccion == "EI"  || $course->grado=="Primero" )
                            @if ( strlen($parcial) >3 )
                                <a target="_blank" href="{{ route('reporteEstudiante', ['idEstudiante' => $student->idStudent, 'idCurso' => $course->id, 'parcial' => $parcial])}}"
                                    class="btn btn-primary">Boletin
                                </a>
                                <a target="_blank" href="{{ route('reporteEstudiante', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $student->idStudent]) }}" class="btn btn-primary">
                                    Boletin 
                                </a>
                                <a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumnoDetallada', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $student->idStudent]) }}" class="btn btn-primary">
                                    Libreta Quimestral Detallada
                                </a>
                            @else
                                <a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumno', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $student->idStudent]) }}" class="btn btn-primary">
                                    Libreta Quimestral
                                </a>
                                <a target="_blank" href="{{ route('libretaQuimestralDestrezasAlumnoDetallada', [ 'idCurso' => $course->id, 'parcial' => $parcial, 'idEstudiante' => $student->idStudent]) }}" class="btn btn-primary">
                                    Libreta Quimestral Detallada
                                </a>
                            @endif
                        @else
                            @if ((strlen($parcial))>3)
                                <a target="_blank" href="{{ route('reporteEstudiante', ['idEstudiante' => $student->idStudent, 'idCurso' => $course->id, 'parcial' => $parcial])}}"
                                    class="btn btn-primary">Libreta Parcial
                                </a>
                                <a target="_blank" href="{{ route('libretaParcialConRefuerzoAlumno', ['idEstudiante' => $student->idStudent, 'parcial' => $parcial]) }}" class="btn btn-primary">
                                    Libretas Parcial-RA
                                </a>
                                <a target="_blank" href="{{ route('libretaQuimestreEstudiante', ['idCurso' => $course->id, 'quimestre' => substr($parcial,2,2), 'idAlumno' => $student->idStudent ]) }}" class="btn btn-primary">
                                    Libreta Quimestral
                                </a>
                                <a target="_blank" href="{{ route('libretaAnualEstudiante', [ 'idAlumno' => $student->id ]) }}" class="btn btn-primary">
                                    Libreta Anual
                                </a>
                            @else
                                <a target="_blank" href="{{ route('libretaQuimestreEstudiante', ['idCurso' => $course->id, 'quimestre' => ( strlen($parcial)==3 ? substr($parcial,0,2) : $parcial ), 'idAlumno' => $student->idStudent ]) }}" class="btn btn-primary">
                                    Libreta Quimestral
                                </a>
                                <a target="_blank" href="{{ route('libretaAnualEstudiante', [ 'idAlumno' => $student->id ]) }}" class="btn btn-primary">
                                    Libreta Anual
                                </a>
                            @endif
                        @endif--}}
                    @endif
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="r-calificacioneshijo-grid">
                @foreach($matters as $matter)
                    @php
                    $struct = ($matter->idEstructura != null);
                    $mgo = $ppp->where('materiaId',$matter->id)->first();

                    if (strlen($parcial) > 3) {
                        $promedios = new \Illuminate\Support\Collection($mgo->insumos);

                    } else {
                        $promedios = new \Illuminate\Support\Collection($mgo->parciales);
                        $examenQuimestral = $promedios->where('indicador',$parcial)->first();
                    }
                    @endphp                   
                    <div class="r-calificacioneshijo-item ibox m-0">
                        <header class="r-calificaciones-header">
                            <img src="{{secure_asset('img/CURSO.svg')}}" class="r-calificaciones-iconCurso" width="16" alt="">
                            <!--@if (strlen($parcial) > 3 )
                                @if($mgo->promedioInicial != $mgo->promedioFinal)
                                    <p class="no-margin rep-ra">R.A.</p>
                                @endif
                            @endif-->
                            <h3 class="r-calificacioneshijo-materia">
                                {{$matter->nombre}}
                            </h3>
                            <hr class="r-calificaciones-hr">
                            <strong class="r-calificaciones-nota">
                                <div></div>
                                
                                @if (!$struct)                         
                                    <div>{{ bcdiv($mgo->promedioFinal, '1', 2) }}</div>
                                @else
                                    <div>{{ ( (strlen($parcial) == 2) ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura, $examenQuimestral->promediop)['nota'] : ((strlen($parcial) > 3) ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura, $mgo->promedioFinal)['nota'] : App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,$mgo->promedioquimestral)['nota'] ) ) }}</div>
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
                            <div class="ibox-content p-0 no-border" >
                             
                                @foreach ($promedios as $supply)
                         
                                    <div class="calificaciones-insumoContainer">
                                        <strong class="r-calificaciones-insumo">
                                          
                                            {{  
                                                 $supply->nombre }} 
                                            @if ($porcentajeInsumos !=0 && (strlen($parcial) == 4) && $supply->porcentaje != 0)
                                                @if (!$struct)
                                                    {{ bcdiv($supply->nota, '1', 2)}}
                                                @else
                                                    @php
                                                        $porcentj = bcdiv( ( bcdiv($supply->nota, '1', 2) * 100) / $supply->porcentaje , '1', 2) ;
                                                    @endphp
                                                    {{ strlen($parcial) == 4 ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura, $porcentj)['nota'] : App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura, $porcentj)['nota'] }}
                                                @endif
                                            @else
                                                @if (!$struct)
                                                    {{ bcdiv($supply->nota, '1', 2) }}
                                                @else
                                                    {{ strlen($parcial) == 4 ? App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,bcdiv($supply->nota, '1', 2))['nota'] : App\rangosCualitativo::getCalificacionCualitativa($matter->idEstructura,bcdiv($supply->promediop, '1', 2))['nota'] }}
                                                @endif
                                            @endif
                                        </strong>
                                        @if (strlen($parcial) == 4)
                                            <div class="text-right">
                                                <a class="getInsumo" href="" route="{{ route('insumoDetalles',['alumno' => $student->idStudent, 'insumo' => $supply->insumoId, 'parcial' => $parcial]) }}">
                                                    @if($supply->refuerzo != 0 )
                                                        <img src="{{secure_asset('img/informacion-boton-red.svg')}}" alt="" width="15">
                                                    @elseif ($supply->refuerzo == 0 )
                                                        <img src="{{secure_asset('img/informacion-boton.svg')}}" alt="" width="15">
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
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="detalleInsumo" tabindex="-1" role="dialog" aria-labelledby=""></div>
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
			$('#detalleInsumo').html(result)
			$('#detalleInsumo').modal('show')
		}, error: function (xhr, status, error) {
			alert('Algo salio mal.')
		}
	});
})
$('#selParciales').change( function() {
	var id = "{{ $student->idStudent }}";
	window.location.href = "{{ route('rutaCalificacion') }}/" +  $('#selParciales').val();
});
</script>
@endsection