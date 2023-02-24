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
                    <input type="text" name="nombsemt" value="{{$semester ['nombsemt']  }}">
                    <br>
					<input type="hidden" name="career_id" value="{{$semester ['career_id']  }}">

                </lable>
				
				
                <br>
                <div></div>
                <button>Editar Semestre</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
