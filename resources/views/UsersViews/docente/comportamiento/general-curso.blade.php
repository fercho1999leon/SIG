@extends('layouts.master')
@section('content')
@php
use app\comportamientoMateria;
use app\Student2;
$unidad = App\UnidadPeriodica::unidadP();
@endphp
<a class="button-br" href="{{route('docente-comportamiento')}}">
    <button>
      <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
  </a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento <small> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} / {{$materia->nombre}} </small></h2>
			<select class="select__header form-control" id="selectParcial" >
                    @foreach($unidad as $und)
                    <optgroup label="{{$und->nombre}}">
                        @php
                        $parcialP = App\ParcialPeriodico::parcialP($und->id);
                        @endphp
                        @foreach($parcialP as $par )
                            <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                        @endforeach
                        </optgroup>
                    @endforeach
                    <option value="anual" {{$parcial == 'anual' ? 'selected' : ''}}>Anual</option>
                </select>
        </div>
    </div>
<div id="principalPanel">
  @section('contentPanel')

  @endsection

</div>
</div>
</div>
@endsection
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@section('scripts')
	<script type="text/javascript">
  $( document ).ready(function() {
        const url = "/docente/comportamiento-curso-new"
        const idCurso = '{{$materia->id}}'
        const selectParciales = document.getElementById('selectParcial').value;
        const newurl = `${url}/${idCurso}/${selectParciales}`
        ajaxRenderSection(newurl);
  });
    function ajaxRenderSection(url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#principalPanel').empty().append($(data));
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
    }
     function add_comportamientos($id,$parcial){
        var url = window.location;
        var descripcion = [];
        var contador = $('#contador').val();
          for (var i = 1; i <= contador ; i++) {
        var select = $('#select_nota'+i).val();
        var textA = $('#text_area'+i).val();
        var inputID = $('#id_estudiante'+i).val();
            if (select!='0'  && inputID!='') {

                descripcion.push(inputID+'|*|'+select+'|*|'+textA);

          }


  }
  axios.post('{{route('addComportamientoNew')}}', {
            descripcion: descripcion,
            id_materia: $id,
            parcial: $parcial,

        }).then(response => {
        if (typeof newurl == "undefined"){
             const url = "/docente/comportamiento-curso-new"
             const idCurso = '{{$materia->id}}'
             const parcial =  document.getElementById('selectParcial').value;
             var  newurl = `${url}/${idCurso}/${parcial}`;
          }
            Swal.fire({
            title: "Actualizado",
            icon: "success",
            });
             ajaxRenderSection(newurl);

        }).catch(e => {
            console.log(e);

        });
}
 function eliminar_comportamiento($id){
     //var url = window.location;

     Swal.fire({
      title: "Realmente desea eliminar el Comportamiento",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
      }).then((result) => {
          if (result.value==true) {
            if (typeof newurl == "undefined"){
             const url = "/docente/comportamiento-curso-new"
             const idCurso = '{{$materia->id}}'
             const parcial =  document.getElementById('selectParcial').value;
             var  newurl = `${url}/${idCurso}/${parcial}`;
          }
                axios.get('/docente/comportamiento-curso-eliminar/'+$id)
                .then(response => {
                  ajaxRenderSection(newurl);
               // $('#mostrar_'+$id).css('display', 'none')
                })
                .catch(e => {
                // Podemos mostrar los errores en la consola
                console.log(e);
                })
            }
        });

  }
  </script>
   <script>
        const url = "/docente/comportamiento-curso-new"
        const idCurso = '{{$materia->id}}'
        const selectParciales = document.getElementById('selectParcial')
        if(selectParciales) {
            selectParciales.addEventListener('change', function() {
                const parcial = selectParciales.value
                    newurl = `${url}/${idCurso}/${parcial}`
               ajaxRenderSection(newurl);
            })
        } else {
            console.log('no se pudo obtener el id del select')
        }
    </script>
@endsection