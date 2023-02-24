@php 
$user_data = session('user_data'); 
$hijos_data = session('hijos_data');
$tMessages = session('tMessages');
 @endphp
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header relative">
				<div class="profile-element">
					<img alt="image" class="img-circle" src="{{ $user_data->url_imagen == null ? secure_asset("img/icono_persona.png ") : secure_asset("storage/$user_data->url_imagen") }}" width="40%" />
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
					<img alt="logo" src="{{secure_asset('img/logo unico.png')}}" width="50px" />
				</div>
				{{-- Cambio de rol --}}
				@include('partials.cambioRol')
			</li>
			<li>
				<a href="{{route('home')}}">
					<i class="fa fa-th-large"></i>
					<span class="nav-label">Mi Perfil </span>
				</a>
			</li>
			<li>
				<a href="{{ route('institucion') }}">
					<i class="fa fa-institution"></i>
					<span class="nav-label">Institucion</span>
				</a>
			</li>
			<li>
				<a href="{{route('notificaciones')}}">
					<img src="{{secure_asset('img/notificaciones.svg')}}" alt="" width="17">
					<span class="nav-label">Notificaciones </span>
					@if($tMessages != 0)
						<span class="label label-success pull-right numberNotifications">{{ $tMessages }}</span>
						<label class="notificaciones__versionMovil"></label>
					@endif
				</a>
			</li>
			<li>
				<a>
					<img src="{{secure_asset('img/icono persona white.png')}}" width="15px">
					<span class="nav-label ml-1">Alumno</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
                    @foreach($hijos_data as $hijo)
                    @php
                        $hijo = $hijo->profilePerYear()->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first();
                    @endphp
                    @if ($hijo != null)
                        <li>
                            <a href="{{route('hijo', $hijo->idStudent)}}">
                                <img src="{{secure_asset('img/icono_persona.png')}}" width="20px"> {{$hijo->student->nombres}} {{$hijo->student->apellidos}}
                            </a>
                        </li>
                    @endif
					@endforeach
				</ul>
			</li>
			{{--<li>
				<a href=" {{route('additionalBook.index.rep')}} ">
					<i class="fa fa-book" aria-hidden="true"></i>
					<span class="nav-label">Libros</span>
				</a>
			</li>--}}
			<li>
				<a href=" {{route('cronogramaRep')}} ">
					<i class="fa fa-star"></i>
					<span class="nav-label">Cronograma</span>
				</a>
			</li>
			{{-- <li>
				<a href=" {{route('representante.encuesta.index')}} ">
					<i class="fa fa-star"></i>
					<span class="nav-label">Encuesta</span>
				</a>
			</li> --}}
		</ul>
	</div>
</nav>
