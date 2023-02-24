<table class=" ss1 horario-tabla w100">
                            <thead class="scheduler ss1">
                                <tr class="table__bgBlue">
                                    <th class="no-border text-center scheduler">H. Inicio</th>
                                    <th class="no-border text-center scheduler">H. Fin</th>
                                    <th class="no-border text-center scheduler horario-tabla--dias cl">Lunes</th>
                                    <th class="no-border text-center scheduler horario-tabla--dias cl">Martes</th>
                                    <th class="no-border text-center scheduler horario-tabla--dias cl">Miercoles</th>
                                    <th class="no-border text-center scheduler horario-tabla--dias cl">Jueves</th>
                                    <th class="no-border text-center scheduler horario-tabla--dias cl">Viernes</th>
                                    <th class="no-border text-center scheduler horario-tabla--dias cl" style="width: 5%"></th>
                                    <th class="no-border text-center scheduler horario-tabla--dias cl" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="horario">
                                @foreach( $schedulers as $scheduler)
                                <tr>
                                    <td width="50" class="scheduler horario-table--hora">
                                        {{ $scheduler->horaInicio }}
                                    </td>
                                    <td width="50" class="scheduler horario-table--hora">
                                        {{ $scheduler->horaFin }}
                                    </td>
                                    <td class="subject horario-tabla--materia">
                                        @if( $scheduler->idDia1!=null )
                                            @foreach($matters as $matter)
                                                @if( $scheduler->idDia1 ==$matter->id )
                                                    {{ $matter->nombre}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td  class="subject horario-tabla--materia">
                                        @if( $scheduler->idDia2!=null )
                                            @foreach($matters as $matter)
                                                @if( $scheduler->idDia2 ==$matter->id )
                                                    {{ $matter->nombre}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td  class="subject horario-tabla--materia">
                                        @if( $scheduler->idDia3!=null )
                                            @foreach($matters as $matter)
                                                @if( $scheduler->idDia3 ==$matter->id )
                                                    {{ $matter->nombre}}
                                                @endif
                                            @endforeach{{  $scheduler->idDia3 }}
                                        @endif
                                    </td>
                                    <td  class="subject horario-tabla--materia">
                                        @if( $scheduler->idDia4!=null )
                                            @foreach($matters as $matter)
                                                @if( $scheduler->idDia4 ==$matter->id )
                                                    {{ $matter->nombre}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td  class="subject horario-tabla--materia">
                                        @if( $scheduler->idDia5!=null )
                                            @foreach($matters as $matter)
                                                @if( $scheduler->idDia5 ==$matter->id )
                                                    {{ $matter->nombre}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    <td class="subject horario-tabla--materia">
                                        <a href="{{ route('editarHoraClaseDocente_MisClases', $scheduler->id) }}">
                                            <i class="icon__ver fa fa-pencil"></i>
                                        </a>
                                    </td>
                                    <td class="subject horario-tabla--materia">    
                                        <form action="{{ route('eliminarHoraClaseDocente_MisClases', $scheduler->id)}}" method="post" class="icon__eliminar-form">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            
                                            <button type="submit" class="icon__eliminar-btn">
                                                <i class="fa fa-trash"></i>
                                            </button>
                        
                                        </form> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>