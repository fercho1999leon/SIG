@extends('layouts.master')
@section('content')
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Editar Materia</h2>
			</div>
		</div>

		<a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
		<div class="wrapper wrapper-content">
			<div class="row">
			<!--{{ route('update_post', $matter) }}-->
				<form action="{{ route('update_post_matter', $matter) }}" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
					<input type="hidden" name="_method" value="PUT" />

				<!--
				<label>
                    Ingrese nombre de la Materia <br>
                    <input type="text" name="nombmatter" value="{{$matter ['nombmatter']  }}">
                    <br>
					<input type="hidden" name="semest_id" value="{{$matter ['semest_id']  }}">
                </lable>
				-->
				<label>
                    Ingrese nombre de la Materia <br>
                    <input type="text" name="nombre" value="{{$matter ['nombre']  }}" >
                    <br>
					<input type="hidden" name="idCurso" value="{{$matter ['idCurso']  }}">

					<input type="hidden" name="idPeriodo" value=4>

                </lable>
				
				<label for="" class="matricula__matriculacion-label">Docente<span class="valorError">*</span></label>
				
				<select class="form-control input-sm" name="idDocente" id="idDocente" value="{{$matter ['idDocente']  }}" required>
					<option value="">Seleccionar...</option>
					
					@foreach($periodos as $periodo)
					
					<option value="{{ $periodo ['id'] }}"> {{ $periodo ['apellidos'] }} {{ $periodo ['nombres'] }}</option>
					 @endforeach
					 

				</select>
				
                <br>
                <div></div>
                <button>Editar Materia</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
