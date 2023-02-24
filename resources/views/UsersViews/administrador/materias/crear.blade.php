@extends('layouts.master')
@section('content')
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Crear Materia</h2>
			</div>
		</div>
		<a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{ route('materiapost-post') }}" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
				<label>
                    Ingrese nombre de la Materia <br>
                    <input type="text" name="nombre">
                    <br>
					<input type="hidden" name="idCurso" value={{$id}}>
					<input type="hidden" name="idPeriodo" value=4>

                </lable>
				
				<!--<label for="" class="matricula__matriculacion-label">Periodo<span class="valorError">*</span></label>
				
				<select class="form-control input-sm" name="idPeriodo" id="idPeriodo" required>
					<option value="">Seleccionar...</option>
					
					@foreach($periodos as $periodo)
					
					 <option value="{{ $periodo ['id'] }}">{{ $periodo ['nombre'] }}</option>
					 @endforeach
					

				</select>-->
				
				<label for="" class="matricula__matriculacion-label">Docente<span class="valorError">*</span></label>
				
				<select class="form-control input-sm" name="idDocente" id="idDocente" required>
					<option value="">Seleccionar...</option>
					
					@foreach($periodos as $periodo)
					
					 <option value="{{ $periodo ['id'] }}"> {{ $periodo ['apellidos'] }} {{ $periodo ['nombres'] }}</option>
					 @endforeach
					 

				</select>
				
				<!--
				<label>
                    Ingrese nombre del Docente <br>
                    <input type="text" name="docente">
                    <br>
                </lable>-->
				
                <br>
                <div></div>
                <button>Crear Materia</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
