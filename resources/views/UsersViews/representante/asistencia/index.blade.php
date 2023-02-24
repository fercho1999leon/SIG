@extends('layouts.master')
@section('content')
<a class="button-br" href="{{route('hijo',['hijo' =>  $hijo->idStudent])}}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper border-bottom white-bg"  style="background: #ebebed">
            <div class="row wrapper border-bottom white-bg">
                <div class="repProfileHijo--cont">
                    <figure class="repProfileHijo__resumen--img">
                        <img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
                    </figure>
                    <div class="repProfileHijo__resumen--info">
                        <h3 class="repProfileHijo__resumen--name">{{$hijo->nombres}} {{$hijo->apellidos}}</h3>
                        <hr>
                        <div class="repProfileHijo__resumen--curso">
                            <h4><strong>Curso: </strong> {{ $course->grado}} {{ $course->paralelo}} {{ $course->especializacion}}</h4>
                            <h4><strong>Dirigente: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif</h4>
                        </div>
                    </div>
                </div>
			</div>
            <div class="row mt-1">
                <div class="col-xs-12">
                    @foreach ($unidad as $quimestre)
                        <h3 class="a-btn__cursos">{{$quimestre->nombre}}</h3>
						<div class="r-asistenciahijo-grid">
                            @php
                                $parciales = $parcialP->where('idUnidad', $quimestre->id)->where('identificador', '!=', 'q1')->where('identificador', '!=', 'q2');
                            @endphp
                            @foreach ($parciales as $parcial)
								<div class="r-asistenciahijo-item">
									<p class="table__bgBlue">{{$parcial->nombre}}</p>
									<p class="r-asistenciahijo-dia">
										Atraso: {{$hijo->asistenciaParcial($parcial->identificador)->atrasos}}
									</p>
									<p class="r-asistenciahijo-dia">
										Falta Justificada: {{$hijo->asistenciaParcial($parcial->identificador)->faltas_justificadas}}
									</p>
									<p class="r-asistenciahijo-dia">
										Falta Injustificada: {{$hijo->asistenciaParcial($parcial->identificador)->faltas_injustificadas}}
									</p>
								</div>
							@endforeach
						</div>
					@endforeach
                </div>
            </div>
        </div>
    </div>
@endsection