@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-8">
            <h2 class="title-page">Opciones:
                <small class="text-color7 bold">
                    @foreach( $courses as $curso )
                        @if( $curso->id==$id)
                            {{ $curso->grado }} {{ $curso->paralelo }}
                            {{ $curso->especializacion }}
                        @endif
                    @endforeach
                </small>
            </h2>
        </div>
    </div>
    <div class="row" style="margin-bottom: 325px">
        <div class="col-lg-12">
            <div class="widget widget-tabs">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">GENERAL</a></li>
                        <li><a data-toggle="tab" href="#tab-2">ESTUDIANTES</a></li>
                        <li><a data-toggle="tab" href="#tab-3">HORARIO</a></li>
                        <li><a data-toggle="tab" href="#tab-4">CLASES</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            @foreach( $courses as $curso )
                                @if( $curso->id==$id)
                                    <table class="table table-bordered" width="75%">
                                        <tbody>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span> Curso </span>
                                                </td>
                                                <td>
                                                    <p class="no-margin">
                                                        {{ $curso->grado }}
                                                        {{ $curso->paralelo }}
                                                        {{ $curso->especializacion }}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span> Aula Asignada </span>
                                                </td>
                                                <td>
                                                    <p class="no-margin">
                                                        @if($curso->idAula ==null)
                                                            NINGUNA
                                                        @else
                                                            $curso->idAula
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                @if($curso->nEstudiantes !=null)
                                                    <td width="25%" class="text-right" style="background: #EDF3F4">
                                                        <span> N. de Estudiantes </span>
                                                    </td>
                                                    <td>
                                                        <p class="no-margin">
                                                            {{$curso->nEstudiantes}}
                                                        </p>
                                                    </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span> Observación </span>
                                                </td>
                                                <td>
                                                    <p class="no-margin">
                                                        NINGUNA
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            @endforeach
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="row" style="margin-top: 0">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8" center>
                                    <div class="widget widget-tabs" style="padding-top: 0">
                                        <div class="tabs-container">
                                            <div class="tab-content">
                                                <div id="tab-est1" class="tab-pane active">
                                                    <table class="table table-bordered" width="75%">
                                                        <tr class="table__bgBlue">
                                                            <th width="10%" class="text-center"> #</th>
                                                            <th> E S T U D I A N T E</th>
                                                        </tr>
                                                        <tbody>
                                                            @foreach($students as $student)
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <span> {{$count++}} </span>
                                                                    </td>
                                                                    <td style="text-transform: uppercase;">
                                                                        @if($student->apellidos!=null)
                                                                            {{ $student->apellidos }},
                                                                        @endif
                                                                        @if($student->nombres!=null)
                                                                            {{ $student->nombres }}
                                                                        @endif
                                                                        <a href="{{route('reporte.informacionPersonalMatricula', $student->id)}}" 
                                                                            class="pinedTooltip">
                                                                            <img src="{{secure_asset('img/file-download.svg')}}" width="16" alt="">
                                                                            <span class="pinedTooltipH">Ficha de Datos</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            @include('partials.horarioCurso')
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="row" style="margin-top: 0">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8" center>
                                    <table class="table table-bordered table-striped" width="75%">
                                        <tbody>
                                            @foreach( $matters as $matter)
                                                <tr>
                                                    <td>
                                                        <i class="fa fa-bookmark text-color10"></i>
                                                        <span class="text-color10 bold"> {{ $matter->nombre }} </span>
                                                    </td>
                                                    <td class="text-left">
                                                        @if ($matter->user != null)
                                                            @if ($matter->user->profile != null)
                                                                {{$matter->user->profile->nombres}} {{$matter->user->profile->apellidos}}
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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