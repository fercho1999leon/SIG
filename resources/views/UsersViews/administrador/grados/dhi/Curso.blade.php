@extends('layouts.master')
@section('content')
<a class="button-br" href="{{route('dhiAdmin')}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')

	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">
				{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
			</h2>
			<select class="selectpicker form-control select__header" id="mySelect">
				<optgroup label="Quimestre 1">
					<option value="p1q1">Q1 - Parcial 1</option>
					<option value="p2q1">Q1 - Parcial 2</option>
					<option value="p3q1">Q1 - Parcial 3</option>
				</optgroup>
				<optgroup label="Quimestre 2">
					<option value="p1q2">Q2 - Parcial 1</option>
					<option value="p2q2">Q2 - Parcial 2</option>
					<option value="p3q2">Q2 - Parcial 3</option>
				</optgroup>
			</select>
		</div>
	</div>
	<div class="row mt-1 mb350">
		<div class="col-lg-12">

		</div>
	</div>
</div>
@endsection


