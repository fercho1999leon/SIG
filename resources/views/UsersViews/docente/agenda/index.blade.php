@extends('layouts.master2')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">AGENDA</h2>
            <div class="flex items-center">
                <a target="_blank" class="pinedTooltip sm:mb-0 lg:mt-0 lg:ml-2" href="{{ route('agenda-escolar-reporteDiario-docente', [$tutor, 'fecha=' . request('fecha')]) }}">
                    <img class="mr-05" src="http://pined.test/img/file-download.svg" width="20">
                    <span class="z-50 pinedTooltipH" style="z-index:9999">Reporte del día</span>
                </a>
                <a class="btn btn-black sm:mb-0 lg:mt-0 lg:ml-2 w-48" href="{{ route('agenda_Docente.semanal', 'fecha=' . request('fecha')) }}">Semanal</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 mt-2">
            <form method="get" class="">
                <div class="agendaEscolar__buscador">
                    <input type="date" class="form-control" name="fecha" id="" value="{{ request('fecha') }}">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
                <div class="r-calificacioneshijo-item ibox mb-2 border-bottom">
                    <div class="r-calificaciones-header flex justify-center align-items-center">
                        <h3 class="r-calificacioneshijo-materia">
                            HORARIO DE CLASE
                        </h3>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down" style="color: #3a3a3a;font-size:20px"></i>
                        </a>
                    </div>
                    <section class="r-calificaciones-section">
                        <div class="ibox-content p-0 no-border" style="display: none;">
                            <table class="table__agenda-escolar w100">
                                <thead>
                                    <th class="text-center scheduler">
                                        <!-- Hora -->
                                    </th>
                                    <th class="text-center scheduler" style="font-size: 1.6em;">Lunes</th>
                                    <th class="text-center scheduler" style="font-size: 1.6em;">Martes</th>
                                    <th class="text-center scheduler" style="font-size: 1.6em;">Miercoles</th>
                                    <th class="text-center scheduler" style="font-size: 1.6em;">Jueves</th>
                                    <th class="text-center scheduler" style="font-size: 1.6em;">Viernes</th>
                                    <th class="text-center scheduler" style="font-size: 1.6em;">Sábado</th>
                                    <th class="text-center scheduler" style="font-size: 1.6em;">Domingo</th>
                                </thead>
                                <tbody>
                                    @foreach ($schedulers as $scheduler)
                                    <tr>
                                        @if ($scheduler->horaInicio != null)
                                        <td>
                                            <div class="table__agenda-escolar--hora">
                                                <div>
                                                    <div>{{ substr($scheduler->horaInicio, 0, 5) }}</div>
                                                    <div>
                                                        {{ substr($scheduler->horaFin, 0, 5) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($scheduler->dia1 != null)
                                        <td class="text-center">
                                            <div class="table__agenda-escolar--materia-flex">
                                                @foreach ($matters as $matter)
                                                @if ($scheduler->dia1 == $matter->id)
                                                {{ $matter->nombre }} -
                                                @foreach ($courses as $course)
                                                @if ($course->id == $matter->idCurso)
                                                {{ $course->grado }} {{ $course->paralelo }}
                                                <br>{{ $course->especializacion }}
                                                @endif
                                                @endforeach
                                                <br>
                                                <a href="{{ route('agenda_Docente_crearHora', ['id' => $matter->id, 'fecha=' . request('fecha')]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
                                                    <img src="{{ secure_asset('img/circleMore.svg') }}" width="16">
                                                </a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($scheduler->dia2 != null)
                                        <td class="text-center">
                                            <div class="table__agenda-escolar--materia-flex">
                                                @foreach ($matters as $matter)
                                                @if ($scheduler->dia2 == $matter->id)
                                                {{ $matter->nombre }} -
                                                @foreach ($courses as $course)
                                                @if ($course->id == $matter->idCurso)
                                                {{ $course->grado }} {{ $course->paralelo }}
                                                <br>{{ $course->especializacion }}
                                                @endif
                                                @endforeach
                                                <br>
                                                <a href="{{ route('agenda_Docente_crearHora', ['id' => $matter->id, 'fecha=' . request('fecha')]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
                                                    <img src="{{ secure_asset('img/circleMore.svg') }}" width="16">
                                                </a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif


                                        @if ($scheduler->dia3 != null)
                                        <td class="text-center">
                                            <div class="table__agenda-escolar--materia-flex">
                                                @foreach ($matters as $matter)
                                                @if ($scheduler->dia3 == $matter->id)
                                                {{ $matter->nombre }} -
                                                @foreach ($courses as $course)
                                                @if ($course->id == $matter->idCurso)
                                                {{ $course->grado }} {{ $course->paralelo }}
                                                <br>{{ $course->especializacion }}
                                                @endif
                                                @endforeach
                                                <br>
                                                <a href="{{ route('agenda_Docente_crearHora', ['id' => $matter->id, 'fecha=' . request('fecha')]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
                                                    <img src="{{ secure_asset('img/circleMore.svg') }}" width="16">
                                                </a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($scheduler->dia4 != null)
                                        <td class="text-center">
                                            <div class="table__agenda-escolar--materia-flex">
                                                @foreach ($matters as $matter)
                                                @if ($scheduler->dia4 == $matter->id)
                                                {{ $matter->nombre }} -
                                                @foreach ($courses as $course)
                                                @if ($course->id == $matter->idCurso)
                                                {{ $course->grado }} {{ $course->paralelo }}
                                                <br>{{ $course->especializacion }}
                                                @endif
                                                @endforeach
                                                <br>
                                                <a href="{{ route('agenda_Docente_crearHora', ['id' => $matter->id, 'fecha=' . request('fecha')]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
                                                    <img src="{{ secure_asset('img/circleMore.svg') }}" width="16">
                                                </a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($scheduler->dia5 != null)
                                        <td class="text-center">
                                            <div class="table__agenda-escolar--materia-flex">
                                                @foreach ($matters as $matter)
                                                @if ($scheduler->dia5 == $matter->id)
                                                {{ $matter->nombre }} -
                                                @foreach ($courses as $course)
                                                @if ($course->id == $matter->idCurso)
                                                {{ $course->grado }} {{ $course->paralelo }}
                                                <br>{{ $course->especializacion }}
                                                @endif
                                                @endforeach
                                                <br>
                                                <a href="{{ route('agenda_Docente_crearHora', ['id' => $matter->id, 'fecha=' . request('fecha')]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
                                                    <img src="{{ secure_asset('img/circleMore.svg') }}" width="16">
                                                </a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($scheduler->dia6 != null)
                                        <td class="text-center">
                                            <div class="table__agenda-escolar--materia-flex">
                                                @foreach ($matters as $matter)
                                                @if ($scheduler->dia6 == $matter->id)
                                                {{ $matter->nombre }} -
                                                @foreach ($courses as $course)
                                                @if ($course->id == $matter->idCurso)
                                                {{ $course->grado }} {{ $course->paralelo }}
                                                <br>{{ $course->especializacion }}
                                                @endif
                                                @endforeach
                                                <br>
                                                <a href="{{ route('agenda_Docente_crearHora', ['id' => $matter->id, 'fecha=' . request('fecha')]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
                                                    <img src="{{ secure_asset('img/circleMore.svg') }}" width="16">
                                                </a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($scheduler->dia7 != null)
                                        <td class="text-center">
                                            <div class="table__agenda-escolar--materia-flex">
                                                @foreach ($matters as $matter)
                                                @if ($scheduler->dia7 == $matter->id)
                                                {{ $matter->nombre }} -
                                                @foreach ($courses as $course)
                                                @if ($course->id == $matter->idCurso)
                                                {{ $course->grado }} {{ $course->paralelo }}
                                                <br>{{ $course->especializacion }}
                                                @endif
                                                @endforeach
                                                <br>
                                                <a href="{{ route('agenda_Docente_crearHora', ['id' => $matter->id, 'fecha=' . request('fecha')]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
                                                    <img src="{{ secure_asset('img/circleMore.svg') }}" width="16">
                                                </a>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </form>
        </div>
        @include('partials.agenda._agendaEscolar-materias', [
        'editar' => 'agenda_Docente_editHora',
        'eliminar' => 'agenda_Docente_deleteHora',
        ])
    </div>
</div>
@endsection