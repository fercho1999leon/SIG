@extends('layouts.master')
@section('content')
<a class="button-br" href="{{route('grade_score')}}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg noBefore titulo-separacion">
        <h2 class="title-page"><i class="fa fa-edit icon__title text-color3">
			</i> Examen del Quimestre
		</h2>
		<select class="select__header form-control" id="mySelect">
			<option value="">Quimestre 1</option>
		</select>
    </div>
    <div class="wrapper wrapper-content dir-calificaciones mb350" id="alumnos">
        <div class="row mb-1">
            <div class="col-lg-12">
                <td>
                    <a target="_blank" href="" class="btn btn-primary calificaciones__materia-actualizar">Libretas alumnos</a>
                </td>
                <td>
                    <a target="_blank" align="right" class="btn btn-primary calificaciones__materia-actualizar" href="">
                        Reporte general
                    </a>
                </td>
                <td>
                    <a target="_blank" class="btn btn-primary calificaciones__materia-actualizar" href="">Cuadro de calificaciones</a>
                </td>

                <td>
                    <a target="_blank" href="" class="btn btn-primary calificaciones__materia-actualizar">Estadisticas</a>
                </td>
                <td>
                    <a target="_blank" href="" class="btn btn-primary calificaciones__materia-actualizar">Calificaciones Pendientes</a>
                </td>
            </div>
        </div>
        <!-- Todas Las Materias -->
        <div>
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones">
                        <tr>
							<td colspan="2"  class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
							<td class="text-center bold">P1</td>
							<td class="text-center bold">P2</td>
							<td class="text-center bold">P3</td>
							<td class="text-center bold">EX</td>
							<td class="text-center bold">PQ1</td>
                        </tr>
						<tr>
							<td class="text-center">1</td>
							<td class="uppercase">
								nombre del estudiante
							</td>
							<td class="text-center">0.00</td> 
							<td class="text-center">0.00</td>
							<td class="text-center">0.00</td>
							<td>
								<input type="text"  class="form-control inputQuimestral__note">
							</td>
							<td class="text-center">0.00</td>
						</tr>
                    </table>
				</div>
				<div class="text-center">
					<button class="btn btn-success btn-lg">Guardar</button>
				</div>
            </div>
        </div>
        <div class="modal fade" id="modalMat1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title uppercase" id="curso-modal">
                            <i class="fa fa-bookmark text-color7"></i>Información de la Asignatura</h3>
                    </div>
                    <div class="modal-body ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pined-table-responsive">
                                    <table class="s-calificaciones w100">
                                        <tr>
                                            <td class="bg_color7 text-right fz19">Nombre</td>
                                            <td class="text-left fz19">Ciencias Naturales</td>
                                        </tr>
                                        <tr>
                                            <td class="bg_color7 text-right fz19">Aporta al promedio</td>
                                            <td class="text-left fz19">Si</td>
                                        </tr>
                                        <tr>
                                            <td class="bg_color7 text-right fz19">Cuantitativa</td>
                                            <td class="text-left fz19">Si</td>
                                        </tr>
                                        <tr>
                                            <td class="bg_color7 text-right fz19">Clase</td>
                                            <td class="text-left fz19">Ciencias Naturales</td>
                                        </tr>
                                        <tr>
                                            <td class="bg_color7 text-right fz19">Referencia</td>
                                            <td class="text-left fz19">Octavo A | Educación General Básica</td>
                                        </tr>
                                        <tr>
                                            <td class="bg_color7 text-right fz19">Profesor</td>
                                            <td class="text-left fz19">Mery Urbina Andaluz</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
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
</script>
@endsection
