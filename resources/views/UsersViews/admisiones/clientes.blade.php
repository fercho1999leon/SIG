@extends('UsersViews.admisiones.style')
<a class="button-br" href="{{route('admision_datos', $estudiante->ci)}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
<div class="row wrapper white-bg ">
	@if (count($errors) > 0)
    <div class="alert alert-danger">
    	<p>Corrige los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<div class="container">
				<div class="row mt-5">
					<div class="col-md-12">
		        <h2 class="title-page">Editar Cliente:</h2>
			<div class="wrapper wrapper-content">
			<form method="post" action="{{ route('actualizarCliente', $cliente) }}">
				<input type="hidden" value="{{$estudiante->id}}" name="id_estudiante">	
				<input type="hidden" value="{{$cliente->id}}" name="id_cliente">	
				{{ csrf_field() }}
				@include('partials.fichas.formularioCliente', ['btn' => 'Actualizar Cliente'])
				
			</form>
        </div>
       </div>
	</div>
</div>
</div>

