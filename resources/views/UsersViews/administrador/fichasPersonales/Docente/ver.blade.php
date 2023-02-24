@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('docentes') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        @include('partials.fichas.fichasAdministrativoVer')
    </div>
@endsection
