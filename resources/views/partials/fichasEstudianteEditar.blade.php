<!-- Informacion Estudiante -->
<span class="label label-success">Información del Estudiante</span>
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
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Cédula/Pasaporte </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ci" minlength="10" maxlength="10" placeholder="Cédula del estudiante" value="{{ $data->ci }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-general" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Nombres </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nombres" minlength="3" maxlength="100" placeholder="Nombres del estudiante" value="{{ $data->nombres }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Apellidos </span></td>
                                    <td><input type="text" class="form-control input-sm" name="apellidos" minlength="3" maxlength="100" placeholder="Apellidos del estudiante" value="{{ $data->apellidos }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Sexo </span></td>
                                    <td>
                                        @if($data->sexo == "Masculino")
                                            <select class="form-control input-sm" name="sexo">
                                                <option value="Masculino" selected>Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                            </select>
                                        @else
                                            <select class="form-control input-sm" name="sexo">
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino" selected>Femenino</option>
                                            </select>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Fecha de Nacimiento </span></td>
                                    <td><input type="date" class="form-control input-sm" name="fNacimiento" value="{{ $data->fNacimiento }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Ciudad Domicilio </span></td>
                                    <td>
                                        <input type="text" class="form-control input-sm" name="ciudad" minlength="3" maxlength="100" placeholder="Ciudad de domicilio del estudiante" value="{{ $data->ciudad }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Dirección Domicilio </span></td>
                                    <td>
                                        <input type="text" class="form-control input-sm" name="direccion" minlength="5" maxlength="" placeholder="Dirección de domicilio del estudiante" value="{{ $data->direccion }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Teléfono </span></td>
                                    <td>
                                        <input type="text" class="form-control input-sm" name="telefono" minlength="10" maxlength="100" placeholder="Teléfono de domicilio del estudiante" value="{{ $data->telefono }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> N. de Matrícula </span></td>
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
                                    <td class="text-right w25 tabletd_name"><span> Nacionalidad </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nacionalidad" minlength="3" maxlength="100" placeholder="Nacionalidad del estudiante" value="{{ $data->nacionalidad }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Lugar de Nacimiento </span></td>
                                    <td><input type="text" class="form-control input-sm" name="lNacimiento" minlength="3" maxlength="100" placeholder="Lugar de nacimiento del estudiante" value="{{ $data->lNacimiento }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Tipo de Vivienda </span></td>
                                    <td><input type="text" class="form-control input-sm" name="tVivienda" minlength="3" maxlength="100" placeholder="Tipo de vivienda que reside el estudiante" value="{{ $data->tVivienda }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Institución Anterior </span></td>
                                    <td><input type="text" class="form-control input-sm" name="iAnterior" minlength="3" maxlength="100" placeholder="Institución anterior, si existió" value="{{ $data->iAnterior }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Razones por el cambio </span></td>
                                    <td><input type="text" class="form-control input-sm" name="rCambio" minlength="3" maxlength="250" placeholder="Razones de cambio, si lo hubo" value="{{ $data->rCambio }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Observaciones </span></td>
                                    <td><textarea rows="4" cols="50" class="form-control input-sm" name="observaciones">{{ $data->observaciones }}</textarea></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <div id="tab-emergencias" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Clínica / Hosp. de preferencia </span></td>
                                    <td><input type="text" class="form-control input-sm" name="clinica" placeholder="Clinica/Hospital de preferencia para el estudiante" value="{{ $data->clinica }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Indicaciones </span></td>
                                    <td><input type="text" class="form-control input-sm" name="indicaciones" placeholder="Alguna indicación" value="{{ $data->indicaciones }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Tipo de sangre </span></td>
                                    <td><input type="text" class="form-control input-sm" name="tSangre" placeholder="Tipo de sangre del estudiante" value="{{ $data->tSangre }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Contacto de emergencia </span></td>
                                    <td><input type="text" class="form-control input-sm" name="cEmergencia" placeholder="Nombres y Apellidos del contacto de emergencia" value="{{ $data->cEmergencia }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Teléfono del contacto de emergencia </span></td>
                                    <td><input type="text" class="form-control input-sm" name="tEmergencia" placeholder="Teléfono del contacto de emergencia" value="{{ $data->tEmergencia }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-al" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Curso </span></td>
                                    <td>
                                        @if($data->curso == "Inicial 1")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1" selected>Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Inicial 2")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2" selected>Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercer</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Primer Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado" selected>Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Segundo Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado" selected>Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Tercer Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado" selected>Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Cuarto Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado" selected>Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Quinto Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado" selected>Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Sexto Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado" selected>Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Séptimo Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado" selected>Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Octavo Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado" selected>Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Noveno Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado" selected>Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Décimo Grado")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado" selected>Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Primer Año")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año" selected>Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @elseif($data->curso == "Segundo Año")
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año" selected>Segundo</option>
                                                    <option value="Tercer Año">Tercero</option>
                                                </optgroup>
                                            </select>
                                        @else
                                            <select class="form-control input-sm" name="curso">
                                                <optgroup label="Educación Inicial">
                                                    <option value="Inicial 1">Inicial 1</option>
                                                    <option value="Inicial 2">Inicial 2</option>
                                                </optgroup>
                                                <optgroup label="Educación General Básica">
                                                    <option value="Primer Grado">Primero</option>
                                                    <option value="Segundo Grado">Segundo</option>
                                                    <option value="Tercer Grado">Tercero</option>
                                                    <option value="Cuarto Grado">Cuarto</option>
                                                    <option value="Quinto Grado">Quinto</option>
                                                    <option value="Sexto Grado">Sexto</option>
                                                    <option value="Séptimo Grado">Séptimo</option>
                                                    <option value="Octavo Grado">Octavo</option>
                                                    <option value="Noveno Grado">Noveno</option>
                                                    <option value="Décimo Grado">Décimo</option>
                                                    </optgroup>
                                                <optgroup label="Bachillerato General Unificado">
                                                    <option value="Primer Año">Primero</option>
                                                    <option value="Segundo Año">Segundo</option>
                                                    <option value="Tercer Año" selected>Tercero</option>
                                                </optgroup>
                                            </select>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Paralelo </span></td>
                                    <td>
                                        @if($data->paralelo == "A")
                                            <select class="form-control input-sm" name="paralelo">
                                                <option value="A" selected>A</option>
                                                <option value="B">B</option>
                                                <option value="en Ciencias">en Ciencias</option>
                                                <option value="Técnico Informática">Técnico Informática</option>
                                                <option value="Técnico Administración de Sistemas">Técnico Administración de Sistemas</option>
                                                <option value="Técnico de Contabilidad">Técnico de Contabilidad</option>
                                            </select>
                                        @elseif($data->paralelo == "B")
                                            <select class="form-control input-sm" name="paralelo">
                                                <option value="A">A</option>
                                                <option value="B" selected>B</option>
                                                <option value="en Ciencias">en Ciencias</option>
                                                <option value="Técnico Informática">Técnico Informática</option>
                                                <option value="Técnico Administración de Sistemas">Técnico Administración de Sistemas</option>
                                                <option value="Técnico de Contabilidad">Técnico de Contabilidad</option>
                                            </select>
                                        @elseif($data->paralelo == "en Ciencias")
                                            <select class="form-control input-sm" name="paralelo">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="en Ciencias" selected>en Ciencias</option>
                                                <option value="Técnico Informática">Técnico Informática</option>
                                                <option value="Técnico Administración de Sistemas">Técnico Administración de Sistemas</option>
                                                <option value="Técnico de Contabilidad">Técnico de Contabilidad</option>
                                            </select>
                                        @elseif($data->paralelo == "Técnico Informática")
                                            <select class="form-control input-sm" name="paralelo">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="en Ciencias">en Ciencias</option>
                                                <option value="Técnico Informática" selected>Técnico Informática</option>
                                                <option value="Técnico Administración de Sistemas">Técnico Administración de Sistemas</option>
                                                <option value="Técnico de Contabilidad">Técnico de Contabilidad</option>
                                            </select>
                                        @elseif($data->paralelo == "Técnico Administración de Sistemas")
                                            <select class="form-control input-sm" name="paralelo">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="en Ciencias">en Ciencias</option>
                                                <option value="Técnico Informática">Técnico Informática</option>
                                                <option value="Técnico Administración de Sistemas" selected>Técnico Administración de Sistemas</option>
                                                <option value="Técnico de Contabilidad">Técnico de Contabilidad</option>
                                            </select>
                                        @else
                                            <select class="form-control input-sm" name="paralelo">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="en Ciencias">en Ciencias</option>
                                                <option value="Técnico Informática">Técnico Informática</option>
                                                <option value="Técnico Administración de Sistemas">Técnico Administración de Sistemas</option>
                                                <option value="Técnico de Contabilidad" selected>Técnico de Contabilidad</option>
                                            </select>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span><span class="a-asteristicoObligatorio">*</span> Tipo de matricula </span></td>
                                    <td>
                                        @if($data->matricula == "Ordinaria")
                                            <select class="form-control input-sm" name="matricula">
                                                <option value="Ordinaria" selected>Ordinaria</option>
                                                <option value="Extraordinaria">Extraordinaria</option>
                                                <option value="Pre Matricula">Pre-Matricula</option>
                                            </select>
                                        @elseif($data->matricula == "Extraordinaria")
                                            <select class="form-control input-sm" name="matricula">
                                                <option value="Ordinaria">Ordinaria</option>
                                                <option value="Extraordinaria" selected>Extraordinaria</option>
                                                <option value="Pre Matricula">Pre-Matricula</option>
                                            </select>
                                        @else
                                            <select class="form-control input-sm" name="matricula">
                                                <option value="Ordinaria">Ordinaria</option>
                                                <option value="Extraordinaria">Extraordinaria</option>
                                                <option value="Pre Matricula" selected>Pre-Matricula</option>
                                            </select>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
            <label class="a-asteristicoObligatorio">Datos Obligatorios</label>
        </div>
    </div>
</div>

<!-- Informacion Representante -->
<span class="label label-success">Información del Representante</span>
<div class="row">
    <div class="col-lg-12">
        <div class="widget widget-tabs mt-0">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-registroR">Registro</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-generalR">General</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-personalR">Personal</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-domicilioR">Domicilio</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-relacionR">Relación Estudiante</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-observacionesR">Observaciones</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-registroR" class="tab-pane active">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Cédula/Pasaporte </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ciR" minlength="10" maxlength="10" placeholder="Ingrese la cédula/pasaporte del representante" value="{{ $data->ciR }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-generalR" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Nombres </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nombresR" minlength="3" maxlength="100" placeholder="Nombres del representante" value="{{ $data->nombresR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Apellidos </span></td>
                                    <td><input type="text" class="form-control input-sm" name="apellidosR" minlength="3" maxlength="100" placeholder="Apellidos del representante" value="{{ $data->apellidosR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Sexo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="sexoR" value="{{ $data->sexoR }}" required></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Fecha de Nacimiento </span></td>
                                    <td><input type="date" class="form-control input-sm" name="fNacimientoR" value="{{ $data->fNacimientoR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Correo </span></td>
                                    <td><input type="email" class="form-control input-sm" name="correoR" placeholder="Correo del representante" value="{{ $data->correoR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Teléfono móvil </span></td>
                                    <td><input type="text" class="form-control input-sm" name="movilR" minlength="10" maxlength="10" placeholder="Teléfono móvil del representante" value="{{ $data->movilR }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-personalR" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Nacionalidad </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nacionalidadR" maxlength="100" placeholder="Nacionalidad del representante" value="{{ $data->nacionalidadR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Estado civil </span></td>
                                    <td><input type="text" class="form-control input-sm" name="eCivilR" maxlength="100" placeholder="Estado civil del representante" value="{{ $data->eCivilR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Nivel de educación </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nEducacionR" maxlength="100" placeholder="Nivel de educación del representante" value="{{ $data->nEducacionR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Profesión </span></td>
                                    <td><input type="text" class="form-control input-sm" name="profesionR" maxlength="100" placeholder="Profesión del representante" value="{{ $data->profesionR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Ocupación </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ocupacionR" maxlength="100" placeholder="Ocupación del representante" value="{{ $data->ocupacionR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Lugar de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="lTrabajoR" maxlength="100" placeholder="Lugar de trabajo del representante" value="{{ $data->lTrabajoR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Dirección de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="dTrabajoR" maxlength="100" placeholder="Dirección de trabajo del representante" value="{{ $data->dTrabajoR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Teléfono de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="tTrabajoR" maxlength="100" placeholder="Teléfono de trabajo del representante" value="{{ $data->tTrabajoR }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-domicilioR" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Dirección de Domicilio </span></td>
                                    <td><input type="text" class="form-control input-sm" name="dDomicilioR" maxlength="100" placeholder="Dirección domiciliaria del representante" value="{{ $data->dDomicilioR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Teléfono de Domicilio </span></td>
                                    <td><input type="text" class="form-control input-sm" name="tDomicilioR" maxlength="100" placeholder="Teléfono domiciliario del trabajo" value="{{ $data->tDomicilioR }}"></td>
                                </tr>
                            </tbody>
                        </table>             
                    </div>
                    <div id="tab-relacionR" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Relación </span></td>
                                    <td><input type="text" class="form-control input-sm" name="relacionR" maxlength="100" placeholder="Padre/Madre/Otro" value="{{ $data->relacionR }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right" style="background: #EDF3F4"><span> Vive con el estudiante </span></td>
                                    <td><input type="text" class="form-control input-sm" name="vCEstudianteR" maxlength="100" placeholder="Si/No" value="{{ $data->vCEstudianteR }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right" style="background: #EDF3F4"><span> Puede retirar al estudiante </span></td>
                                    <td><input type="text" class="form-control input-sm" name="pRetirarR" maxlength="100" placeholder="Si/No" value="{{ $data->pRetirarR }}"></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <div id="tab-observacionesR" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Tipo de sangre </span></td>
                                    <td><input type="text" class="form-control input-sm" name="sangreR" maxlength="100" value="{{ $data->sangreR }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-right w25 tabletd_name"><span> Adicional </span></td>
                                    <td><input type="text" class="form-control input-sm" name="indicacionesR" maxlength="100" value="{{ $data->indicacionesR }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <label class="a-asteristicoObligatorio">Datos Obligatorios</label>
        </div>
    </div>
</div>

<!-- Informacion de la Madre -->
<span class="label label-success">Información de la Madre del Estudiante</span>
<div class="row">
    <div class="col-lg-12">
        <div class="widget widget-tabs mt-0">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-registroM">Registro</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-generalM">General</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-domicilioM">Domicilio</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-personalM">Personal</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-registroM" class="tab-pane active">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Cédula/Pasaporte </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ciM" minlength="10" maxlength="10" placeholder="Ingrese los 10 digitos de la cédula" value="{{ $data->ciM }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-generalM" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Nacionalidad </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nacionalidadM" minlength="3" maxlength="100" placeholder="Nacionalidad de la madre" value="{{ $data->nacionalidadM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Nombres </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nombresM" minlength="3" maxlength="100" placeholder="Nombres de la madre" value="{{ $data->nombresM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Apellidos </span></td>
                                    <td><input type="text" class="form-control input-sm" name="apellidosM" minlength="3" maxlength="100" placeholder="Apellidos de la madre" value="{{ $data->apellidosM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Fecha de Nacimiento </span></td>
                                    <td><input type="date" class="form-control input-sm" name="fNacimientoM" value="{{ $data->fNacimientoM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Teléfono(movil) </span></td>
                                    <td>
                                        <input type="text" class="form-control input-sm" name="movilM" minlength="10" maxlength="10" placeholder="Celular de la madre" value="{{ $data->movilM }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Correo </span></td>
                                    <td>
                                        <input type="email" class="form-control input-sm" name="correoM" placeholder="Correo de la madre" value="{{ $data->correoM }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div id="tab-domicilioM" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Ciudad </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ciudadM" minlength="3" maxlength="100" placeholder="Ciudad de la madre" value="{{ $data->ciudadM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Dirección </span></td>
                                    <td><input type="text" class="form-control input-sm" name="direccionM" minlength="3" maxlength="100" placeholder="Dirección de la madre" value="{{ $data->direccionM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Teléfono </span></td>
                                    <td><input type="text" class="form-control input-sm" name="telefonoM" minlength="3" maxlength="100" placeholder="Teléfono de la madre" value="{{ $data->telefonoM }}"></td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div id="tab-personalM" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Profesión </span></td>
                                    <td><input type="text" class="form-control input-sm" name="profesionM" minlength="3" maxlength="100" placeholder="Profesión de la madre" value="{{ $data->profesionM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Ocupación </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ocupacionM" minlength="3" maxlength="100" placeholder="Ocupación de la madre" value="{{ $data->ocupacionM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Lugar de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="lTrabajoM" minlength="3" maxlength="100" placeholder="Lugar de trabajo de la madre" value="{{ $data->lTrabajoM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Dirección de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="dTrabajoM" minlength="3" maxlength="100" placeholder="Dirección del trabajo de la madre" value="{{ $data->dTrabajoM }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Teléfono de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="tTrabajoM" minlength="3" maxlength="100" placeholder="Teléfono de trabajo de la madre" value="{{ $data->tTrabajoM }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <label class="a-asteristicoObligatorio">Datos Obligatorios</label>
        </div>
    </div>
</div>

<!-- Informacion del Padre -->
<span class="label label-success">Información del Padre del Estudiante</span>
<div class="row">
    <div class="col-lg-12">
        <div class="widget widget-tabs mt-0">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-registroP">Registro</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-generalP">General</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-domicilioP">Domicilio</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-personalP">Personal</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-registroP" class="tab-pane active">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Cédula/Pasaporte </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ciP" minlength="10" maxlength="10" placeholder="Ingrese los 10 digitos de la cédula" value="{{ $data->ciP }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-generalP" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Nacionalidad </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nacionalidadP" minlength="3" maxlength="100" placeholder="Nacionalidad del padre"  value="{{ $data->nacionalidadP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Nombres </span></td>
                                    <td><input type="text" class="form-control input-sm" name="nombresP" minlength="3" maxlength="100" placeholder="Nombres del padre"  value="{{ $data->nombresP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Apellidos </span></td>
                                    <td><input type="text" class="form-control input-sm" name="apellidosP" minlength="3" maxlength="100" placeholder="Apellidos del padre"  value="{{ $data->apellidosP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Fecha de Nacimiento </span></td>
                                    <td><input type="date" class="form-control input-sm" name="fNacimientoP" value="{{ $data->fNacimientoP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Teléfono(movil) </span></td>
                                    <td>
                                        <input type="text" class="form-control input-sm" name="movilP" minlength="10" maxlength="10" placeholder="Celular del padre" value="{{ $data->movilP }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Correo </span></td>
                                    <td>
                                        <input type="email" class="form-control input-sm" name="correoP" minlength="10" maxlength="100" placeholder="Correo del padre" value="{{ $data->correoP }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <div id="tab-domicilioP" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Ciudad </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ciudadP" minlength="3" maxlength="100" placeholder="Ciudad del padre" value="{{ $data->ciudadP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Dirección </span></td>
                                    <td><input type="text" class="form-control input-sm" name="direccionP" minlength="3" maxlength="100" placeholder="Dirección del padre" value="{{ $data->direccionP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Teléfono </span></td>
                                    <td><input type="text" class="form-control input-sm" name="telefonoP" minlength="3" maxlength="100" placeholder="Teléfono del padre" value="{{ $data->telefonoP }}"></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <div id="tab-personalP" class="tab-pane">
                        <table class="table table-bordered" width="75%">
                            <tbody>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Profesión </span></td>
                                    <td><input type="text" class="form-control input-sm" name="profesionP" minlength="3" maxlength="100" placeholder="Profesión del padre" value="{{ $data->profesionP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Ocupación </span></td>
                                    <td><input type="text" class="form-control input-sm" name="ocupacionP" minlength="3" maxlength="100" placeholder="Ocupación del padre" value="{{ $data->ocupacionP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Lugar de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="lTrabajoP" minlength="3" maxlength="100" placeholder="Lugar de trabajo del padre" value="{{ $data->lTrabajoP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Dirección de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="dTrabajoP" minlength="3" maxlength="100" placeholder="Dirección del trabajo del padre" value="{{ $data->dTrabajoP }}"></td>
                                </tr>
                                <tr>
                                    <td width="25%" class="text-right w25 tabletd_name"><span> Teléfono de Trabajo </span></td>
                                    <td><input type="text" class="form-control input-sm" name="tTrabajoP" minlength="3" maxlength="100" placeholder="Teléfono de trabajo del padre" value="{{ $data->tTrabajoP }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <label class="a-asteristicoObligatorio">Datos Obligatorios</label>
        </div>
    </div>
</div>


<div class="col-lg-12 text-center">
    <button type="submit" class="btn btn-primary">Actualizar</button>
</div>