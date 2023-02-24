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
				@if($parentezco=='P')
		        <h2 class="title-page">Edición De Ficha Personal del Padre:</h2>
		        @elseif($parentezco=='M')
		        <h2 class="title-page">Edición De Ficha Personal de la Madre:</h2>
		        @else
		        <h2 class="title-page">Edición De Ficha Personal:</h2>
		        @endif
		    </div>
		</div>
		<div class="wrapper wrapper-content">
	        <form method="post" action="{{ route('padres.update')}}">
    		<input type="hidden" value="{{$estudiante->ci}}" name="search">	
				<input type="hidden" value="{{$padre->id}}" name="id_padre">
				<input type="hidden" value="{{$parentezco}}" name="t_padre">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				@include('partials.fichas.fichasPadresFormulario', ['btn' => 'ACTUALIZAR'])	
			</form>
        </div>
    </div>
</div>
