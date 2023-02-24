<div class="ibox-content text-center">
	<h3 id="admin">{{ $user->apellidos }} {{ $user->nombres }}</h3>
	<div class="m-b-sm">
		<img src="{{secure_asset('img/personal.svg')}}" alt="" width="25%">
	</div>
	{{-- <div class="historialDeUso__estado-container">
		<div>
			Estado: 
			<img src=" {{secure_asset('img/pagos-check-verde.svg')}} " width="15" alt="">
			<img src=" {{secure_asset('img/times-circle-solid.svg')}} " width="15" alt="">
			<a href="" class="historialDeUso__estado-edit" id="editarEstado" data-toggle="modal" data-target="#modalEditarEstado">
				<i class="fa fa-pencil"></i>
			</a>
		</div>
	</div> --}}
	<div class="text-center mt-1">
		<a class="text-center" data-toggle="modal" data-target="#modalMasInformacion{{$user->id}}">Mas información</a>
	</div>
	@include('partials.historial.modalInformacion',[
		'user' => $user
	])
</div>