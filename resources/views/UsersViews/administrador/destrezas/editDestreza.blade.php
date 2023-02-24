@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<a class="button-br" href="{{route('showDestrezasMateriaAdmin', [$idMateria, $parcial])}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">Destrezas 
                <small>Editar</small>
            </h2>
        </div>
    </div>
    <div class="row mt-1 mb350">
       <div class="col-xs-12 ">
            <form method="post" action="{{ route('updateDestrezasAdmin')}}">
				{{ method_field('PUT') }}
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $destreza->id }}">
				<input type="hidden" name="parcial" value="{{$parcial}}">
                <div class="agendaEscolar__crearTarea-grid crearDestreza-container">
                    <div class="agendaEscolar__crearTarea-materia-parcial">
                        <select name="grado" id="selectGrado" class="form-control">
                            <option value="">Seleccionar grado...</option>
                            @foreach($arrayCourses as $course)
                                <option value="{{$course->grado}}" {{ ($course->grado == $destreza->grado ) ? ' selected' : '' }}>{{$course->grado}}</option>
                            @endforeach
                        </select>
                        <select name="idMateriaGrado" id="materiasGrado" class="form-control">
                            <!-- <option value="">Seleccione una materia...</option>
                            @foreach($matters as $matter)
                                {{ $matter }}
                            @endforeach -->
                        </select>
                    </div>
                    <input name="nombre" value="{{$destreza->nombre}}" type="text" class="form-control" placeholder="Nombre de la destreza...">
                    <textarea name="desc" value="{{$destreza->descripcion}}" id="" cols="30" rows="10" class="form-control" placeholder="Descripción de la destreza">{{$destreza->descripcion}}</textarea>

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
  $.get("{{ route('materias')}}", { grado: $(this).val() }, function (data) {
    $('#materiasGrado').empty();

    $("#materiasGrado").html('<option value="">Seleccione una materia...</option>');
    $.each(data, function (key,value){
      $('#materiasGrado').append($("<option></option>").attr("value",value.id).text(value.nombre));
    });
  });
});



window.onload = function(){
  // grado = $('#selectGrado').val();
  $.get("{{ route('materiasAdmin')}}", { grado: $('#selectGrado').val() }, function (data) {
    $('#materiasGrado').empty();

    $("#materiasGrado").html('<option value="">Seleccione una materia...</option>');
    
    $.each(data, function (key,value){
      if({{$destreza->idMateria}}==value.id){
        $('#materiasGrado').append($("<option></option>").attr({value:value.id,selected:"selected"}).text(value.nombre));

      }
      else{
        $('#materiasGrado').append($("<option></option>").attr({value:value.id}).text(value.nombre));

      }
    });
  });
};




</script>
@endsection
