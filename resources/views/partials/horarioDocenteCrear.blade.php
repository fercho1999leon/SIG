<table class="s-calificaciones w100">
                                <tr class="table__bgBlue">
                                    <td width="150" class="no-border text-center scheduler">Día</td>
                                    <td class="no-border text-center scheduler">Materia</td>
                                </tr>
                                <tr>
                                    <td class="text-right bold">Hora inicio</td>
                                    <td>
                                        <input type="time" class="form-control" name="horaInicio">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right bold">Hora Fin</td>
                                    <td>
                                        <input type="time" class="form-control" name="horaFin">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right bold">Lunes</td>
                                    <td>
                                        <!--
                                        <input type="text" class="form-control" name="dia1" placeholder="Seleccione la Materia">
                                        -->
                                        <select class="form-control" name="idDia1">
                                            <option value="">Seleccione una materia </option>
                                            @foreach($matters as $matter)
                                                @if($matter->idDocente === $user->id)
                                                    <option value="{{ $matter->id }}">{{ $matter->nombre}} -  {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right bold">Martes</td>
                                    <td>
                                        <!--
                                        <input type="text" class="form-control" name="dia2" placeholder="Seleccione la Materia">
                                        -->
                                        <select class="form-control" name="idDia2">
                                            <option value="">Seleccione una materia </option>
                                            @foreach($matters as $matter)

                                                @if($matter->idDocente === $user->id)
                                                    <option value="{{ $matter->id }}">{{ $matter->nombre}} -  {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right bold">Miércoles</td>
                                    <td>
                                        <!--
                                        <input type="text" class="form-control" name="dia3" placeholder="Seleccione la Materia">
                                        -->
                                        <select class="form-control" name="idDia3">
                                            <option value="">Seleccione una materia </option>
                                            @foreach($matters as $matter)

                                                @if($matter->idDocente === $user->id)
                                                    <option value="{{ $matter->id }}">{{ $matter->nombre}} -  {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right bold">Jueves</td>
                                    <td>
                                        <!--
                                        <input type="text" class="form-control" name="dia4" placeholder="Seleccione la Materia">
                                        -->
                                        <select class="form-control" name="idDia4">
                                            <option value="">Seleccione una materia </option>
                                            @foreach($matters as $matter)

                                                @if($matter->idDocente === $user->id)
                                                    <option value="{{ $matter->id }}">{{ $matter->nombre}} -  {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right bold">Viernes</td>
                                    <td>
                                        <!--
                                        <input type="text" class="form-control" name="dia5" placeholder="Seleccione la Materia">
                                        -->
                                        <select class="form-control" name="idDia5">
                                            <option value="">Seleccione una materia </option>
                                            @foreach($matters as $matter)

                                                @if($matter->idDocente === $user->id)
                                                    <option value="{{ $matter->id }}">{{ $matter->nombre}} -  {{ $courses[$matter->idCurso -1]->grado }} {{$courses[$matter->idCurso -1]->paralelo}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                
                            </table>