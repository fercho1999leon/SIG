@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Destrezas
			</h2>
		</div>
	</div>
	<div class="row mt-1 mb-1">
		<div class="col-xs-12 ">
			<div class="agregarSeccionCont">
				<a href="">
					<button class="btn dirConfiguraciones__instituto--agregarInfo">Añadir Clase Destreza</button>
				</a>
			</div>
		</div>
		<div class="col-xs-12 mt-1">
			<div class="panel panel-default">
				<div class="pined-table-responsive">
					<div class="d-f">
						<div class="mr-3">
							<table class="s-calificaciones">
								<tr class="table__bgBlue">
									<td class="text-center no-border">#</td>
									<td class="no-border fz19">Estudiante</td>
								</tr>
                @foreach($Students as $index => $student)
								<tr>
                    <td class="text-center">{{($index+1)}}</td>
  									<td class="">{{$student->apellidos}}, {{$student->nombres}}</td>
								</tr>
                @endforeach
							</table>
						</div>
						<div>
							<table class="s-calificaciones">
								<tr class="table__bgBlue">
									<td colspan="3" class="no-border fz19">Listado destrezas</td>
								</tr>
								<tr>
									<td>Nombre de la destreza etc etc</td>
									<td class="text-center">
										<a href="">
											<i class="fa fa-pencil icon__ver"></i>
										</a>
									</td>
									<td class="text-center">
										<a href="">
											<i class="fa fa-trash icon__eliminar"></i>
										</a>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
