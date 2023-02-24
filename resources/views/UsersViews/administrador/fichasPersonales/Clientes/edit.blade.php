@extends('layouts.master')
@section('content')
	<a class="button-br" href="{{route('clients.index')}}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Creación Cliente:</h2>
		    </div>
		</div>
		<div class="wrapper wrapper-content">
			<form method="post" action="{{ route('clients.update', $cliente) }}">
				{{ csrf_field() }}
				{{method_field('PUT')}}
				@include('partials.fichas.formularioCliente', ['btn' => 'Actualizar Cliente'])
			</form>
        </div>
    </div>
@endsection

