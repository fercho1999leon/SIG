@php
	$id = Sentinel::getUser()->id;
	$notificacionesSinLeer = App\Notificaciones::query()
		->where('leido', 0)
		->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
		->where('idUser', $id)
		->get();
	$notificaciones = App\Notificaciones::query()
		->where('idUser', $id)
		->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
		->where('leido', 0)
		->orderBy('created_at', 'DESC')
		->get();
	
	$institution = App\Institution::first();
	$user_profile = App\User::where('userid', $id)->first();
	$periodosLectivos = App\PeriodoLectivo::orderBy('fecha_inicial')
		->get();
	if ($user_profile->cargo == 'Estudiante' ) {
		$idPeriodos = $user_profile->profileStudent->profilePerYearNavBar->pluck('idPeriodo');
		$periodosLectivos = App\PeriodoLectivo::whereIn('id', $idPeriodos)->orderBy('fecha_inicial')->get();
	} 
@endphp
<div class="row border-bottom">
    <nav class="navbar navbar-static-top relative" role="navigation">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#" id="menu-desplegable">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
			@if ($user_profile->cargo == 'Estudiante' || $user_profile->cargo == 'Representante')
				<li class="mr-6 pointer relative">
					@if ($notificacionesSinLeer->isNotEmpty())
						<span class="numeroDeNotificaciones"></span>
					@endif
					<i id="iconNotificaciones" class="menu__notificaciones-icon fa fa-bell-o" aria-hidden="true"></i>
				</li>
			@endif
			<li>
				<select class="form-control" name="" id="cambioDePeriodo" data-ruta="{{route('cambioPeriodoLectivo', Sentinel::getUser()->id)}}">
					@foreach ($periodosLectivos as $periodo)
						<option 
							{{Sentinel::getUser()->idPeriodoLectivo !== $periodo->id ?: 'selected'}}
							value="{{$periodo->id}}">
							{{$periodo->nombre}}
						</option>
					@endforeach
				</select>
			</li>
            <li>
				<a href="{{ route('logout') }}"
                onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
					<i class="btn btn-danger fa fa-sign-out">Cerrar Sesión</i>
                </a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
            </li>
        </ul>
	</nav>
	<div class="menu__notificaciones shadow" id="menu__notificaciones" style="display:none">
		<div class="triangulo"></div>
		<header class="menu__notificaciones__header">
			<strong>NOTIFICACIONES</strong>
			<form action="{{route('index.updated.leido')}}" method="POST">
				{{ csrf_field() }}
				<button type="submit" class="no-border bg-none" style="color:#337ab7">
					Marcar todos como leido
				</button>
			</form>
		</header>
		<div class="menu__notificaciones__content">
			@forelse ($notificaciones as $notificacion)
				@php
					$startDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notificacion->created_at);
					$endDate = Carbon\Carbon::now();

					$months = $startDate->diffInMonths($endDate);
					$days = $startDate->diffInDays($endDate);
					$hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
					$minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
				@endphp
				<a href="{{route('/')."/$notificacion->ruta"}}"
					data-marcarLeido="{{route('marcar.leido', $notificacion)}}"
					class="menu__notificaciones__content__item {{$notificacion->leido == 0 ? '' : ''}}"> {{--borderBlueNotification--}}
					{{ csrf_field() }}
					<div class="menu__notificaciones__content__sectionOne">
						<strong class="uppercase">
							{{$notificacion->seccion}}
						</strong>
						<span class="menu__notificaciones__content__item--time">
							@if ($hours == 0)
								Hace {{$minutes}} {{$minutes == 1 ? 'minuto' : 'minutos'}} atrás
							@elseif($hours > 0 && $days == 0)
								Hace {{$hours}} {{$hours == 1 ? 'hora' : 'horas'}}
							@elseif($days > 0 && $months == 0)
								Hace {{$days}} {{$days == 1 ? 'dia' : 'dias'}}
							@else 
								Hace {{$months}} {{$months == 1 ? 'mes' : 'meses'}}
							@endif
						</span>
					</div>
					{!!$notificacion->mensaje!!}
				</a>
			@empty
				<div class="menu__notificaciones__content__item">
					<p>No existen notificaciones</p>
				</div>
			@endforelse
			<div class="menu__notificaciones__content--footer">
				<a href="{{route('index.all')}}">Ver todas las notificaciones</a>
			</div>
		</div>
	</div>
</div>
<script>
	const menu = document.getElementById('iconNotificaciones')
	const overlay = document.createElement('div')
	overlay.style.background = 'rgba(0, 0, 0, .3)'
	overlay.style.height = '100vh'
	overlay.style.position = 'absolute'
	overlay.style.width = '100%'
	overlay.style.zIndex = '10'
	overlay.setAttribute('id', 'overlay')
	var querie = window.matchMedia("(min-width: 768px)")
	const wrapper = document.getElementById('wrapper')
	
	if (menu) {
		menu.addEventListener('click', function() {
			let menuNotificaciones = document.getElementById('menu__notificaciones')
			if(menuNotificaciones.style.display == 'block') {
				menuNotificaciones.style.display = 'none'
				let el = document.getElementById('overlay')
				el.parentNode.removeChild(el)
			} else {
				menuNotificaciones.style.display = 'block'
				wrapper.insertBefore(overlay, wrapper.childNodes[0])
				window.addEventListener('click', functionEvent)
			}
		})
	}

	function functionEvent(e) {
		let tag = e.target
		if (tag.getAttribute('id') == 'overlay') {
			let menuNotificaciones = document.getElementById('menu__notificaciones')
			menuNotificaciones.style.display = 'none'
			let el = document.getElementById('overlay')
			el.parentNode.removeChild(el)
		}
	}
</script>
<script src="{{secure_asset('js/jquery-3.3.js')}}"></script>
<script>
	var notificacion = $('.menu__notificaciones__content__item')
	notificacion.click(function() {
		$.ajax({
			type: "POST",
			url: $(this).attr('data-marcarLeido'),
			data: {
				'_token': $('input[name=_token]').val(),
			},
			success: function (response) {
				
			},
			error: function (xhr, status, error) {
				console.log('Algo salio mal.')
			}
		});
	})
	var selectPeriodo = $('#cambioDePeriodo')
	selectPeriodo.change(function() {
		$.ajax({
			type: "POST",
			url: $(this).data('ruta'),
			data: {
				'_token': $('input[name=_token]').val(),
				'idPeriodo' : $(this).val()
			},
			success: function (response) {
				location.reload()
			}, error: function (response) {
				alert('Algo salio mal.')
			}
		});
	})
</script>
