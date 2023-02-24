@extends('layouts.master')
@section('content')
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Editar Semestre</h2>
			</div>
		</div>
		<a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="{{ route('update_post_semester', $semester) }}" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
					<input type="hidden" name="_method" value="PUT" />
				<label>
                    Ingrese nombre del Semestre <br>
                    <input type="text"  class="form-control" name="nombsemt" value="{{$semester ['nombsemt']  }}">
                    <br>
					<input type="hidden" class="form-control" name="career_id" value="{{$semester ['career_id']  }}">
                </lable>

				<label>
                    Costo Semestre<br>
                    <input class="form-control" name="costo_semestre" id="costo_semestre" type="number" value="{{$semester ['costo_semestre']  }}">
                    <br>
                </lable>
				
				<p>Cuotas:</p>
				<p>				
					<select name="cuotas" id="cuotas" class="form-control">
						
				  @for ($i = 1; $i < 13; $i++)

				    @if ($semester ['cuotas']==$i)
					<option selected>{{$semester ['cuotas']}}</option>
					@else
					<option>{{$i}}</option>	
					@endif
					  
				  @endfor					  
				
					</select>						 
				  </p>

				  <p>  Tiempo de Vencimiento de las Cuotas:</p>
				  <p> <input type="number" class="form-control" name="tiempo_vencimiento_cuota" id="tiempo_vencimiento_cuota" placeholder="0" value="{{$semester ['vencimiento_cuotas']  }}"></p>
				  <p>
					Fecha de Inicio del Semestre:			
				  </p>
				  <p><input type="date"class="form-control"  name="fecha_inicio_semestre" id="fecha_inicio_semestre" value="{{$semester ['inicio_semestre']  }}"></p>
				
                <br>
                <div></div>
                <button>Editar Semestre</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
