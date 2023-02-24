@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Destrezas
                <small>Crear</small>
            </h2>
        </div>
    </div>
    <div class="row mt-1 mb350">
       <div class="col-xs-12 ">

            <form method="post" action="{{ route('crearDestrezaDocente') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="agendaEscolar__crearTarea-grid crearDestreza-container">
                    <div class="agendaEscolar__crearTarea-materia-parcial">
                        <select name="grado" id="selectGrado" class="form-control">
                            <option value="">Seleccionar grado...</option>
                            @foreach($arrayCourses as $course)
                                <option value="{{$course->grado}}">{{$course->grado}} {{$course->paralelo}}</option>
                            @endforeach
                        </select>
                        <select name="idMateriaGrado" id="materiasGrado" class="form-control">
                            <!-- <option value="">Seleccione una materia...</option>
                            @foreach($matters as $matter)
                                {{ $matter }}
                            @endforeach -->
                        </select>
                    </div>
                    <input name="nombre" type="text" class="form-control" placeholder="Nombre de la destreza...">
                    <textarea name="desc" id="" cols="30" rows="10" class="form-control" placeholder="Descripción de la destreza"></textarea>

                    <div class="col-lg-12 text-center">
                        <input type="reset" class="btn btn-danger btn-lg" value="Cancelar">
                        <button type="submit" class="btn btn-primary btn-lg">GUARDAR</button>
                    </div>
                </div>

            </form>
       </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$('#selectGrado').change(function() {
  grado = $(this).val();
  $.get('materias', { grado: $(this).val() }, function (data) {
    $('#materiasGrado').empty();

    $("#materiasGrado").html('<option value="">Seleccione una materia...</option>');
    
    $.each(data, function (key,value){
      $('#materiasGrado').append($("<option></option>").attr("value",value.id).text(value.nombre+" - "+value.grado+" "+ value.paralelo));
    });
  });
});
</script>
@endsection
