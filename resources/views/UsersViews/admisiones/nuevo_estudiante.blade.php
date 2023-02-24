@extends('UsersViews.admisiones.style')
@section('assets')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="{{ secure_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
<link href="{{ secure_asset('css/style.css')}}" rel="stylesheet">
<style type="text/css" media="screen">
  .matricula__matriculacion-block {
    display: block;
  }
</style>
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
  </ul>
</div>
@endif
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<div class="container">
  <div class="row">
    <div class="col-sm-10 mt-3 col-sm-offset-1">
      <div class="row wrapper rounded-lg " style="background-color: rgba(255,255,255,0.85); margin-bottom: 5rem;">
        <div class="row">
          <div class="col-sm-12 mt-12">
            <img @if(DB::table('institution')->where('id', '1')->first()->logo == null)
            src="{{ secure_asset('img/logo/logo.png') }}"
            @else
              src="{{ secure_asset('/storage/logo/ISTRED2.png')}}" width="30%" style="margin-top: 15px;;"
            @endif
            alt="" width="70">
          </div>
          <!--src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" width="90"-->
          <div class="d-flex justify-content-center">
            <h1 class="title-page">Nuevo Estudiante</h1>
          </div>
          <div class="wrapper wrapper-content">
            <form method="post" action="{{route('crearEstudiante')}}">
              <input type="hidden" value="" name="id_estudiante">
              <input type="hidden" value="" name="id_cliente">
              {{ csrf_field() }}
              @include('UsersViews.admisiones.plantilla_estudiante2', [
              'reporte_pagos' => false,
              'beca' => false,
              'descuento' => false,
              'numeroMatricula' => false,
              'transporte' => true,
              'nivel' => false,
              'retirado' => false,
              'periodo' => false,
              'bloquear' => false,
              'acceso' => false,
              'button' => 'Matricular Estudiante',
              'modalRepresentante' => false,
              'nuevaMatricula' => true,
              'crear' => true,
              ])
              <!--<span class="valorError">Nota: si no tiene datos de representante o padre registrado deje el campo vacío y presione el botón crear estudiante</span>-->
              <div class="text-right">
                <button type="submit" class="mb-1 btn btn-primary btn-lg">Crear Estudiante</button>
              </div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </div>
  <a class="button-br" href="{{route('/')}}">
    <button>
      <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
  </a>
</div>
  @endsection

  <script src="{{ secure_asset('js/theme-js.js') }}"></script>

  <script type="text/javascript">
    //Relaciona el semestre con la carrera
    $(document).ready(function() {
      $('#matricula-curso').on('change', function() {
        let id = $(this).val();
        console.log('entra');
        console.log('id', id);
        $('#matricula-seccion').empty();
        $('#matricula-seccion').append('<option value="0" disabled selected>Seleccione Semestre</option>');
        $.ajax({
          type: 'GET',
          url: 'GetSemestreCarrera/' + id,
          success: function(response) {
            var response = JSON.parse(response);
            console.log(response);
            if (response == '') {
              $('#matricula-seccion').empty();
              $('#matricula-seccion').append('<option value="0" disabled selected>No hay Semestres Disponibles</option>');
            } else {
              //response.forEach(element => {
              //console.log('element',element.nombsemt);
              //$('#matricula-seccion').append('<option value=' + element.id + '>' + element.nombsemt + '</option>');
              //});

              $.each(response, function(i, v) {
                if (v.nombsemt == "Primer Semestre") {
                  $("#matricula-seccion").append('<option value=' + v.id + '>' + v.nombsemt + '</option>');
                }
              });
            }

          }
        });
      });
    });




    //Relaciona el curso con la semestre
    $(document).ready(function() {
      $('#matricula-seccion').on('change', function() {
        let id = $(this).val();
        console.log('entra');
        console.log('id', id);
        $('#matricula-paralelo').empty();
        $('#matricula-paralelo').append('<option value="0" disabled selected>Seleccione Curso</option>');
        $.ajax({
          type: 'GET',
          url: 'GetCursoSemestre/' + id,
          success: function(respuesta) {
            var respuesta = JSON.parse(respuesta);
            console.log(respuesta);
            if (respuesta == '') {
              $('#matricula-paralelo').empty();
              $('#matricula-paralelo').append('<option value="0" disabled selected>No hay Cursos Disponibles</option>');
            } else {


              $.each(respuesta, function(i, c) {
                $("#matricula-paralelo").append('<option value=' + c.id + '>' + c.paralelo + '</option>');

              });
            }

          }
        });
      });
    });




    //$('.js-example-basic-single').select2();
    //});
    //var curso = $('#matricula-curso');
    //var seccion = $('#matricula-seccion');
    //var seccionSelect = $('#matricula-seccion-select');
    //if(curso && seccion && seccionSelect) {
    //curso.change(function() {
    //let sec = $(this).find(':selected').data('seccion')
    //seccionSelect.val(sec) 
    //if(sec == 'EI') {
    //seccion.html('Educación Inicial')
    //} else if(sec == 'EGB') {
    //seccion.html('Educación General Básica')
    //} else if(sec == 'BGU'){
    //seccion.html('Bachillerato General Unificado')
    //} else {
    //seccion.html('Seleccione el semestre xz')
    //}

    //})
    //} else {
    //console.log('no se puedo encontrar el id');
    //}



    function functionDiscapacidad2(value) {
      if (value != '') {
        document.getElementById('block__porcentaje').style.display = 'inline-block';
        document.getElementById('discapacidad_div_vacio').style.display = 'none';
      } else {
        document.getElementById('block__porcentaje').style.display = 'none';
        document.getElementById('discapacidad_div_vacio').style.display = 'inline-block';
      }
    }
  </script>