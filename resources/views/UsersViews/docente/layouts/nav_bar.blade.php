@php
$user_data = session('user_data');
$tMessages = session('tMessages');
$user = App\Usuario::findOrFail($user_data->userid);
use App\ConfiguracionSistema;
use App\Institution;
use App\Usuario;
use App\ParcialPeriodico;
$modo_asistencia = ConfiguracionSistema::modoAsistencia();
$asistencia = ConfiguracionSistema::asistencia();
$regimen = ConfiguracionSistema::regimen();
$progresoformativo = ConfiguracionSistema::progresoFormativo();
$institution = Institution::first();
$parcialPeriodico = ParcialPeriodico::where('idPeriodo',(Usuario::where('id',$user_data->userid)->first())->idPeriodoLectivo)->first();
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header relative">
                <div class="profile-element">
                    <img src="{{ $user_data->url_imagen == null ? secure_asset('img/icono_persona.png') : secure_asset("storage/$user_data->url_imagen") }}"
                        class="img-circle" alt="profile" width="30%" />
                    <span class="block ">
                        <h4 class="uppercase">
                            <strong class="font-bold">
                                <a href="">{{ strtoupper($user_data->nombres) }}
                                    {{ strtoupper($user_data->apellidos) }}</a>
                            </strong>
                            <br>
                            <small class="profile-type">{{ strtoupper($user_data->cargo) }}</small>
                        </h4>
                    </span>
                </div>
                <div class="logo-element">
                    <img alt="logo" src="{{secure_asset('img/logo rey david.png')}}" width="50px" />
                </div>
                {{-- Opción cambio de Rol --}}
                @include('partials.cambioRol')
            </li>
            <li>
                <a href="{{ route('home') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Mi Perfil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('institucion') }}">
                    <i class="fa fa-institution"></i>
                    <span class="nav-label">Institución</span>
                </a>
            </li>
            <li>
                <a href="{{ route('notificaciones') }}">
                    <img class="mr-05" src="{{ secure_asset('img/notificaciones.svg') }}" alt="" width="17">
                    <span class="nav-label">Notificaciones</span>
                    @if ($tMessages != 0)
                        <span class="label label-success pull-right numberNotifications">{{ $tMessages }}</span>
                        <label class="notificaciones__versionMovil"></label>
                    @endif
                </a>
            </li>
            <li>
                <a href=" {{ route('cronograma_index') }} ">
                    <i class="fa fa-star"></i>
                    <span class="nav-label">Cronograma</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cursosDocente') }}">
                    <i class="fa fa-bookmark"></i>
                    <span class="nav-label">Cursos</span>
                </a>
            </li>

            <li>
                @php
                    $fechaActual = Carbon\Carbon::now();
                @endphp
                <a href="{{ route('agenda_Docente', 'fecha=' . $fechaActual->format('Y-m-d')) }}">
                    <i class="fa fa-book"></i>
                    <span class="nav-label">Agenda</span>
                </a>
            </li>   
            <!--
                <li>
                    <a href="{{ route('calificaciones', 'p1q1') }}">
                        <i class="fa fa-list-alt"></i>
                        <span class="nav-label">Calificaciones</span>
                    </a>
                </li>
            -->
            <li>
                <a href="{{route('carreras') }}" title="Carreras">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Carreras</span>
                </a>


            </li>
            <!--
   @if ($asistencia->valor == 'diaria')
<li>
     <a href="{{ route('docente.asistenciaMateria-materias') }}">
      <i class="fa fa-list-alt"></i>
      <span class="nav-label">Asistencia</span>
     </a>
    </li>
