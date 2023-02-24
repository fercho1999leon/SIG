@extends('layouts.master')
@section('content')
<a class="button-br" href="{{ route('cursosEdicion') }}">
	<button>
		<img src="img/return.png" alt="" width="17">Regresar
	</button>
</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Crear nueva Carrera</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{ route('carrerapost-post') }}" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
				<label>
                    Ingrese nombre de la Carrera <br>
                    <input type="text" name="nombre">
                    <br>
                </label>
                <br>
				<label>
                    Ingrese el costo de la Matricula de la Carrera 
					<br>
					<br>
                    <input type="text" name="precioMatricula" >
                    <br>
                </label>
                <div></div>
                <button>Crear Carrera</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
