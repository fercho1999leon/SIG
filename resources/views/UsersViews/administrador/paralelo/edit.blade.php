@extends('layouts.master')
@section('content')
	
    <div id="page-wrapper" class="gray-bg dashbard-1">
		@include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
			<div class="col-lg-12">
				<h2 class="title-page">Editar Paralelo</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="row">
				<form action="#" method="POST" enctype="multipart/form-data">
				<!--<form action="carrerapost-post" method="POST" enctype="multipart/form-data">-->

					{{csrf_field()}}
				<label>
                    Ingrese el Paralelo <br>
                    <input type="text" name="nombre">
                    <br>
                </lable>
				
				
                <br>
                <div></div>
                <button>Editar Paralelo</button>	
					
				</form>
			</div>
		</div>
    </div>
@endsection
