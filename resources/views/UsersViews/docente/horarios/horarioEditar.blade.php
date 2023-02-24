@extends('layouts.master') @section('content')
<a class="button-br" href="{{route('horario_Docente')}}">
    <button>
        <img src="../../img/return.png" alt="" width="17">Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12">
            <h2 class="title-page">Horario de Clases</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <form method="post" action="{{ route('actualizarHoraClaseDocente', $data->id) }}">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-lg-12">
                <div class="white-bg p-1">
                    <div class="pined-table-responsive">
                        <table class="s-calificaciones w100">
                            <tr class="table__bgBlue">
                                <td width="150" class="no-border text-center scheduler">Día</td>
                                <td class="no-border text-center scheduler">Materia</td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Hora inicio</td>
                                <td>
                                    <input type="time" class="form-control" name="horaInicio" value="{{ $data->horaInicio }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Hora Fin</td>
                                <td>
                                    <input type="time" class="form-control" name="horaFin" value="{{ $data->horaFin }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Lunes</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia1">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia1 ) ? ' selected' : '' }}>{{ $matter->nombre}} - 
                                                    @foreach( $courses as $course)
                                                        @if( $course->id == $matter->idCurso)
                                                            {{ $course->grado}} 
                                                            {{ $course->paralelo }}
                                                            {{ $course->especializacion }}
                                                        @endif
                                                    @endforeach 
                                                </option>
                                                 
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Martes</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia2">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia2 ) ? ' selected' : '' }}>{{ $matter->nombre}} - 
                                                    @foreach( $courses as $course)
                                                        @if( $course->id == $matter->idCurso)
                                                            {{ $course->grado}} 
                                                            {{ $course->paralelo }}
                                                            {{ $course->especializacion }}
                                                        @endif
                                                    @endforeach 
                                                </option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Miércoles</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia3">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia3 ) ? ' selected' : '' }}>{{ $matter->nombre}} - 
                                                    @foreach( $courses as $course)
                                                        @if( $course->id == $matter->idCurso)
                                                            {{ $course->grado}} 
                                                            {{ $course->paralelo }}
                                                            {{ $course->especializacion }}
                                                        @endif
                                                    @endforeach  
                                                </option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Jueves</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia4">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia4 ) ? ' selected' : '' }}>{{ $matter->nombre}} - 
                                                    @foreach( $courses as $course)
                                                        @if( $course->id == $matter->idCurso)
                                                            {{ $course->grado}} 
                                                            {{ $course->paralelo }}
                                                            {{ $course->especializacion }}
                                                        @endif
                                                    @endforeach 
                                                </option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Viernes</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia5">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia5 ) ? ' selected' : '' }}>{{ $matter->nombre}} - 
                                                    @foreach( $courses as $course)
                                                        @if( $course->id == $matter->idCurso)
                                                            {{ $course->grado}} 
                                                            {{ $course->paralelo }}
                                                            {{ $course->especializacion }}
                                                        @endif
                                                    @endforeach  
                                                </option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Sábado</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia6">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia6 ) ? ' selected' : '' }}>{{ $matter->nombre}} - 
                                                    @foreach( $courses as $course)
                                                        @if( $course->id == $matter->idCurso)
                                                            {{ $course->grado}} 
                                                            {{ $course->paralelo }}
                                                            {{ $course->especializacion }}
                                                        @endif
                                                    @endforeach  
                                                </option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="text-left mt-1">
            <input type="submit" value="ACTUALIZAR" class="btn btn-success">
        </div>
        </form>
    </div>
</div>
@endsection