@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{route('grade_score')}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento
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
			<div class="white-bg p-1">
				<div class="pined-table-responsive">
					<div class="comportamiento-grid">
							<table class="s-calificaciones">
								<tr class="table__bgBlue">
									<td class="text-center no-border">#</td>
									<td class="no-border">Estudiante</td>
									<td class="no-border">Comportamiento</td>
									<td class="no-border">Observaciones</td>
									<td class="no-border" colspan="2">Recomendaciones</td>
								</tr>
								@foreach($students as $student)
								<tr>
									<td> {{ $count++ }} </td>
									<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
										<td>
											@if($student->p1q1C!=null)
												<p class="no-margin fz19 bold text-center p1q1" style="display:;">{{ $student->p1q1C }}</p>
											@else
												<p class="no-margin fz19 bold text-center p1q1" style="display:;">Sin Calificar</p>
											@endif
											@if($student->p2q1C!=null)
												<p class="no-margin fz19 bold text-center p2q1" style="display:none;">{{ $student->p2q1C }}</p>
											@else
												<p class="no-margin fz19 bold text-center p2q1" style="display:none;">Sin Calificar</p>
											@endif
											@if($student->p3q1C!=null)
												<p class="no-margin fz19 bold text-center p3q1" style="display:none;">{{ $student->p3q1C }}</p>
											@else
												<p class="no-margin fz19 bold text-center p3q1" style="display:none;">Sin Calificar</p>
											@endif
											@if($student->p1q2C!=null)
												<p class="no-margin fz19 bold text-center p1q2" style="display:none;">{{ $student->p1q2C }}</p>
											@else
												<p class="no-margin fz19 bold text-center p1q2" style="display:none;">Sin Calificar</p>
											@endif
											@if($student->p2q2C!=null)
												<p class="no-margin fz19 bold text-center p2q2" style="display:none;">{{ $student->p2q2C }}</p>
											@else
												<p class="no-margin fz19 bold text-center p2q2" style="display:none;">Sin Calificar</p>
											@endif
											@if($student->p3q2C!=null)
												<p class="no-margin fz19 bold text-center p3q2" style="display:none;">{{ $student->p3q2C }}</p>
											@else
												<p class="no-margin fz19 bold text-center p3q2" style="display:none;">Sin Calificar</p>
											@endif
										</td>
										<td>
											<textarea disabled  class="p1q1 form-control comportamiento-textarea" name="" id="" style="display:;">{{ $student->p1q1O }}</textarea>
											<textarea disabled  class="p2q1 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p2q1O }}</textarea>
											<textarea disabled  class="p3q1 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p3q1O }}</textarea>
											<textarea disabled  class="p1q2 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p1q2O }}</textarea>
											<textarea disabled  class="p2q2 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p2q2O }}</textarea>
											<textarea disabled  class="p3q2 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p3q2O }}</textarea>
										</td>
										<td>
											<textarea disabled class="p1q1 form-control comportamiento-textarea" name="" id="" style="display:;">{{ $student->p1q1R }}</textarea>
											<textarea disabled class="p2q1 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p2q1R }}</textarea>
											<textarea disabled class="p3q1 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p3q1R }}</textarea>
											<textarea disabled class="p1q2 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p1q2R }}</textarea>
											<textarea disabled class="p2q2 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p2q2R }}</textarea>
											<textarea disabled class="p3q2 form-control comportamiento-textarea" name="" id="" style="display:none;">{{ $student->p3q2R }}</textarea>
										</td>
										<td>
											<a href="{{ route('RutaComportamientoEdit', $student->id )}}" class="editarComportamiento">
													<i class=" fa fa-pencil icon__ver"></i>
												</a>
										</td>
									</tr>
								@endforeach
							</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection


@section('scripts')
<script>
$('.editarComportamiento').click(function (e) {
	e.preventDefault();
	window.location.href = $(this).attr('href') + "/" + $('#mySelect').val();
})



$('#mySelect').change(desplegar);

function desplegar(){
	var parcial =   $('#mySelect').val();
	switch(parcial){
		case "p1q1":
			$('.p1q1').attr('style','display:block;');
			$('.p2q1').attr('style','display:none;');
			$('.p3q1').attr('style','display:none;');
			$('.p1q2').attr('style','display:none;');
			$('.p2q2').attr('style','display:none;');
			$('.p3q2').attr('style','display:none;');
		break;
		case "p2q1":
			$('.p1q1').attr('style','display:none;');
			$('.p2q1').attr('style','display:block;');
			$('.p3q1').attr('style','display:none;');
			$('.p1q2').attr('style','display:none;');
			$('.p2q2').attr('style','display:none;');
			$('.p3q2').attr('style','display:none;');
		break;
		case "p3q1":
			$('.p1q1').attr('style','display:none;');
			$('.p2q1').attr('style','display:none;');
			$('.p3q1').attr('style','display:block;');
			$('.p1q2').attr('style','display:none;');
			$('.p2q2').attr('style','display:none;');
			$('.p3q2').attr('style','display:none;');
		break;
		case "p1q2":
			$('.p1q1').attr('style','display:none;');
			$('.p2q1').attr('style','display:none;');
			$('.p3q1').attr('style','display:none;');
			$('.p1q2').attr('style','display:block;');
			$('.p2q2').attr('style','display:none;');
			$('.p3q2').attr('style','display:none;');
		break;
		case "p2q2":
			$('.p1q1').attr('style','display:none;');
			$('.p2q1').attr('style','display:none;');
			$('.p3q1').attr('style','display:none;');
			$('.p1q2').attr('style','display:none;');
			$('.p2q2').attr('style','display:block;');
			$('.p3q2').attr('style','display:none;');
		break;
		case "p3q2":
			$('.p1q1').attr('style','display:none;');
			$('.p2q1').attr('style','display:none;');
			$('.p3q1').attr('style','display:none;');
			$('.p1q2').attr('style','display:none;');
			$('.p2q2').attr('style','display:none;');
			$('.p3q2').attr('style','display:block;');
		break;
	}
	
}
</script>

@endsection