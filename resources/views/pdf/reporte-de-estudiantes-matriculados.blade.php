@extends('layouts.master-reportes')
@section('style')
	<style>
		.table td,
		.table th {
			font-size: 10pt !important;
		}
	</style>
@endsection
@section('content')
<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="12%">
			<div class="header__logo" style="text-align:left">
				<img 
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)                    
						src="{{ secure_asset('img/logo/logo.png') }}"
					@else
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  
					@endif 
				alt="" width="70">
			</div>
		</th>
		<th class="no-border" width="75%">
			<div class="header__info text-center">
				<h3>{{ $institution->nombre }}</h3>
				<h3>Año Lectivo: {{App\Institution::periodoLectivo()}}</h3>
				<h3>Reporte Estudiantes Matriculados</h3>
			</div>
		</th>
		<th class="no-border" width="12%">
		</th>
	</tr>
</table>
<table class="table">
	<tr>
		<td width="" class="text-center">#</td>
		<td class="text-center">Nombres</td>
		<td class="text-center">Curso</td>
		<td class="text-center">Numero de matricula</td>
	</tr>
	@foreach ($students as $student)
		<tr>
			<td class="text-center">{{$loop->index+1}}</td>
			<td>{{$student->apellidos}} {{$student->nombres}}</td>
			<td>{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}}</td>
			<td>{{$student->numero_matriculacion}}</td>
		</tr>
	@endforeach
</table>

@if(count($studentsRetirados)!=0)
	<table class="table">
		<tr>
			<td class="text-center" colspan="4">
				<h3>Estudiantes Retirados</h3>
			</td>
		</tr>
		<tr>
			<td width="" class="text-center">#</td>
			<td class="text-center">Nombres</td>
			<td class="text-center">Curso</td>
			<td class="text-center">Numero de matricula</td>
		</tr>
		@foreach ($studentsRetirados as $student)
			<tr>
				<td class="text-center">{{$loop->index+1}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}}</td>
				<td>{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}}</td>
				<td>{{$student->numero_matriculacion}}</td>
			</tr>
		@endforeach
	</table>
@endif

	
@endsection