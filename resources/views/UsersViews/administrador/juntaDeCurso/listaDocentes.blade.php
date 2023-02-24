@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Junta de curso
                <small> Lista de Docentes</small>
            </h2>
        </div>
	</div>
	<div class="row">
		<div class="col-xs-12 mt-3">
			<div class="white-bg p-1 pined-table-responsive">
				<table class="s-calificaciones w100">
					<tr class="table__bgBlue">
						<td rowspan="2" class="text-center">#</td>
						<td rowspan="2" class="text-center">Asignatura</td>
						<td rowspan="2" class="text-center">Docente</td>
						<td width="10%" colspan="2" class="text-center">Asistencia</td>
						<td width="35%" rowspan="2" class="text-center">Firma</td>
					</tr>
					<tr class="table__bgBlue">
						<td class="text-center">Si</td>
						<td class="text-center">No</td>
					</tr>
					<tr>
						<td class="text-center">1</td>
						<td></td>
						<td></td>
						<td class="text-center bold">X</td>
						<td></td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection