<table class="s-calificaciones w100">
                            <tr class="table__bgBlue">
                                <td width="150" class="no-border text-center scheduler">Día</td>
                                <td class="no-border text-center scheduler">Materia</td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Hora inicio</td>
                                <td>
                                    <input type="time" class="form-control" name="horaInicio" value="{{ $data->horaInicio }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Hora Fin</td>
                                <td>
                                    <input type="time" class="form-control" name="horaFin" value="{{ $data->horaFin }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Lunes</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia1">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia1 ) ? ' selected' : '' }}>{{ $matter->nombre}} - {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                                 
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Martes</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia2">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia2 ) ? ' selected' : '' }}>{{ $matter->nombre}} - {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Miércoles</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia3">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia3 ) ? ' selected' : '' }}>{{ $matter->nombre}} - {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Jueves</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia4">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia4 ) ? ' selected' : '' }}>{{ $matter->nombre}} - {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right bold">Viernes</td>
                                <td>
                                    <select class="form-control input-sm" name="idDia5">
                                        <option value="">Seleccione la materia</option>
                                            @foreach($matters as $matter)
                                                <option value="{{ $matter->id}}" {{ ($matter->id == $data-> idDia5 ) ? ' selected' : '' }}>{{ $matter->nombre}} - {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                            @endforeach
                                    </select>
                                </td>
                            </tr>
                            
                        </table>