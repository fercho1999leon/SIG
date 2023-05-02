@extends('layouts.master')

@php
    use App\Http\Controllers\SyllabusController;
    use App\User;
@endphp

@section('css')
    <link href="{{ secure_asset('css/syllabus/syllabus.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Incluir el nav_bar_top Cerrar Sesion -->
        @include('layouts.nav_bar_top')

        <div class="row wrapper white-bg ">
            <div class="col-xs-12 seleccion-curso">
                <h2 class="title-page">PEAs</h2>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                @foreach ($materias as $key => $item)
                    <h3 class="a-btn__cursos">{{ $key }}</h3>
                    <div class="a-matricula__estudiantes">
                        @foreach ($item as $materia)
                            @if ($materia->state == 1 && $materia->idCurso != null)
                                <div class="bg-white text-center " style="border-radius: 15px;">
                                    <i class="p-1 text-black fa fa-university fa-4x" aria-hidden="true"></i>
                                    <h3 class="h3 text-uppercase text-black">
                                        {{ $materia->nameDocument }}
                                    </h3>
                                    <div class="btn-group">
                                        <button class="btn btn-primary text-white mb-3" onclick="viewPDF({{$materia->id}})">
                                            VISUALIZAR
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--MODAL VISUALIZAR PDF-->
    <div id="show-pdf" class="modal fade in" role="dialog" >
    
    </div> 
@endsection

@section('scripts')
    <script>
        function viewPDF(id){
            $.ajax({
                url: "{{route('indexPeaView')}}",
                type: 'POST',
                data: {
                    '_token': $('input[name=_token]').val(),
                    id
                },
                success: function(response) {
                    $('#show-pdf').html(response);
                    $('#show-pdf').modal();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
