@extends('layouts.master')
@section('content')
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Editar Curso</h2>
			</div>
		</div>

		<a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
	
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{ route('update_post_curso', $curso) }}" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
					<input type="hidden" name="_method" value="PUT" />
				<label>
                    Ingrese Nombre del Curso <br>
					<select class="form-control input-sm" name="grado" id="grado" required>
						<option value="">Seleccionar...</option>
						@foreach($grados as $grado)
							<option value="{{$grado}}" {{$curso->grado == $grado ? 'selected' : ''}}>{{ $grado }}</option>
						@endforeach
					</select>
                    
					<input type="hidden" name="id_career" value="{{$curso['id_career']}}">
					
                </label>
				<br>
				<label>
                    Ingrese Paralelo <br>
                    <input type="text" name="paralelo" id="paralelo" value="{{$curso['paralelo']}}">
                    <br>
                </label>
				<label>
					<input type="checkbox" name="esprimersemestre" id="esprimersemestre"  id="esprimersemestre" {{$curso['esprimersemestre'] == 0 ? '' : 'checked'}}> ES PRIMER SEMESTRE
				</label><br>
				<label>
                    Número de Estudiantes <br>
                    <input type="text" name="nEstudiantes" id="nEstudiantes" value="{{$curso['nEstudiantes']  }}">
                    <br>
                </label>
				<!--
				<label>
                    Periodo <br>
                    <input type="text" name="idPeriodo">
                    <br>
                </lable>
				-->
				<br>	
				<label for="" class="matricula__matriculacion-label">Periodo<span class="valorError">*</span></label>
				<select class="form-control input-sm" name="idPeriodo" id="idPeriodo" required>
					<option value="">Seleccionar...</option>
					@foreach($periodos as $periodo)
						<option value="{{$periodo['id']}}" {{$curso->idPeriodo == $periodo->id ? 'selected' : ''}}>{{ $periodo['nombre'] }}</option>
					@endforeach

				</select>




                <br>
                <div></div>
                <button>Editar Curso</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
