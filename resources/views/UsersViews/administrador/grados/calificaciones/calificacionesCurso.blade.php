@extends('layouts.master')
@section('content')
    <a class="button-br" href="{{ route('grade_score') }}">
        <button>
            <img src="{{ secure_asset('img/return.png') }}" alt="" width="17"> Regresar
        </button>
    </a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">
                    <i class="fa fa-edit icon__title text-color3"></i> Calificaciones
                </h2>
                <select class="select__header form-control" id="mySelect" style="display:none;"> <!--Se agrego display none por que el docente no tiene que cambiar parcial-->
                    @foreach ($unidad as $und)
                        <optgroup label="{{ $und->nombre }}" >
                            @php $parcialP = App\ParcialPeriodico::parcialP($und->id); @endphp
                            @foreach ($parcialP as $par)
                                @if (strlen($par->identificador) < 3)
                                    <option value="{{ $par->identificador }}" 
                                        {{ $par->identificador == $parcial ? 'selected' : '' }} class="uppercase">Promedios
                                        {{ $par->identificador }}</option>
                                @else 
                                    <option value="{{ $par->identificador }}" 
                                        {{ $par->identificador == $parcial ? 'selected' : '' }}>{{ $par->nombre }}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>



            </div>
            <div class="row wrapper migajasDePan">
                <div class="col-lg-12">
                    <div class="border">
                        <a class="no-pointer">{{ $course->grado }} {{ $course->paralelo }}
                            {{ $course->especializacion }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper wrapper-content dir-calificaciones mb350" id="alumnos">
            <!-- Todas Las Materias -->
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones" style="margin-top: 110px;">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            @foreach ($matters as $matter)
                                <td class="no-border">
                                    <p class="s-calificaciones__materia" style="top:0">
                                        <span>{{ mb_substr($matter->nombre, 0, 20, 'UTF-8') }}</span>
                                    </p>
                                </td>
                            @endforeach
                         
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">
                                Estudiantes</td>
                            @foreach ($matters as $matter)
                                <td class="text-center">
                                    @if (strlen($parcial) > 2)
                                        @if((App\ConfiguracionSistema::editaCalificaciones())->valor != 0)
                                        <a href="#" class="rutaMateria"
                                            ruta="{{ route('grade_score_course_matter') }}"
                                            materia="{{ $matter->id }}">
                                        @endif
                                    @else
                                        <a href="#" class="rutaMateria"
                                            ruta="{{ route('examenQuimestral', $matter->id) }}"
                                            materia="{{ $parcial }}">
                                    @endif
                                    <i class="fa fa-eye "></i>
                                    </a>
                                </td>
                                <input type="hidden">
                            @endforeach
                        </tr>
                        @foreach ($students as $student)
                            @php
                                if (strlen($parcial) > 2) {
                                    $promedio = $data->where('estudianteId', $student->idStudent)->first();
                                } else {
                                    $promedio = $data2->where('estudianteId', $student->idStudent)->first();
                                }
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td style="text-transform: uppercase;">{{ $student->apellidos }},
                                    {{ $student->nombres }}

                                </td>
                                @foreach ($matters as $matter)
                                    @php
                                        $p = new \Illuminate\Support\Collection($promedio->parcial);
                                        $parcialMateria = $p->where('materiaId', $matter->id)->first();
                                        //dd($p);
                                    @endphp
                                    <td class="text-center">
                                        {{ strlen($parcial) > 2 ? bcdiv($parcialMateria->promedioFinal, '1', 2) : bcdiv($parcialMateria->promedioquimestral, '1', 2) }}
                                        <!--@if (isset($parcialMateria->promedioInicial) && isset($parcialMateria->promedioFinal))
                                            @if ($parcialMateria->promedioInicial != $parcialMateria->promedioFinal)
                                                <p style="color: orange;">*</p>
                                            @endif
                                        @endif-->
                                    </td>
                                @endforeach
                             
                                <td class="text-center" style="display:none">0.00</td>                         
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        cargarNotas();
        $('#mySelect').change(function() {
            var id = "{{ $course->id }}";
            window.location.href = "{{ route('promedioCurso') }}/" + id + "/" + $('#mySelect').val();
        });

        function cargarNotas() {
            var seleccion = $("#mySelect").val();
            $('.rutaMateria').each(function(key, val) {
                var ruta = $(this).attr('ruta');
				//console.log(seleccion);
                var materia = $(this).attr('materia');
                if (seleccion != "q1" && seleccion != "q2") {
                    $(val).attr('href', ruta + '/' + materia + '/' + seleccion);
                } else {
                    $(val).attr('href', ruta + '/' + materia);
                }
            });
        }
    </script>
@endsection

<!-- Modal -->
<div class="modal fade" id="notaCualitativa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
function getParcial()
{ 
  return $("#mySelect").val();
}
</script>
@endsection