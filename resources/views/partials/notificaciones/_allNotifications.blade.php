
<div class="max-w-2xl mx-auto mt-10">
	<h2>Notificaciones</h2>
	<div class="bg-white rounded max-w-2xl mx-auto">
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
				<a href="{{route('/')."/$notificacion->ruta"}}" class="menu__notificaciones__content__item {{$notificacion->leido == 0 ? '' : ''}}"> {{-- borderBlueNotification --}}
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
			<div class="px-2 flex justify-center">
				{{$notificaciones->links()}}
			</div>
		</div>
	</div>
</div>