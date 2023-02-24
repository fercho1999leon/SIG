@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Repositorio Instituto Superior Técnico Rey David</h2>
            <div class="agregarSeccionCont">
                <a href="">
                    <button class="btn btn-primary">Agregar Tesis</button>
                </a>
                <a href="">
                    <button class="btn btn-primary">Agregar Tesina</button>
                </a>
            </div>
        </div>       
        <div class="agregarSeccionCont">
		<a class="button-br" href="{{ route('cursosEdicion') }}">
		    <button>
			    <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		    </button>
	    </a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

</script>
@endsection
