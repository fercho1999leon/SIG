@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<a class="button-br" href="{{route('calificaciones', $parcial)}}">
    <button>
        <img src="../../../img/return.png" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 titulo-separacion">
			<h3 class="title-page">
				<p class="mb-05">Dirigente:
					<!--  Muestra nombres y appelidos del tutor-->
					@if($Course->idProfesor !=null)
					<span class="not">
                            @foreach($teachers as $teacher)
                                @if($teacher->id==$Course->idProfesor)
                                    {{ $teacher->nombres }} {{ $teacher->apellidos }}
                                @endif
                            @endforeach
						</span>
					@endif
				</p>
				<p class="mb-05">Curso:
					<span class="not">{{$Course->grado}} {{$Course->paralelo}} {{$Course->especializacion}}</span>
				</p>
				<p class="mb-0">Materia:
					<span class="not">{{$Matter->nombre}}</span>
				</p>
		    </h3>
			<div class="flex">
				<select class="selectpicker form-control  select__header" id="selParciales">
                    @foreach($unidad as $und)
                        <optgroup label="{{$und->nombre}}">
                            @php
                                $parcialP = App\ParcialPeriodico::parcialP($und->id);
                            @endphp
                            @foreach($parcialP as $par)
                                @if(($par->identificador == 'q1') || ($par->identificador == 'q2'))
                                @else
                                    <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                    <optgroup label="Examenes">
                        @if($ingresa_examen->valor == '1')
                            <option value="q1">Q1 - Examen</option>
                        @endif
                        @if($ingresa_examen->valor == '1')
                            <option value="q2">Q2 - Examen</option>
                        @endif
                    </optgroup>
                    @if($ingresa_recuperacion->valor == '1')
                    <optgroup label="Recuperatorio">
                            <option value="recuperatorio">Recuperatorio</option>
                    </optgroup>
                    @endif
                </select>
				<div class="dropdown">
					<button class="bg-none border-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img class="w-8" src="{{secure_asset('img/file-download.svg')}}" alt="">
					</button>
					<div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownMenuButton" >
						<div class="calificaciones__dropDown-grid">
							{{--<a class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item"  href="{{ route('actaCalificaciones', ['materia' => $Matter->id, 'parcial' => $parcial]) }}">
								Acta de calificaciones Parcial
							</a>--}}
                            <a class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item"  href="{{ route('actaParcialMateria', ['course' => $Course->id, 'parcial' => $parcial, 'materia' => $Matter->id]) }}">
								Acta de calificaciones
							</a>
							<a class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item"  href="{{ route('RefuerzoAcademicoReporte', ['materia' => $Matter->id, 'parcial' => $parcial]) }}">
								Refuerzos Academicos
							</a>
                            <a class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item"  href="{{ route('reportePromediosDocente', ['idMateria' => $Matter->id]) }}">
								Acta de Calificaciones Anual
							</a>
						</div>
					</div>
				</div>
                    <div class="dropdown">
                                <button class="bg-none border-none dropdown-toggle" type="button" id="dropdownAdjuntos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Descargar Adjuntos">
                                    <img class="w-8" src="{{secure_asset('img/file-download.svg')}}" alt="">
                                </button>
                                <div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownAdjuntos" >
                                    <div class="calificaciones__dropDown-grid">
                                        @foreach($Supplies as $key => $supply)
                                        @php
                                        $rutaDescarga ='/curso_'.$Course->id.'/'.substr($Matter->nombre, 0 ,25).'/parcial_'.$parcial.'/Insumo_'.$supply->id;

                                        @endphp
                                            <form action="{{route('descargarAdjuntos')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input name="rutaDescarga" type="hidden" value="{{$rutaDescarga}}">
                                                <input name="nombreDescarga" type="hidden" value="{{$supply->nombre}}">
                                                <button type="submit" class="icon__enviar-mensaje" style="background: none; font-size: 15px; border: none;">{{$supply->nombre}}</button>
                                            </form>
                                        @endforeach
                                        @php
                                          $rutaDescargaParcial ='/curso_'.$Course->id.'/'.substr($Matter->nombre, 0 ,25).'/parcial_'.$parcial;
                                          //dd($rutaDescargaParcial);
                                          $rutaDescargaMateria ='/curso_'.$Course->id.'/'.substr($Matter->nombre, 0 ,25);
                                        @endphp
                                        <form action="{{route('descargarAdjuntos')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input name="rutaDescarga" type="hidden" value="{{$rutaDescargaParcial}}">
                                                <input name="nombreDescarga" type="hidden" value="{{$parcial}}">
                                                <button type="submit" class="icon__enviar-mensaje" style="background: none; font-size: 15px; border: none;">PARCIAL: {{$parcial}}</button>
                                            </form>
                                            <form action="{{route('descargarAdjuntos')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input name="rutaDescarga" type="hidden" value="{{$rutaDescargaMateria}}">
                                                <input name="nombreDescarga" type="hidden" value="{{$Matter->nombre}}">
                                                <button type="submit" class="icon__enviar-mensaje" style="background: none; font-size: 15px; border: none;">MATERIA</button>
                                            </form>
                                    </div>
                            </div>
                </div>
			</div>
        </div>
    </div>
    <div class="wrapper wrapper-content dir-calificaciones" id="alumnos">
        <div class="row white-bg p-1">
            <div class="table-responsive">
                <div class="col-xs-12">
                    <div class="d-parciales__notas">
                        <div class="d-parciales__notas--estudiantes d-resaltado__alumnos border3__inv">
                            <p class="d-parciales__notas--estudiantes--titulo">Estudiantes</p>
                            <!-- foreach se muestra los estudiantes del curso -->
                            <!-- Se muestra el #(este corresponde a un orden) del estudiante, apellidos y nombres -->
                            @foreach($Students as $student)
                                <p class="d-parciales__notas--numero">{{$loop->iteration}}</p>
                                <p class="d-parciales__notas--nombre" style="text-transform: uppercase;">
                                    {{$student->apellidos}}, {{$student->nombres}}
                                    @if($student->nivelDeIngles!=null  && $Matter->area == 'LENGUA EXTRANJERA')
                                        <strong>{{$student->nivelDeIngles}}</strong>
                                    @endif
                                </p>
                            @endforeach
                            <!-- endforeach -->
                        </div>
                        @foreach($Supplies as $key => $supply)
                        <div class="d-parciales__notas--tareas d-resaltado__nota-3">
                            <!-- foreach de los insumos -->
                            <a href="#"
                            @if($supply->es_aporte)
                                @if($ingresa_evaluacion->valor == '1')
                                    id_supply="{{ $supply->id }}" class="insumoEnlace"
                                @endif
                            @else
                                id_supply="{{ $supply->id }}" class="insumoEnlace"
                            @endif
                            >
                                <p class="d-parciales__notas--tareas--titulo">{{$supply->nombre}}
                                    <i class=" ml-1 fa fa-pencil"></i>
                                </p>
                            </a>
                            <p class="d-parciales__notas--pro">Pro</p>
                            <!-- foreach se haze un recorrido de las notas -->
                            <!-- Se muestra el promedio, no es editable -->
                            @foreach($Students as $student)
                                @php
                                    $std = $data->where('estudianteId', $student->idStudent)->first();
                                    $mats = new \Illuminate\Support\Collection($std->parcial);
                                    $mat = $mats->where('materiaId',  $Matter->id)->first();
                                    $supps = new \Illuminate\Support\Collection($mat->insumos);
                                    $promedios = $supps->where('insumoId',  $supply->id)->first();
                                @endphp
                                <p class="d-parciales__notas--nota prEstudiante{{$key}}" est_id="{{$student->idStudent}}">
                                    {{ bcdiv($promedios->nota, '1', 2) }}
                                    @if($promedios->refuerzo != 0)
								        <span class="calificaciones__iconInsumo no-border ml-2">
                                            <img class="calificaciones__iconInsumo-r" src="{{secure_asset('img/insumo_hecho.svg')}}" width="14">
                                            {{ bcdiv($promedios->refuerzo, '1', 2) }}
                                        </span>
                                    @endif
                                </p>
                            @endforeach
                            <!-- endforeach -->
                            <input type="hidden" value="{{ $supply->p1q1 }}" id="promedio{{$key}}p1q1">
                            <input type="hidden" value="{{ $supply->p2q1 }}" id="promedio{{$key}}p2q1">
                            <input type="hidden" value="{{ $supply->p3q1 }}" id="promedio{{$key}}p3q1">
                            <input type="hidden" value="{{ $supply->p1q2 }}" id="promedio{{$key}}p1q2">
                            <input type="hidden" value="{{ $supply->p2q2 }}" id="promedio{{$key}}p2q2">
                            <input type="hidden" value="{{ $supply->p3q2 }}" id="promedio{{$key}}p3q2">
                        </div>
						@endforeach
                        <input type="hidden" name="PromedioInsumo" id="PromedioInsumo" value="{{$PromedioInsumo->valor}}">
                            <div class="d-parciales__notas--tareas d-resaltado__nota-3" id="por_real" style="display:none;">
                            <!-- foreach de los insumos -->
                            <a href="#">
                                <p class="d-parciales__notas--tareas--titulo">
                                    PROMEDIO
                                </p>
                            </a>
                            <p class="d-parciales__notas--pro">Pro</p>
                            @foreach ($Students as $student)
                                @foreach ($data->where('estudianteId', $student->idStudent) as $d)
                                    @foreach ($d->parcial as $parcial)
                                        @if($parcial->materiaId == $Matter->id)
                                            <p class="promedio-real" style="text-align: center"></p>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                            </div>
                            <div class="d-parciales__notas--tareas d-resaltado__nota-3"  id="promEstudiantes">
                            <!-- foreach de los insumos -->
                            <a href="#">
                                <p class="d-parciales__notas--tareas--titulo">
                                    PROMEDIO
                                </p>
                            </a>
                            <p class="d-parciales__notas--pro">Pro</p>
                            @foreach ($Students as $student)
                                @php
                                    $std = $data->where('estudianteId', $student->idStudent)->first();
                                    $mats = new \Illuminate\Support\Collection($std->parcial);
                                    $mat = $mats->where('materiaId',  $Matter->id)->first();
                                @endphp
                                <p class="d-parciales__notas--nota">{{ bcdiv($mat->promedioFinal, '1', 2)}}</p>
                            @endforeach
						</div>
						<input type="hidden" value="{{ count($Supplies) }}" id="cantidadInsumos">
						<input type="hidden" value="{{ count($Students) }}" id="cantidadEstudiantes">
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
	$('#selParciales').change( function() {
        var id = "{{$Matter->id}}";
        if($('#selParciales').val() == "q1"   || $('#selParciales').val() == "q2"){
            window.location.href = "{{ route('examenQuimestralDocente',[ 'materia' => $Matter->id]) }}"+ "/" +  $('#selParciales').val();
        }else if($('#selParciales').val() == "recuperatorio"){
            window.location.href = "{{ route('recuperacionesDocente',[ 'idMateria' => $Matter->id, 'idCurso' => $Course->id]) }}";
        }else{
            window.location.href = "{{ route('verMateria') }}/" + id + "/" +  $('#selParciales').val();
            $('.insumoEnlace').each(function () {
                let id = $(this).attr('id_supply');
                $(this).attr('href',"{{route('DocentesInsumo')}}/{{$Matter->id}}/" + id + "/" +  $('#selParciales').val());
            })
        }
    });

    $('.insumoEnlace').each(function () {
        let id = $(this).attr('id_supply');
        $(this).attr('href',"{{route('DocentesInsumo')}}/{{$Matter->id}}/" + id + "/" +  $('#selParciales').val());
    })

    function calc(valor) {
        var num = valor
        var with2Decimals = 0;
        if(!isNaN(num))
            with2Decimals = num.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]
       return with2Decimals;
    }
</script>
@endsection
