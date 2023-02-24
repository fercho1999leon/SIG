@if ($user_data->es_representante === 1)
	<img class="switchRol pointer" src="{{secure_asset('img/arrow-down.svg')}}" width="12" alt="">
	<div class="switchRol__dropDown hidden">
		<div>
			<form action="{{route('cambioRol')}}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="rol" value="4">
				<input type="hidden" name="user" value="{{$user_data->userid}}">
				<input type="hidden" name="rolName" value="{{$user_data->cargo == 'Docente' ? 'Docente' : 'Representante'}}">
				<button class="bg-none border-none text-white pointer" type="submit">Ir al perfil {{$user_data->cargo == 'Docente' ? 'Representante' : 'Docente'}}</button>
			</form>
		</div>
	</div>
	<script>
		const switchIcon = document.querySelector('.switchRol')
		const dropDown = document.querySelector('.switchRol__dropDown')
		if (switchIcon && dropDown) {
			switchIcon.addEventListener('click',function() {
				dropDown.classList.toggle('hidden')
			})
		} 
	</script>
@endif

