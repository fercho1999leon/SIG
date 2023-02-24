@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('padres') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
		    <div class="col-lg-12">
		        <h2 class="title-page">Fichas Personales  Padre / Madre: {{ $data->nombres }} {{ $data->apellidos }}</h2>
		    </div>
		</div>
		<div class="wrapper wrapper-content">
	        @include('partials.fichas.fichasPadresVer')
        </div>
    </div>
@endsection
