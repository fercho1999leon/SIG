@extends('layouts.master')
@section('content')
	@php
		use Carbon\Carbon;
        use App\ConfiguracionSistema;
        use App\Institution;
        $user_profile= App\Administrative::findOrFail($hijo->idProfile);
        $institution = Institution::first();
	@endphp
    <style type="text/css" media="screen">
.text {
  font-size:28px;
  font-family:helvetica;
  font-weight:bold;
  color:#71d90b;
}
.parpadea {

  animation-name: parpadeo;
  animation-duration: 2s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 2s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}
    </style>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper border-bottom white-bg">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-xs-12 col-lg-6">
                        <div class="profile-image">
                            <img src="{{secure_asset('img/icono persona.png')}}" class="img-circle circle-border m-b-md" alt="profile">
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-6">
                        <div class="profile-info">
                            <h3>{{$hijo->nombres}} {{$hijo->apellidos}}</h3>
                            <hr>
                            <div class="curso">
                                <h4>{{ $course->grado}} {{ $course->paralelo}} {{ $course->especializacion}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabs" class="col-sm-8 col-lg-4">
                <div class="tabs-container">
                    <ul class="nav nav-tabs mt-1">
                        <li>
                            <a data-toggle="tab" href="#tab-1">Domicilio</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-2">Informacion Medica</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                            <div id="tab-1" class="row tab-pane">
                                <ul class="list-unstyled m-t-md">
                                    <div class="row">
                                        <li>
                                            <div class="col-lg-3">
                                                <label>Ciudad:</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <p>{{$hijo->ciudad}}</p>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="row">
                                        <li>
                                            <div class="col-lg-3">
                                                <label>Dirección:</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <p>{{$hijo->direccion}}</p>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="row">
                                        <li>
                                            <div class="col-lg-3">
                                                <label>Telefono:</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <p>{{$hijo->telefono}}</p>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                            <div id="tab-2" class="row tab-pane">
                                <ul class="list-unstyled m-t-md">
                                    <div class="row">
                                        <li>
                                            <div class="col-lg-4">
                                                <label>Teléfono de emergencia:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{$hijo->telefonoEmergencia}}
                                            </div>
                                        </li>
                                    </div>
                                    <div class="row">
                                        <li>
                                            <div class="col-lg-4">
                                                <label>Grupo sanguinero:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{$hijo->tipoSangre}}
                                            </div>
                                        </li>
                                    </div>
                                    <div class="row">
                                        <li>
                                            <div class="col-lg-4">
                                                <label>Contacto de emergencia:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{$hijo->contactoEmergencia}}
                                            </div>
                                        </li>
                                    </div>
                                    <div class="row">
                                        <li>
                                            <div class="col-lg-4">
                                                <label>Telefono de emergencia:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                {{$hijo->telefonoEmergencia}}
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-xs-12 col-sm-4 mb-2 text-center">
                        <a href="{{ route('hijo_agenda', [$hijo->idStudent, 'fecha='.Carbon::now()->format('Y-m-d')]) }}">
                            <img width="125" src="{{secure_asset('img/agendaEscolar/agendaEscolar_verde.svg')}}">
                            <h3 class="cb m-xs text-center">Agenda Escolar</h3>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 mb-2 text-center">
                        <a href="{{ route('hijo_horario', [$hijo->idStudent, 'clases']) }}">
                            <img width="125" src="{{secure_asset('img/horario/horario_verde.svg')}}">
                            <h3 class="cb m-xs text-center">Horario de clases</h3>
                        </a>
					</div>
					@if($mostrar_calificaciones->valor === '1')
						<div class="col-xs-12 col-sm-4 mb-2 text-center">
							<a href="{{ route('calificacionesR', [ 'hijo' => $hijo->idStudent, 'parcial' => 'p1q1'] ) }}">
								<img width="125" src="{{secure_asset('img/asistencia/asistencia_azul.svg')}}">
								<h3 class="cb m-xs text-center">Calificaciones</h3>
							</a>
						</div>
					@endif
                    <div class="col-xs-12 col-sm-4 mb-2 text-center">
                        <a href="{{ route('asistenciaR', $hijo->idStudent) }}">
                            <img width="125" src="{{secure_asset('img/visto/visto_azul.svg')}}">
                            <h3 class="cb m-xs text-center">Asistencia</h3>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 mb-2 text-center">
                        <a href="{{ route('tareasR',['hijo' => $hijo->idStudent, 'parcial' => 'p1q1']) }}">
                            <img width="125" src="{{secure_asset('img/tareas/tarea_verde.svg')}}">
                            <h3 class="cb m-xs text-center">Tareas</h3>
                        </a>
                    </div>

                    @php
                    $pagoEnLinea = ConfiguracionSistema::where('nombre', 'PAGO_EN_LINEA')
                    ->where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->first();
                     @endphp
                @if($pagoEnLinea->valor=='1')
                <div class="col-xs-12 col-sm-4 mb-2 text-center">
                        <a href=" {{route('representantePagosPendientes', ['id' => $hijo->idStudent])}} ">
                            <img width="125" src="{{secure_asset('img/pago_representante.png')}}">
                            <h3 class="cb m-xs text-center">Pagos</h3>
                        </a>
                </div>
                @endif
                @php
                $aulaVirtual = ConfiguracionSistema::aulaVirtual();
                @endphp
                    <div class="col-xs-12 col-sm-4 mb-2 text-center">
                        <a href=" {{route('configuracionesRepresentante', ['id' => $hijo->idStudent])}} ">
                            <img width="125" src="{{secure_asset('img/gear-representante.svg')}}">
                            <h3 class="cb m-xs text-center">Configuraciones</h3>
                        </a>
                    </div>
                    @if($preinscripcion!='')
                    <div class="col-xs-12 col-sm-4 mb-2 text-center parpadea text">
                        <a onclick="paseDeAnio();">
                            <img width="125" src="{{secure_asset('img/planificaciones/planificaciones_rosado.png')}}">
                            <h3 class="cb m-xs text-center">Inscripción: <strong>{{$preinscripcion->nombre}}</strong></h3>
                        </a>
                    </div>
                    @endif
                    @if( ($ModuloAdmisiones != null) && ($ModuloAdmisiones->idPeriodo == Sentinel::getUser()->idPeriodoLectivo) && ($hijo->actDesdeAdmisiones!=1) && ($ActRepre==1))
                    <div class="col-xs-12 col-sm-4 mb-2 text-center parpadea text">
                        <a href="{{ route('logoutAdmisiones') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                         <img width="125" src="{{secure_asset('img/Act_rep.png')}}">
                            <h3 class="cb m-xs text-center">Actualice datos</h3>
                        </a>
                        <form id="frm-logout" action="{{ route('logoutAdmisiones') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="text" name="search" value="{{$hijo->ci}}" placeholder="">
                        </form>
                    </div>
                    @endif
                      @if($aulaVirtual->valor == 1)
                <div class="col-xs-12 col-sm-4 mb-2 text-center">
                        <a  href="http://{{$institution->aula_virtual}}?username={{$user_profile->correo}}" target="_blank">
                            <img width="125" src="{{secure_asset('img/aula_v3.png')}}">
                            <h3 class="cb m-xs text-center">Aula virtual</h3>
                        </a>
                    </div>
                @endif

                {{-- Provicional --}}
                <div class="col-xs-12 col-sm-4 mb-2 text-center">
                    <div class="dropdown">
                        <button class="bg-none border-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img width="90" style="border-radius: 25px" src="{{secure_asset('img/file-download.svg')}}" alt="">
                            <h3 class="cb m-xs text-center" style="color: rgb(52, 122, 183)">Descargas</h3>
                        </button>
                        <div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownMenuButton" style="left: 6px; width: 277px;">
                            <div class="calificaciones__dropDown-grid">
                                <a href="{{route('reporte.informacionPersonalMatricula', $hijo->idStudent)}}" class="calificaciones__dropDown__item-link">
                                    Hoja de vida
                                </a>
                                @if ($contrato != 0)
                                    <a href="{{route('reporte.prestacionServiciosEducacionales', $hijo->idStudent)}}" class="calificaciones__dropDown__item-link">
                                        Contrato de Servicios
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @if($preinscripcion!='')
    <div class="modal fade" id="pasarDeAnio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pasar de año, curso actual: {{$course->grado}}-{{$course->paralelo}} {{$course->especializacion}}</h4>
            </div>
            <form id="form-pasar-de-periodo" action="{{route('pasarDePeriodoLectivoHijo', $studiante)}}" method="post">
                 <input type="hidden" name="tipo_matricula" value="Pre Matricula"  placeholder="">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="mb-6">
                        <label for="">SU REPRESENTADO SERÁ PRE MATRICULADO EN EL CURSO:</label>
                    </div>
                    <div class="mb-6">
                        <label for="">{{$gradoSiguiente!= '' ? $gradoSiguiente['nombre']: ''}}</label>
                        <select class="form-control" name="idCurso">
                            @foreach($nextYearCourse as $nexYear)
                            <option value="{{$nexYear->id}}">{{$nexYear->grado}} {{$nexYear->paralelo}} {{$nexYear->especializacion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-pasar-de-periodo" onClick="desactivarboton();" class="btn btn-primary">Pre Matrícula</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        @endif
    @endsection
    <script type="text/javascript">
        function paseDeAnio(){
            $('#pasarDeAnio').modal('show');
        }
        function desactivarboton(){
            $('#btn-pasar-de-periodo').attr("disabled", true);
            $('#form-pasar-de-periodo').submit();
        }
    </script>