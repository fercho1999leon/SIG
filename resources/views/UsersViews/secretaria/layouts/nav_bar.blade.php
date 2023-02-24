@php
$user_data = session('user_data');
$tMessages = session('tMessages');
$transporte = App\ConfiguracionSistema::transporte();
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
                                <strong class="font-bold">{{strtoupper($user_data->nombres)}} {{strtoupper($user_data->apellidos)}}</strong>
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
            <li class="active">
                <a href="{{route('home')}}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Mi Perfil</span>
                </a>
            </li>
            <li>
                <a href="{{route('institucion')}}">
                    <i class="fa fa-institution"></i>
                    <span class="nav-label">Institucion</span>
                </a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-group"></i>
					<span class="nav-label">Fichas Personales </span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					{{--<!--<li>
						<a href="{{ route('administrativos') }}">Administrativos </a>
					</li>
					<li>
						<a href="{{ route('colecturia.index') }}">Colecturia </a>
					</li>
					<li>
						<a href="{{ route('secretaria.index') }}">Secretaría </a>
					</li>-->--}}
					<li>
						<a href="{{ route('docentes') }}">Docentes</a>
					</li>
					{{--<!--
						<li>
							<a href="{{ route('padres') }}">Padres</a>
						</li>
						<li>
							<a href="{{ route('representantes') }}">.R.</a>
						</li>
					-->
					<!--<li>
						<a href="{{ route('clients.index') }}">Clientes</a>
					</li>
					
					<li>
						<a href="{{route('personas-autorizadas.index')}}">Personas Autorizadas</a>
					</li>-->--}}
					<li>
						<a href="{{ route('historial') }}">Historial</a>
					</li>
				</ul>
			</li>
			<li>
                <a href="{{route('notificaciones')}}">
                    <img class="mr-05" src="{{secure_asset('img/notificaciones.svg')}}" alt="" width="17">
					<span class="nav-label">Notificaciones </span>
					@if($tMessages != 0)
						<span class="label label-success pull-right numberNotifications">{{ $tMessages }}</span>
						<label class="notificaciones__versionMovil"></label>
					@endif
                </a>
            </li>
            <li>
                <a href="{{route('matricula')}}">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-label">Matricula</span>
                </a>
            </li>
			<li>
                <a href="{{ route('solicitudesRecibidasSecretaria') }}">
                    <i class="fa fa-clock-o"></i>
                    <span class="nav-label">Solicitudes</span>
                </a>
            </li>
            <li>
				<a href="{{ route('reportes.carreras') }}" clas>
					<i class="fa fa-clipboard"></i>
					<span class="nav-label">Reportes </span>
				</a>				
			</li>
			<li>
				<a href=" {{url('/reporteActas')}} ">
					<i class="fa fa-clipboard"></i>
					<span class="nav-label">Actas de Calificaciones </span>
				</a>
			</li>
			<li>   
				<a href=" {{route('manejoDocumentos')}}">
					<i class="fa fa-file-text" aria-hidden="true"></i>
					<span class="nav-label">Gestionar Documentaciones</span>
				</a>
			</li>
			@if ($transporte->valor == '1')
				<!--<li>
					<a href="{{route('transporte')}}">
						<i class="fa fa-bus"></i>
						<span class="nav-label">Transporte</span>
					</a>
				</li>-->
			@endif
        </ul>
    </div>
</nav>
