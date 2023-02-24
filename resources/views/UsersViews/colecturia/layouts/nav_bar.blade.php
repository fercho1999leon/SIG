@php
$user_data = session('user_data');
use App\ConfiguracionSistema;
	$asistencia = ConfiguracionSistema::where('nombre', 'ASISTENCIA')
		->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
		->first();
@endphp  
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="profile-element">
					<img alt="image" class="img-circle" src="{{ $user_data->url_imagen == null ? secure_asset("img/icono_persona.png") : secure_asset("storage/$user_data->url_imagen") }}" width="40%" />
					<a href="#">
						<span class="block ">
							<h4>
								<strong class="font-bold">{{ strtoupper($user_data->nombres) }} {{strtoupper($user_data->apellidos)}}</strong>
								<br>
								<small class="profile-type">{{strtoupper($user_data->cargo)}}</small>
							</h4>
						</span>
					</a>
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
				<a href="{{route('notificaciones')}}">
					<img class="mr-05" src="{{secure_asset('img/notificaciones.svg')}}" alt="" width="17">
					<span class="nav-label">Notificaciones</span>
				</a>
			</li>
			<li>
                <a title="Institución">
                    <i class="fa fa-university"></i>
                    <span class="nav-label">Institución </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('institucion') }}">Información </a>
                    </li>
                    <!--
                        <li>
                            <a href="{{ route('institucionLectivo') }}">Año Lectivo </a>
                        </li>
                        <li>
                                <a href="{{ route('institucionMaterias') }}">Áreas / Asignaturas </a>
                        </li>
                    -->
                    <li>
                        <a href=" {{route('cronograma')}}">
                            Cronograma
                        </a>
                    </li>
                </ul>
            </li>
			<li>
				<a href="#">
					<i class="fa fa-group"></i>
					<span class="nav-label">Fichas Personales </span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					{{--<li>
						<a href="{{ route('administrativos') }}">Administrativos </a>
					</li>--}}
					<li>
						<a href="{{ route('docentes') }}">Docentes </a>
					</li>
					{{--<!--<li>
						<a href="{{ route('padres') }}">Padres</a>
					</li>
					<li>
						<a href="{{ route('representantes') }}">Representantes</a>
					</li>-->--}}
					<li>
						<a href="{{ route('historial') }}">Historial</a>
					</li>
				</ul>
			</li>
			{{--<li>
				<li>
					<a href="{{route('carreras') }}" title="Carreras">
						<i class="fa fa-th-large"></i>
						<span class="nav-label">Carreras</span>
					</a>                
            	</li>				
			</li>--}}
			<li>
				<a href="{{ route('matricula') }}">
					<i class="fa fa-list-alt"></i>
					<span class="nav-label">Matrícula </span>
				</a>
			</li>
			<!--<li>
				<a href="{{route('listarCarrerasPagos')}}">
					<i class="fa fa-usd"></i>
					<span class="nav-label">Pagos</span>
				</a>
			</li>-->
			<li>
				<a href=" {{ route('cuentasporcobrar') }}">
					<i class="fa fa-money"></i>
					<span class="nav-label">Cuentas Por Cobrar</span>
					
				</a>
			</li>
		</ul>
	</div>
</nav>