@endif
   -->
            @if ($progresoformativo->valor == '1')
                <li>
                    <a href="{{ route('aulicasDocente.show', $user_data) }}">
                        <i class="fa fa-list-alt"></i>
                        <span class="nav-label">Progreso Formativo</span>
                    </a>
                </li>
            @endif
            <!-- Esta pendiente la validadcion, debe aparecer solo si tiene materias para Destrezas-->
            @if ($regimen == 'Regular')
                <!--
     <li>
     <a href="{{ route('destrezas') }}">
      <i class="fa fa-bookmark"></i>
      <span class="nav-label">Destrezas</span>
     </a>
    </li>
                -->
            @endif
            <li>
                <a href="{{ route('horario_Docente',['parcial'=>$parcialPeriodico->identificador]) }}">
                    <i class="fa fa-clock-o"></i>
                    <span class="nav-label">Horarios</span>
                </a>
            </li>
            {{--<li>
                <a href="{{ route('solicitudesRecibidas') }}">
                    <i class="fa fa-clock-o"></i>
                    <span class="nav-label">Solicitudes</span>
                </a>
            </li>--}}
            {{--<li>
				<a href="#" clas title="Reportes">
					<i class="fa fa-clipboard"></i>
					<span class="nav-label">Biblioteca</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<li>
						<a href=" {{route('indexLibros')}} ">Libros </a>
					</li>
					<li>
						<a href=" {{route('repositorioEstudiante')}} ">Repositorios </a>
					</li>
                    <li>
						<a href=" {{route('BibliotecaVirtualshow')}} ">Virtual</a>
					</li>
				</ul>
			</li>--}}
            {{-- @foreach ($courses as $course)
                @if ($course->idProfesor == $user_data->id)
                    <li>
                        <a>
                            <i class="fa fa-sitemap"></i>
                            <span class="nav-label">opciones</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('tutoria_Informacion', $course->id) }}">Curso</a>
                            </li>
                            <li style="display: none">
                                <a href="{{ route('tutoria_Agenda', $course->id) }}">Agenda</a>
                            </li>
                            <!--
       <li>
        <a href="{{ route('tutoria_Asistencia', [$course->id, 'p1q1']) }}">Asistencia Parcial</a>
       </li>
       -->
                            @if ($asistencia->valor == 'diaria')
                                <li>
                                    <a href="{{ route('admin.asistenciaMateria', $course) }}">Asistencia Diaria por
                                        Materia</a>
                                </li>
                            @endif
                            <li style="display: none">
                                <a href="{{ route('tutoria_Calificacioness', $course->id) }}">Calificaciones</a>
                            </li>
                            <!--<li>
        <a href="{{ route('tutor-comportamiento', ['course' => $course->id, 'parcial' => 'p1q1']) }}">Comportamiento</a>
       </li>-->
                            <!--
       <li>
        @php
            $configuracionDHI = App\ConfiguracionSistema::where('nombre', 'DHI')
                ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                ->first();
            if ($configuracionDHI->valor == 'PARCIAL') {
                $parcial = 'p1q1';
            } else {
                $parcial = 'q1';
            }
        @endphp
        <a href="{{ route('dhiDocente', ['parcial' => $parcial]) }}">DHI</a>
       </li>
       -->
                            <li style="display: none">
                                <a href="{{ route('tutoria_Estadisticas', $course->id) }}">Estadísticas</a>
                            </li>
                            <li style="display: none">
                                <a href="">Planificaciones</a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('tutoria_Libreta', [$course, 'parcial' => 'p1q1']) }}">Descargables</a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endforeach --}}
            
            @php
                $aulaVirtual = ConfiguracionSistema::aulaVirtual();
            @endphp
            @if ($aulaVirtual->valor == 1)
                <!--
    <li>
    <a  href="http://{{ $institution->aula_virtual }}?username={{ $user->email }}" target="_blank">
     <i class="fa fa-laptop" aria-hidden="true"></i>
     <span class="nav-label">Aula Virtual</span>
    </a>
   </li>
        -->
            @endif
            <!--<li>
    <a  href="{{ route('docente-comportamiento') }}">
     <i class="fa fa-bookmark" aria-hidden="true"></i>
     <span class="nav-label">Comportamiento</span>
    </a>
   </li>-->
        </ul>
    </div>
</nav>
