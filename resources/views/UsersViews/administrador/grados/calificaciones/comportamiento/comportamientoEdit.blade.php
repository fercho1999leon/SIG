@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento 
				<small>Editar</small>
			</h2>
		</div>
	</div>
	<div class="row mt-1 mb350">
		<div class="col-lg-12">
			<div class="white-bg p-1">

			<form method="post" action="{{ route('comportamientoUpdate', $student->id) }}">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="editComportamiento-grid">
					<h2 class="text-center no-margin uppercase text-color3" >
						{{ $student->apellidos }} {{ $student->nombres }}</h2>
					<label>Calificación:</label>
					@if($parcial == 'p1q1')
					<select class="form-control input-sm" name="p1q1C">
						@if( $student->p1q1C==null )
							<option value="">SELECCIONE UNA NOTA DE COMPORTAMIENTO</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
						@else
							<option value="A" {{ ("A" == $student->p1q1C ) ? ' selected' : '' }}>A</option>
							<option value="B"  {{ ("B" == $student->p1q1C ) ? ' selected' : '' }}>B</option>
							<option value="C"  {{ ("C" == $student->p1q1C ) ? ' selected' : '' }}>C</option>
							<option value="D"  {{ ("D" == $student->p1q1C ) ? ' selected' : '' }}>D</option>
							<option value="E"  {{ ("E" == $student->p1q1C ) ? ' selected' : '' }}>E</option>
						@endif				
					</select>
					@elseif($parcial == 'p2q1')
					<select class="form-control input-sm" name="p2q1C">
						@if( $student->p2q1C==null )
							<option value="">SELECCIONE UNA NOTA DE COMPORTAMIENTO</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
						@else
							<option value="A" {{ ("A" == $student->p2q1C ) ? ' selected' : '' }}>A</option>
							<option value="B"  {{ ("B" == $student->p2q1C ) ? ' selected' : '' }}>B</option>
							<option value="C"  {{ ("C" == $student->p2q1C ) ? ' selected' : '' }}>C</option>
							<option value="D"  {{ ("D" == $student->p2q1C ) ? ' selected' : '' }}>D</option>
							<option value="E"  {{ ("E" == $student->p2q1C ) ? ' selected' : '' }}>E</option>
						@endif				
					</select>
					@elseif($parcial == 'p3q1')
					<select class="form-control input-sm" name="p3q1C">
						@if( $student->p3q1C==null )
							<option value="">SELECCIONE UNA NOTA DE COMPORTAMIENTO</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
						@else
							<option value="A" {{ ("A" == $student->p3q1C ) ? ' selected' : '' }}>A</option>
							<option value="B"  {{ ("B" == $student->p3q1C ) ? ' selected' : '' }}>B</option>
							<option value="C"  {{ ("C" == $student->p3q1C ) ? ' selected' : '' }}>C</option>
							<option value="D"  {{ ("D" == $student->p3q1C ) ? ' selected' : '' }}>D</option>
							<option value="E"  {{ ("E" == $student->p3q1C ) ? ' selected' : '' }}>E</option>
						@endif				
					</select>
					@elseif($parcial == 'p1q2')
					<select class="form-control input-sm" name="p1q2C">
						@if( $student->p1q2C==null )
							<option value="">SELECCIONE UNA NOTA DE COMPORTAMIENTO</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
						@else
							<option value="A" {{ ("A" == $student->p1q2C ) ? ' selected' : '' }}>A</option>
							<option value="B"  {{ ("B" == $student->p1q2C ) ? ' selected' : '' }}>B</option>
							<option value="C"  {{ ("C" == $student->p1q2C ) ? ' selected' : '' }}>C</option>
							<option value="D"  {{ ("D" == $student->p1q2C ) ? ' selected' : '' }}>D</option>
							<option value="E"  {{ ("E" == $student->p1q2C ) ? ' selected' : '' }}>E</option>
						@endif				
					</select>
					@elseif($parcial == 'p2q2')
					<select class="form-control input-sm" name="p2q2C">
						@if( $student->p2q1C==null )
							<option value="">SELECCIONE UNA NOTA DE COMPORTAMIENTO</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
						@else
							<option value="A" {{ ("A" == $student->p2q2C ) ? ' selected' : '' }}>A</option>
							<option value="B"  {{ ("B" == $student->p2q2C ) ? ' selected' : '' }}>B</option>
							<option value="C"  {{ ("C" == $student->p2q2C ) ? ' selected' : '' }}>C</option>
							<option value="D"  {{ ("D" == $student->p2q2C ) ? ' selected' : '' }}>D</option>
							<option value="E"  {{ ("E" == $student->p2q2C ) ? ' selected' : '' }}>E</option>
						@endif				
					</select>
					@elseif($parcial == 'p3q2')
					<select class="form-control input-sm" name="p3q2C">
						@if( $student->p3q1C==null )
							<option value="">SELECCIONE UNA NOTA DE COMPORTAMIENTO</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
						@else
							<option value="A" {{ ("A" == $student->p3q2C ) ? ' selected' : '' }}>A</option>
							<option value="B"  {{ ("B" == $student->p3q2C ) ? ' selected' : '' }}>B</option>
							<option value="C"  {{ ("C" == $student->p3q2C ) ? ' selected' : '' }}>C</option>
							<option value="D"  {{ ("D" == $student->p3q2C ) ? ' selected' : '' }}>D</option>
							<option value="E"  {{ ("E" == $student->p3q2C ) ? ' selected' : '' }}>E</option>
						@endif				
					</select>
					@endif
					<label>Observación:</label>
					@if($parcial == 'p1q1')
					<textarea cols="30" rows="10" class="form-control" name="p1q1O">{{ $student->p1q1O }}</textarea>
					@elseif($parcial == 'p2q1')
					<textarea cols="30" rows="10" class="form-control" name="p2q1O">{{ $student->p2q1O }}</textarea>
					@elseif($parcial == 'p3q1')
					<textarea cols="30" rows="10" class="form-control" name="p3q1O">{{ $student->p3q1O }}</textarea>
					@elseif($parcial == 'p1q2')
					<textarea cols="30" rows="10" class="form-control" name="p1q2O">{{ $student->p1q2O }}</textarea>
					@elseif($parcial == 'p2q2')
					<textarea cols="30" rows="10" class="form-control" name="p2q2O">{{ $student->p2q2O }}</textarea>
					@elseif($parcial == 'p3q2')
					<textarea cols="30" rows="10" class="form-control" name="p3q2O">{{ $student->p3q2O }}</textarea>
					@endif


					<label>Recomendación:</label>
					@if($parcial == 'p1q1')
					<textarea cols="30" rows="10" class="form-control" name="p1q1R">{{ $student->p1q1R }}</textarea>
					@elseif($parcial == 'p2q1')
					<textarea cols="30" rows="10" class="form-control" name="p2q1R">{{ $student->p2q1R }}</textarea>
					@elseif($parcial == 'p3q1')
					<textarea cols="30" rows="10" class="form-control" name="p3q1R">{{ $student->p3q1R }}</textarea>
					@elseif($parcial == 'p1q2')
					<textarea cols="30" rows="10" class="form-control" name="p1q2R">{{ $student->p1q2R }}</textarea>
					@elseif($parcial == 'p2q2')
					<textarea cols="30" rows="10" class="form-control" name="p2q2R">{{ $student->p2q2R }}</textarea>
					@elseif($parcial == 'p3q2')
					<textarea cols="30" rows="10" class="form-control" name="p3q2R">{{ $student->p3q2R }}</textarea>
					@endif
					
					<button type="submit" class="btn btn-success">ACTUALIZAR</button>
				</div> 
			</form>

			</div>
		</div>
	</div>
</div>
</div>
@endsection