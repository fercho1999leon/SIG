@php
$user_data = session('user_data');
$estudiante = session('estudiante');
$tMessages = session('tMessages');
use App\Student2;
use App\ConfiguracionSistema;
use Carbon\Carbon;
use App\Institution;
use App\Usuario;
use App\ParcialPeriodico;

$institution = Institution::first();
$parcialPeriodico = ParcialPeriodico::where('idPeriodo',Sentinel::getUser()->idPeriodoLectivo)->first();
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="profile-element" >
					<img alt="image" class="img-circle" src="{{ $user_data->url_imagen == null ? secure_asset("
						img/icono_persona.png ") : secure_asset("storage/$user_data->url_imagen") }}" width="40%" />
					<span class="block ">
						<h4 class="uppercase">
							<strong class="font-bold">
								<a href="">{{strtoupper($user_data->nombres)}} {{strtoupper($user_data->apellidos)}}</a>
							</strong>
							<br>
							<small class="profile-type">{{strtoupper($user_data->cargo)}}</small>
						</h4>
					</span>
				</div>
				<div class="logo-element">
					<img alt="logo" src="{{secure_asset('img/logo rey david.png')}}" width="50px" />
				</div>
			</li>
			<li>
				<a href="{{route('home')}}">
					<i class="fa fa-th-large"></i>
					<span class="nav-label">Mi Perfil</span>
				</a>
			</li>
			<li>
				<a href="{{route('notificacionesEstudiante')}}">
					<img class="mr-05" src="{{secure_asset('img/notificaciones.svg')}}" alt="" width="17">
					<span class="nav-label">Notificaciones</span>
					@if($tMessages != 0)
					<span class="label label-success pull-right numberNotifications">{{ $tMessages }}</span>
					<label class="notificaciones__versionMovil"></label>
					@endif
				</a>
			</li>
			<li>
				<a href="{{ route('institucion') }}">
					<i class="fa fa-institution"></i>
					<span class="nav-label">Institucion</span>
				</a>
			</li>
			<li>
				<a href="{{route('agendaEstudiante', 'fecha='.Carbon::now()->format('Y-m-d'))}}">
					<i class="fa fa-book"></i>
					<span class="nav-label">Agenda</span>
				</a>
			</li>
			@php
			$student = App\Student2Profile::getStudent($estudiante->id);
			$calificaciones = ConfiguracionSistema::calificaciones();
			@endphp
			@if($calificaciones->valor == 1)
			<li>
				<a href="{{route('calificacionesEstudiante', [$parcialPeriodico->identificador])}}">
					<i class="fa fa-list-alt"></i>
					<span class="nav-label">
						Calificaciones
					</span>
				</a>
			</li>
			@endif
			{{--<li>
				<a href="{{route('solicitudesEstudiantes') }}" title="Solicitudes Academicas">
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<span class="nav-label">Solicitudes Estudiante</span>
				</a>
			</li>--}}
			{{--<li>
				<a href="{{route('cronogramaEstudiante')}}">
					<i class="fa fa-book" aria-hidden="true"></i>
					<span class="nav-label">Cronograma</span>
				</a>
			</li>--}}
			<li>
				<a href="{{ route('horarioEscolarEstudiante', [$parcialPeriodico->identificador])}}">
					<i class="fa fa-clock-o"></i>
					<span class="nav-label">Horario</span>
				</a>
			</li>
			{{--<li>
				<!--CII-2022-->
				<a href="{{route('TareasEstudiante', ['hijo' => $estudiante->id , 'parcial' => $parcialPeriodico->identificador])}}">
					<i class="fa fa-book"></i>
					<span class="nav-label">Tareas</span>
				</a>
			</li>--}}
			<li>
				<a href="{{route('documentacionEstudiantil')}}">
					<i class="fa fa-file-text" aria-hidden="true"></i>
					<span class="nav-label">Documentos Estudiantiles</span>
				</a>
			</li>
			<li>
				<a href="{{route('pagosEstudiante')}}">
					<i class="fa fa-usd" aria-hidden="true"></i>
					<span class="nav-label">Pagos</span>
				</a>
			</li>
			<li>
				<a href="#" clas title="Reportes">
					<i class="fa fa-clipboard"></i>
					<span class="nav-label">Biblioteca</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<li>
						<a href=" {{route('indexLibros')}} ">Libros </a>
					</li>
					{{--<li>
						<a href=" {{route('repositorioEstudiante')}} ">Repositorios </a>
					</li>--}}
					<li>
						<a href=" {{route('BibliotecaVirtualshow')}} ">Virtual</a>
					</li>
				</ul>
			</li>
			@php
			$aulaVirtual = ConfiguracionSistema::aulaVirtual();
			$ActEst = ConfiguracionSistema::ActEstu()->valor;
			@endphp
			@if($aulaVirtual->valor == 1)
			<!--<li>
				<a  href="http://{{$institution->aula_virtual}}?username={{$user_data->correo}}" target="_blank">
					<i class="fa fa-laptop" aria-hidden="true"></i>
					<span class="nav-label">Aula Virtual</span>
				</a>
			</li>
			-->
			@endif
			@if($ActEst== 1)
			<li>
				
				<a href="{{ route('actualizarEstudiante',$estudiante->id) }}"
				>
					<i class="fa fa-edit" aria-hidden="true"></i>
					<span class="nav-label">Actualice Datos</span>
				</a>
				
			</li>
			@endif
		</ul>
	</div>
</nav>
@section('scripts')
<script>
	$(document).ready(function () {
		$('.hide').hide();
	});
</script>
@endsection
