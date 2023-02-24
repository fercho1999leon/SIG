@extends('layouts.master')
@section('content')
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Crear Insumo</h2>
			</div>
		</div>
		<a class="button-br" href="{{ route('semestres') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
		<div class="wrapper wrapper-content">
			<div class="row">
				<!--<form action="semestrepost-post" method="POST" enctype="multipart/form-data">
				    <form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->
				<form action="{{ route('semestrepost-post') }}" method="POST" enctype="multipart/form-data">

					{{csrf_field()}}
				<label>
                    Ingrese nombre del Semestre <br>
                    <input type="text" name="nombsemt">
                    <br>
                </lable>
				<label>{{$id}}</label>
                <br>
                <div></div>
                <button>Crear Semestre</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
