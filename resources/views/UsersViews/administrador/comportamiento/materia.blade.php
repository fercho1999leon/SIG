@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento <small> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} </small></h2>
			<select class="select__header form-control" id="mySelect">
				<optgroup label="Quimestre 1">
					<option value="p1q1" {{$parcial == 'p1q1' ? 'selected' : '' }}>Q1 - Parcial 1</option>
					<option value="p2q1" {{$parcial == 'p2q1' ? 'selected' : '' }}>Q1 - Parcial 2</option>
					<option value="p3q1" {{$parcial == 'p3q1' ? 'selected' : '' }}>Q1 - Parcial 3</option>
				</optgroup>
				<optgroup label="Quimestre 2">
					<option value="p1q2" {{$parcial == 'p1q2' ? 'selected' : '' }}>Q2 - Parcial 1</option>
					<option value="p2q2" {{$parcial == 'p2q2' ? 'selected' : '' }}>Q2 - Parcial 2</option>
					<option value="p3q2" {{$parcial == 'p3q2' ? 'selected' : '' }}>Q2 - Parcial 3</option>
				</optgroup>
			</select>
        </div>
    </div>
    <div class="row mt-1 mb350">
		<div class="col-xs-1">
		</div>
		<div class="col-xs-10">
			<div class="comportamiento__estudiante"></div>
			<div class="col-xs-12">
				<div class="comportamiento__estudiante-grid">
					<div class="comportamiento__estudiante">
						<h3 class="text-center uppercase">Estudiante</h3>
						<div class="comportamiento__estudiante__form">
							<div>
								<label for="">Calificación</label>
								<select name="" id="" class="form-control">
									<option value="">---</option>
								</select>
							</div>
							<div>
								<label for="">Observación o Recomendación</label>
								<textarea rows="5" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="text-center mt-1">
					<button class="btn btn-lg btn-primary" type="submit">ACTUALIZAR</button>
				</div>
			</div>
		</div>
		<div class="col-xs-1">
		</div>
	</div>
</div>
</div>
@endsection