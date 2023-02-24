@extends('layouts.master')
@section('content')
@php
$permiso = App\Permiso::desbloqueo('admin.asistenciaMateria.index');
@endphp
	@if ($admin === true)
		<a class="button-br"
			href="{{route('admin.asistenciaMateria.index')}}">
			<button>
				<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
			</button>
		</a>
	@endif
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-xs-12 seleccion-curso">
                <h2 class="title-page">Seleccione una Materia</h2>
                @if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
                <form action="{{route('listadoAsistenciageneral')}}" method="POST" >
                    {{ csrf_field() }}
                <div class="flex">
                <div>
                    <label for="">Seleccione:</label>
                    @if ($admin === true)
                       <input type="hidden" name="idCurso" value="{{$cursos[0]->id}}" placeholder="">
                    @else
                       <!-- <input type="text" name="idCurso[]" value="{{$cursos->unique('id')->pluck('id')}}" placeholder="">-->
                        <select name="idCurso"  class="form-control" >
                        @foreach ($cursos->unique('id') as $curso_id)
                        <option value="{{$curso_id->id}}">{{$curso_id->grado}}-{{$curso_id->paralelo}}</option>
                        @endforeach
                    </select>
                    @endif
                        <select name="idMateria"  class="form-control" >
                        <option value="">TODAS LAS MATERIAS</option>
                        @foreach ($cursos as $curso)
                            <option value="{{$curso->materiaId}}">{{$curso->materia}}-{{$curso->paralelo}} </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">Fecha desde:</label>
                    <input type="date" name="desde" class="form-control" >
                </div>
                <div class="flex">
                    <div>
                        <label for="">Fecha hasta:</label>
                        <input type="date" name="hasta" class="form-control" >
                    </div>
                    <div>
                        <label for=""></label>
                        <button type="submit" class="ml-6 mt-0 mb-0 btn btn-success">
                            <i class="fa fa-download"></i>
                        </button>
                    </div>
                </div>
                </div>
                </form>
                @endif
                </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
				@foreach($cursos->groupBy('grado') as $key => $cursos)
					<h3 class="a-btn__cursos"> {{$key}} </h3>
					<div class="a-matricula__estudiantes">
						@foreach ($cursos as $curso)
							@php
								$course = App\Course::find($curso->id);
								$schedule = $course->schedules()->where('dia'.$day, $curso->materiaId)->first();
								$asistencia = App\DailyAssistance::where('idCurso', $course->id)->get();
								$materia = App\Matter::find($curso->materiaId);
                            @endphp
							<a href="{{route('docente.asistenciaMateria.materia', [$curso->id, $curso->materiaId, 'fecha='.$fecha, 'tutor='.$tutor])}}">
								<div class="text-center d-asistencia__card">
									<div class="docAsistencia">
											<img class="mr-05" src="{{secure_asset('img/curso.svg')}}" width="16">
										<h3 class="text-center mb-1">
											{{$curso->materia}}
										</h3>
									</div>
									@if ($admin === !true)
										<p>
											{{$curso->especializacion}} {{$curso->paralelo}}
										</p>
									@endif
								</div>
							</a>
						@endforeach
					</div>
				@endforeach
            </div>
        </div>
    </div>
@endsection