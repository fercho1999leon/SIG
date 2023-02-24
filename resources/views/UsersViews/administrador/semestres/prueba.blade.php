@extends('layouts.master')
@section('content')
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Crear Semestres</h2>
			</div>
		</div>
		<a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="semestrepost-post" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
				<label>
                    Ingrese nombre del Semestre <br>
                    <input type="text" class="form-control"  name="nombsemt">
                    <br>
                    <input type="hidden" class="form-control"  name="career_id" value={{$id}}>
                </lable>
				<!--<label>{{$id}}</label>-->

				<label>
                    Costo Semestre<br>
                    <input  name="costo_semestre" class="form-control"  id="costo_semestre" type="number">
                    <br>
                </lable>
				
				<p>

					Cuotas:
				
					<select name="cuotas" class="form-control"  id="cuotas">
				
					  <option selected>1</option>
				
					  <option>2</option>
				
					  <option>3</option>
				
					  <option>4</option>

					  <option>5</option>

					  <option>6</option>
				
					</select>						 
				
				  </p>
				 

                <br>
				<p>  Tiempo de Vencimiento de las Cuotas:</p>
				  <p> <input type="number" class="form-control" name="tiempo_vencimiento_cuota" id="tiempo_vencimiento_cuota" placeholder="0"></p>
				  <p>
					Fecha de Inicio del Semestre:			
				  </p>
				  <p><input type="date"class="form-control"  name="fecha_inicio_semestre" id="fecha_inicio_semestre" ></p>
				
                <div></div>
                <button>Crear Semestre</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
