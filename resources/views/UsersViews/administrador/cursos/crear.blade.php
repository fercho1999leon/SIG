@extends('layouts.master')
@section('content')	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Crear Curso</h2>
			</div>
		</div>
		<a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{ route('cursopost-post') }}" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
				<label>
                    Ingrese Nombre del Curso <br>
                    <input type="text" name="grado">
                    <br>
					<input type="hidden" name="semester_id" value={{$id}}>
					
                </lable>
				<label>
                    Ingrese Paralelo <br>
                    <input type="text" name="paralelo">
                    <br>
                </lable>
				<label>
					<input type="checkbox" name="esprimersemestre" id="esprimersemestre" > ES PRIMER SEMESTRE
				</lable><br>
				<label>
                    Número de Estudiantes <br>
                    <input type="text" name="nEstudiantes">
                    <br>
                </lable>
				<!--
				<label>
                    Periodo <br>
                    <input type="text" name="idPeriodo">
                    <br>
                </lable>
				-->

				<label for="" class="matricula__matriculacion-label">Periodo<span class="valorError">*</span></label>

				<select class="form-control input-sm" name="idPeriodo" id="idPeriodo" required>
					<option value="">Seleccionar...</option>
					
					@foreach($periodos as $periodo)
					
					 <option value="{{ $periodo ['id'] }}">{{ $periodo ['nombre'] }}</option>
					 @endforeach
					

				</select>
				<!--<label>
                    Dirigente <br>
                    <input type="text" name="dirigente">
                    <br>
                </lable>
				<label>
                    Ingrese nombre del Docente <br>
                    <input type="text" name="docente">
                    <br>
                </lable>-->
				
                <br>
                <div></div>
                <button>Crear Curso</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
