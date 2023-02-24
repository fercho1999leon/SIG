<div class="row wrapper white-bg ">
    <div class="col-lg-12">
        <h2 class="title-page"><span>Estudiante: </span>{{$data->nombres}} {{$data->apellidos}}</h2>
    </div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
	    <div class="col-lg-12">
	        <div class="widget widget-tabs mt-0">
	            <div class="tabs-container">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a data-toggle="tab" href="#tab-registro">Registro</a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#tab-general">General</a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#tab-adicional">Adicional</a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#tab-emergencias">Emergencias</a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#tab-al">Año Lectivo</a>
	                    </li>
	                </ul>
	                <div class="tab-content">
	                    <div id="tab-registro" class="tab-pane active">
	                        <table class="table table-bordered" width="75%">
	                            <tbody>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Cédula/Pasaporte </span>
	                                    </td>
	                                    <td>
											<p class="no-margin">{{ $data->ci }}</p>
										</td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                    <div id="tab-general" class="tab-pane">
	                        <table class="table table-bordered" width="75%">
	                            <tbody>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Nombres </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->nombres }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Apellidos </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->apellidos }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Sexo </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->sexo }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Fecha de Nacimiento </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->fNacimiento }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Ciudad Domicilio </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->ciudad }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Dirección Domicilio </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->direccion }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Teléfono </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->telefono }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> N. de Matrícula </span>
	                                    </td>
	                                    <td>
	                                        <h6>
	                                            <span class="label label-primary a-numeroMatricula-generado"> {{ $data->id }}</span>
	                                        </h6>
	                                    </td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                    <div id="tab-adicional" class="tab-pane">
	                        <table class="table table-bordered" width="75%">
	                            <tbody>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Nacionalidad </span>
	                                	</td>
	                                    <td><p class="no-margin">{{ $data->nacionalidad }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Lugar de Nacimiento </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->lNacimiento }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Tipo de Vivienda </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->tVivienda }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Institución Anterior </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->iAnterior }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Razones por el cambio </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->rCambio }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Observaciones </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->observaciones }}</p></td>
	                                </tr>
	                            </tbody>
	                        </table> 
	                    </div>
	                    <div id="tab-emergencias" class="tab-pane">
	                        <table class="table table-bordered" width="75%">
	                            <tbody>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Clínica / Hosp. de preferencia </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->clinica }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Indicaciones </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->indicaciones }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Tipo de sangre </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->tSangre }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Contacto de emergencia </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->cEmergencia }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name">
	                                    	<span> Teléfono del contacto de emergencia </span>
	                                    </td>
	                                    <td><p class="no-margin">{{ $data->tEmergencia }}</p></td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                    <div id="tab-al" class="tab-pane">
	                        <table class="table table-bordered" width="75%">
	                            <tbody>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name"><span> Curso </span></td>
	                                    <td><p class="no-margin">{{ $data->curso }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name"><span> Paralelo </span></td>
	                                    <td><p class="no-margin">{{ $data->paralelo }}</p></td>
	                                </tr>
	                                <tr>
	                                    <td class="text-right w25 tabletd_name"><span> Tipo de matricula </span></td>
	                                    <td><p class="no-margin">{{ $data->matricula }}</p></td>
	                                </tr>
	                            </tbody>
	                        </table> 
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>