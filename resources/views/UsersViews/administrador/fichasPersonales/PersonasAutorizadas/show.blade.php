@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('personas-autorizadas.index')}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Personas Autorizadas</h2>
		    </div>
		</div>
		<div class="wrapper m-auto pb-6 justify-center max-w-sm bg-white pt-6 rounded-lg mt-2" id="personas_autorizadas">
			<h3 class="transporte__unidad__datos">{{$user->nombres}}<span>Nombres</span> </h3>
			<h3 class="transporte__unidad__datos">{{$user->telefono_domicilio}}<span>Telefono Domicilio</span> </h3>
			<h3 class="transporte__unidad__datos">{{$user->telefono_celular}}<span>Telefono Celular</span> </h3>
			<h3 class="transporte__unidad__datos">{{$user->direccion}}<span>Dirección</span> </h3>
			<h3 class="transporte__unidad__datos">{{$user->ciudad}}<span>Ciudad</span> </h3>
        </div>
	</div>
@endsection
