@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12">
            <h2 class="title-page">Horario de Clases</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <form method="post" action="{{ route('crearHora2') }}">
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
                                            <input type="time" class="form-control" name="horaInicio">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right bold">Hora Fin</td>
                                        <td>
                                            <input type="time" class="form-control" name="horaFin">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right bold">Lunes</td>
                                        <td>
                                            <select class="form-control" name="idDia1">
                                                <option value="">Seleccione una materia </option>
                                                @foreach($matters as $matter)
                                                    
                                                    <option value="{{ $matter->id }}">
                                                        {{ $matter->nombre}} -
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
                                            <select class="form-control" name="idDia2">
                                                <option value="">Seleccione una materia </option>
                                                @foreach($matters as $matter)
                                                    
                                                    <option value="{{ $matter->id }}">
                                                        {{ $matter->nombre}} - 
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
                                            <select class="form-control" name="idDia3">
                                                <option value="">Seleccione una materia </option>
                                                @foreach($matters as $matter)
                                                    
                                                    <option value="{{ $matter->id }}">
                                                        {{ $matter->nombre}} -
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
                                            <select class="form-control" name="idDia4">
                                                <option value="">Seleccione una materia </option>
                                                @foreach($matters as $matter)
                                                    
                                                    <option value="{{ $matter->id }}">
                                                        {{ $matter->nombre}} - 
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
                                            <select class="form-control" name="idDia5">
                                                <option value="">Seleccione una materia </option>
                                                @foreach($matters as $matter)
                                                    
                                                    <option value="{{ $matter->id }}">
                                                        {{ $matter->nombre}} - 
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
                                            <select class="form-control" name="idDia6">
                                                <option value="">Seleccione una materia </option>
                                                @foreach($matters as $matter)
                                                    
                                                    <option value="{{ $matter->id }}">
                                                        {{ $matter->nombre}} - 
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
                <input type="submit" value="GUARDAR" class="btn btn-success">
            </div>
        
        </form>

    </div>
</div>
@endsection
