@extends('layouts.master')
@section('content')
<style>
.icon__enviar-mensaje {
    font-size: 18px;
    color: #1c84c6;
    border: none;
}
.sb{
    border-bottom: 0px !important;
}
</style>
<a class="button-br" href="{{ route('grade_score_course',['id' => $course->id, 'parcial' => $parcial ]) }}">
    <button> <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar </button>
</a>

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
	<div class="row wrapper white-bg mb-1">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">
				<i class="fa fa-edit icon__title text-color3"></i>
				Calificaciones
			</h2>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
                    <a href="{{ route('grade_score_course',['id' => $course->id, 'parcial' => $parcial ]) }}">
                        {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
                    </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a class="no-pointer"> {{$matter->nombre}} </a>
				</div>
			</div>
		</div>
	</div>
    <div class="row wrapper white-bg p-1 mb-05">
        <div class="col-xs-12 titulo-separacion">
			<h3 class="title-page">
				<p class="mb-05">Dirigente:
					@if($teacher !=null)
						<span class="not">
							{{ $teacher->nombres }} {{ $teacher->apellidos }}
						</span>
					@endif
				</p>
				@if ($teacher2 != null)
					<p class="mb-0">Docente:
						<span class="not"> {{$teacher2->apellidos}} {{$teacher2->nombres}} </span>
					</p>
				@endif
			</h3>
            <div class=" calificaciones__materia__select flex">
                <a class="btn btn-primary text-white mb-3 rutaMateria"
                    href="{{ route('reporteActaCalificacion',['id' => $idMateria, 'parcial' => $parcialPrueba ]) }}">
                    
                    Acta de Calificaciones
                </a>
               
     
                <a class="btn btn-success text-white mb-3"
                    href="{{ route('actaGlobal', $idMateria).'?parcial='.$parcial }}">
                    Acta Global de Calificaciones
                </a>
                    <!--<select class="select__header form-control" id="selParciales">
                        @foreach($unidad as $und)
                            <optgroup label="{{$und->nombre}}">
                                @php
                                    $parcialP = App\ParcialPeriodico::parcialP($und->id);
                                @endphp
                                @foreach($parcialP as $par )
                                    <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                                    <option value="recuperatorio" ciclo="{{$par->id}}">Recuperatorio</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>-->
                    <select class="select__header form-control" id="selParciales">
                        @foreach($unidad as $und)
                            <optgroup label="{{$und->nombre}}">
                                @php
                                    $parcialP = App\ParcialPeriodico::
                                    where('activo',1)->
                                    where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->
                                    get();
                                @endphp
                                @foreach($parcialP as $par )
                                    <option hidden value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}}> {{$par->nombre}} </option>
                                @endforeach
                                <option value="recuperatorio" ciclo="{{($parcialP->first())->id}}">Recuperación</option>
                            </optgroup>
                        @endforeach
                    </select>

                <div>
                    @if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
				        @if($course->seccion != "EI")
					        <div class="dropdown">
						        <button class="bg-none border-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							        <img class="w-8" src="{{secure_asset('img/file-download.svg')}}" alt="">
						        </button>
						        <div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownMenuButton" >
							        <div class="calificaciones__dropDown-grid">
                                        {{--<a target="_blank" class="calificaciones__dropDown__item-link"  href="{{ route('actaCalificaciones', ['materia' => $matter->id, 'parcial' => $parcial]) }}">
                                            <img src="{{secure_asset('img/file-download-white.svg')}}" width="12"> Acta de calificaciones
                                        </a>--}}
                                        <a class="calificaciones__dropDown__item-link" target="_blank" class="dropdown-item"  href="{{ route('actaParcialMateria', ['course' => $course->id, 'parcial' => $parcial, 'materia' => $matter->id]) }}">
                                            Acta de calificaciones
                                        </a>
                                        <a target="_blank" class="calificaciones__dropDown__item-link" style="width:auto" href="{{ route('RefuerzoAcademicoReporte', ['matter' => $matter->id, 'parcial' => $parcial]) }}">
                                            <img src="{{secure_asset('img/file-download-white.svg')}}" width="12"> Refuerzos Academicos
                                        </a>
                                        {{-- <a target="_blank" class="calificaciones__dropDown__item-link" style="width:auto" href="{{route('reporteActaDeControlDeInsumos', [$matter, $parcial])}}">
                                            <img src="{{secure_asset('img/file-download-white.svg')}}" width="12"> Acta de control de Insumos
                                        </a> --}}
							        </div>
						        </div>
					        </div>
                        @endif
                        <div>
                            <div class="dropdown">
                                <button class="bg-none border-none dropdown-toggle" type="button" id="dropdownAdjuntos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Descargar Adjuntos">
                                    <img class="w-8" src="{{secure_asset('img/file-download.svg')}}" alt="">
                                </button>
                                <div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownAdjuntos" >
                                    <div class="calificaciones__dropDown-grid">
                                        @foreach($Supplies as $key => $supply)
                                            @php
                                                $rutaDescarga ='/curso_'.$course->id.'/'.substr($matter->nombre, 0 ,25).'/parcial_'.$parcial.'/Insumo_'.$supply->id;
                                            @endphp
                                            <form action="{{route('descargarAdjuntos')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input name="rutaDescarga" type="hidden" value="{{$rutaDescarga}}">
                                                <input name="nombreDescarga" type="hidden" value="{{$supply->nombre}}">
                                                <button type="submit" class="icon__enviar-mensaje" style="background: none; font-size: 15px">{{$supply->nombre}}</button>
                                            </form>
                                        @endforeach
                                        @php
                                          $rutaDescargaParcial ='/curso_'.$course->id.'/'.substr($matter->nombre, 0 ,25).'/parcial_'.$parcial;
                                          $rutaDescargaMateria ='/curso_'.$course->id.'/'.substr($matter->nombre, 0 ,25);
                                        @endphp
                                        <form action="{{route('descargarAdjuntos')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input name="rutaDescarga" type="hidden" value="{{$rutaDescargaParcial}}">
                                            <input name="nombreDescarga" type="hidden" value="{{$parcial}}">
                                            <button type="submit" class="icon__enviar-mensaje" style="background: none; font-size: 15px">PARCIAL: {{$parcial}}</button>
                                        </form>
                                        <form action="{{route('descargarAdjuntos')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input name="rutaDescarga" type="hidden" value="{{$rutaDescargaMateria}}">
                                            <input name="nombreDescarga" type="hidden" value="{{$matter->nombre}}">
                                            <button type="submit" class="icon__enviar-mensaje" style="background: none; font-size: 15px">MATERIA</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
	</div>
    <div class="dir-calificaciones" id="alumnos">
       <div class="row white-bg p-1">
            <div class="table-responsive">
                <div class="col-xs-12">
                    <div class="d-parciales__notas">
                        <div class="d-parciales__notas--estudiantes d-resaltado__alumnos border3__inv">
                            <p class="d-parciales__notas--estudiantes--titulo" style="font-size: 20px">Estudiantes</p>
                            @foreach($Students as $student)
                                <p class="d-parciales__notas--numero">{{$loop->iteration}}</p>
                                <p class="d-parciales__notas--nombre" style="text-transform: uppercase;">
                                    {{$student->apellidos}}, {{$student->nombres}}
                                    
                                </p>
                            @endforeach
                        </div>
                        @foreach($Supplies as $key => $supply)
                            <div class="d-parciales__notas--tareas d-resaltado__nota-3">
                                <a href="#" id_supply="{{ $supply->id }}" class="insumoEnlace">
                                    <p class="d-parciales__notas--tareas--titulo">
                                        {{$supply->nombre}}
                                        <i class=" ml-1 fa fa-pencil"></i>
                                    </p>
                                </a>
                                <p class="d-parciales__notas--pro">Pro</p>
                                @foreach($Students as $student)
                                    @php
                                        $std = $data->where('estudianteId', $student->idStudent)->first();
                                        $mats = new \Illuminate\Support\Collection($std->parcial);
                                        $mat = $mats->where('materiaId',  $matter->id)->first();
                                        $supps = new \Illuminate\Support\Collection($mat->insumos);
                                        $promedios = $supps->where('insumoId',  $supply->id)->first();
                                    
                                    @endphp
                                    <p class="d-parciales__notas--nota prEstudiante{{$key}} relative" est_id="{{$student->idStudent}}">
                                        {{ bcdiv($promedios->nota, '1', 2) }}
                                        @if($promedios->refuerzo != 0)
                                            <a class="calificaciones__iconInsumo" href="">
                                                <img class="calificaciones__iconInsumo-r" src="{{secure_asset('img/insumo_hecho.svg')}}" width="14">
                                                {{ bcdiv($promedios->refuerzo, '1', 2) }}
                                            </a>
                                        @endif
                                    </p>
                                @endforeach
                            </div>
                        @endforeach
                        <div class="d-parciales__notas--tareas d-resaltado__nota-3"  id="promEstudiantes">
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
                                    $mat = $mats->where('materiaId',  $matter->id)->first();
                                   
                                @endphp
                                <p class="d-parciales__notas--nota">
                                {{ bcdiv($mat->promedioFinal, '1', 2) }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                    {{-- @if($course->seccion =="EI")
                        <div class="d-parciales__notas" >
                            <div class="d-parciales__notas--estudiantes d-resaltado__alumnos border3__inv">
                                <p class="d-parciales__notas--estudiantes--titulo">Estudiantes</p>
                                @foreach($Students as $student)
                                <p class="d-parciales__notas--numero">{{$loop->iteration}}</p>
                                <p class="d-parciales__notas--nombre" style="text-transform: uppercase;">
                                    {{$student->apellidos}}, {{$student->nombres}}
                                        
                                </p>
                                @endforeach
                            </div>
                            @foreach($destrezas as $destreza)
                            <div class="d-parciales__notas--tareas d-resaltado__nota-3">
                                <a href="#" >
                                    <p class="d-parciales__notas--tareas--titulo">
                                        @if(strlen($destreza->nombre) >15 )
                                            {{ substr($destreza->nombre, 0 ,15)."..." }}
                                        @else
                                            {{$destreza->nombre }}
                                        @endif
                                        <i class=" ml-1 fa fa-pencil"></i>
                                    </p>
                                </a>
                                <p class="d-parciales__notas--pro">Pro</p>
                                @foreach($Students as $sudent)
                                    @php
                                        $jsonSupply = json_decode( $destreza->calificacion );
                                        $notaDestreza = "";
                                        foreach($jsonSupply as $key => $json){
                                            if($key == $student->idStudent)
                                                $notaDestreza = $json;
                                        }
                                    @endphp
                                    <p class="d-parciales__notas--nota prEstudiante0 relative" est_id="579">
                                        {{ $notaDestreza }}
                                        <a class="calificaciones__iconInsumo" href="">
                                            <img class="calificaciones__iconInsumo-r" style="display:none;" src="//localhost:3000/pined/public/img/insumo_hecho.svg" width="14">
                                            <img class="calificaciones__iconInsumo-f" style="display:none;" src="//localhost:3000/pined/public/img/insumo_falta.svg" width="14">
                                        </a>
                                    </p>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#selParciales').change( function() {
        var id = "{{$matter->id}}";
        if($('#selParciales').val() == "q1"   || $('#selParciales').val() == "q2"){
            window.location.href = "{{ route('examenQuimestral',[ 'materia' => $matter->id]) }}"+ "/" +  $('#selParciales').val();
        }else if($('#selParciales').val() == "recuperatorio"){
            let ciclo = $('option:selected', $('#selParciales')).attr('ciclo');

            
            window.location.href = "{{ route('recuperacionesAdmin',[ 'idMateria' => $matter->id, 'idCurso' => $course->id, '', '' ]) }}"+ "/" + ciclo + "/" + "{{$parcial ? $parcial : null}}";
        }else{
            window.location.href = "{{ route('grade_score_course_matter') }}/" + id + "/" +  $('#selParciales').val();
            $('.insumoEnlace').each(function () {
                let id = $(this).attr('id_supply');
                $(this).attr('href',"{{route('InsumoAdmin')}}/{{$matter->id}}/" + id + "/" +  $('#selParciales').val());
            })
        }
    });

    $('.insumoEnlace').each(function () {
        let id = $(this).attr('id_supply');
        $(this).attr('href',"{{route('InsumoAdmin')}}/{{$matter->id}}/" + id + "/" +  $('#selParciales').val());
    })

    
</script>
<script>

    function actaCalificaciones(id,ciclo){
        console.log(id, ciclo);
       
      //  $(this).attr('href', ruta + '/' + materia + '/' + seleccion);
                
    }
</script>
@endsection