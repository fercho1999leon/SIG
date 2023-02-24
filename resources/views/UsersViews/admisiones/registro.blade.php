@extends('UsersViews.admisiones.style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<div class="row wrapper white-bg ">
@if(Session::has('message'))
     <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<a class="button-br" href="{{route('admision')}}">
    <button>
      <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
  </a>
<div class="container">
        <div class="row mt-10">
            <div class="col-md-8">
              <h2 class="title-page">Datos de personas asociadas al estudiante</h2>

<h5>Estudiante:</h5>
<p>@foreach($students as $student)
  {{$student->nombres}} {{$student->apellidos}}
  @endforeach
</p>
<p>
  <a href="{{route('editarEstudiante', [$student->id] )}}" id="editar_estudiante" class="icon__editar">
        <i class="fa fa-pencil" title="Editar"></i>&nbsp;
</a>
</p>
<form method="post" action="{{route('actEstuAdmision')}}" autocomplete="off" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="estudiante" id="estudiante" class="form-control " value="{{$student->id}}" />
  <input type="hidden" name="ci" id="ci" class="form-control " value="{{$student->ci}}" />
</p>

<h5>Representante</h5>
<p>
@if($representantes->id!='')
<input type="hidden" name="id_representante" id="id_representante" class="form-control " value="{{$representantes->id}}" />
<input type="text" name="desRepresentante" id="desRepresentante" class="form-control " placeholder="No registrado"  value="{{$representantes->nombres}} {{$representantes->apellidos}}" />
<span>
<a class="icon__rep icon__ver">
  <i class="fa fa-eye"></i>&nbsp;
</a>
<a href="#" id="editar_representante" class="icon__editar">
  <i class="fa fa-pencil" title="Editar"></i>&nbsp;
</a>
</span>
@else
<input type="hidden" name="id_representante" id="id_representante" class="form-control " value="" />
<input type="text" name="desRepresentante" id="desRepresentante" class="form-control " placeholder="No registrado"  value="" />
@endif
<span><a href="#" id="crear_representante">
    <i class="fa fa-user-plus fa-lg"  title="Agregar Representante"></i>&nbsp;
    </a>
    <div id="countryList" style="display: none">
    </div>
    </span>
</p>
<div class="form-group">
<p>
<h5>Representante Financiero</h5>
<p>
  @if($clientes->id!='')
  <input type="hidden" name="id_financiero" id="id_financiero" class="financiero form-control "  value="{{$clientes->id}}" />
  <input type="text" name="desFinanciero" id="desFinanciero" class="financiero form-control "  value="{{$clientes->nombres}} {{$clientes->apellidos}}" />
  <span>
    <a class="icon__clie icon__ver">
      <i class="fa fa-eye"></i>&nbsp;
    </a>
    <a href="#" id="editar_cliente" class="icon__editar">
        <i class="fa fa-pencil" title="Editar"></i>&nbsp;
</a>
  </span>
  @else
   <input type="hidden" name="id_financiero" id="id_financiero" class="financiero form-control "  value="" />
  <input type="text" name="desFinanciero" id="desFinanciero" class="financiero form-control " placeholder="No registrado" value="" />
  <span>
    @endif
</span>
    <span>
    <a href="#" id="crear_cliente">
    <i class="fa fa-user-plus fa-lg"  title="Agregar Representante Financiero"></i>&nbsp;
    </a>
    <div id="listFinanciero" style="display: none">
    </div>
  </span>
</p>

<h5>Padre</h5>
<p>
  @forelse($padres as $padre)
  <input type="hidden" name="id_padre" id="id_padre" class="form-control " value="{{$padre->id}}" />
  <input type="text" name="desPadre" id="desPadre" class="form-control " value="{{$padre->nombres}} {{$padre->apellidos}}" />
    <a class="icon__padr icon__ver">
      <i class="fa fa-eye"></i>&nbsp;
    </a>
    <a href="#" id="editar_padre" class="icon__editar">
        <i class="fa fa-pencil" title="Editar"></i>&nbsp;
    </a>
  </span>
  @empty
  <input type="hidden" name="id_padre" id="id_padre" class="form-control " value="" />
  <input type="text" name="desPadre" id="desPadre" class="form-control " value=""  placeholder="No Registrado" />
  </span>
  @endforelse
  <a href="#" id="crear_padre">
    <i class="fa fa-user-plus  fa-lg" title="Agregar Padre"></i>&nbsp;
    </a>
  <div id="listPadre" style="display: none">
  </div>
  </p>
  <h5>Madre</h5>
  <p>
  @forelse($madres as $madre)
  <input type="hidden" name="id_madre" id="id_madre" class="form-control " value="{{$madre->id}}" />
  <input type="text" name="desMadre" id="desMadre" class="form-control " value="{{$madre->nombres}} {{$madre->apellidos}}" />
  <span>
    <a class="icon__madr icon__ver">
      <i class="fa fa-eye"></i>&nbsp;
    </a>
    <a href="#" id="editar_madre" class="icon__editar">
        <i class="fa fa-pencil" title="Editar"></i>&nbsp;
    </a>
  </span>
  </span>
  @empty
  <input type="hidden" name="id_madre" id="id_madre" class="form-control " value="" />
  <input type="text" name="desMadre" id="desMadre" class="form-control " value=""  placeholder="No Registrado" />
  </span>
  @endforelse
   <a href="#" id="crear_madre">
    <i class="fa fa-user-plus fa-lg" title="Agregar Madre"></i>&nbsp;
    </a>
   <div id="listMadre" style="display: none">
  </div>
  <button type="submit" class="btn btn-primary">Actualizar</button>
  <a class="btn btn-primary" href="#" id="Fin" onclick="finalizar();">Finalizar</i>&nbsp;
    </a>
  </form>
  <div class="modal fade" id="verModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  </div>
</div>
</div>
</div></div>
</div>
<script src="{{ secure_asset('js/theme-js.js') }}"></script>
<script type="text/javascript">
   function finalizar() {
  var r = confirm("Al finalizar no podrá actualizar nuevamente");
if (r == true) {
   var url = window.location.origin
    var estu = $('#estudiante').val()
     var url_completa = url+'/admisiones/finalizar/'+estu;
    $("#Fin").attr("href",url_completa);
}
}
  $(document).ready(function(){
    //funciones para agregar representantes//

     $('#crear_representante').click(function() {
    var url = window.location.origin
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/representante_crear/'+estu;
    $("#crear_representante").attr("href",url_completa);
    });
     $('#crear_cliente').click(function() {
    var url = window.location.origin
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/cliente_crear/'+estu;
    $("#crear_cliente").attr("href",url_completa);
    });
    //funciones para agregar padres//
    $('#crear_padre').click(function() {
      var url = window.location.origin
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/padre_crear/'+estu+'/P';
    $("#crear_padre").attr("href",url_completa);
    });
    $('#crear_madre').click(function() {
      var url = window.location.origin
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/padre_crear/'+estu+'/M';
    $("#crear_madre").attr("href",url_completa);
    });


    //funciones para modificar el enlace de editar padre//
  $('#editar_representante').click(function() {
    var url = window.location.origin
    var id_representante = $('#id_representante').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/representante/'+id_representante+'/'+estu;
    $("#editar_representante").attr("href",url_completa);
    });
  $('#editar_cliente').click(function() {
    var url = window.location.origin
    var id_financiero = $('#id_financiero').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/clientes/'+id_financiero+'/'+estu;
    $("#editar_cliente").attr("href",url_completa);
    });
  $('#editar_padre').click(function() {
    var url = window.location.origin
    var id_padre = $('#id_padre').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/padres/'+id_padre+'/'+estu+'/P';
    $("#editar_padre").attr("href",url_completa);
    });
  $('#editar_madre').click(function() {
    var url = window.location.origin
    var id_madre = $('#id_madre').val()
    var estu = $('#estudiante').val()
    var url_completa = url+'/admisiones/padres/'+id_madre+'/'+estu+'/M';
    $("#editar_madre").attr("href",url_completa);
    });
  //final de funciones para modificar el enlace de editar representantes//
  //inicio de funciones para mostrar el modal de editar representantes//
    $('.icon__rep').click(function() {
    var url = window.location.origin
    var id_representante = $('#id_representante').val()
    var estu = $('#estudiante').val()
    $.ajax({
      type: "GET",
    url: url+'/admisiones/modal-representante/?q='+id_representante+'&estu='+estu,
      success: function (response) {
        $('#verModal').html(response)
        $('#verModal').modal('show')
      }, error: function() {
        console.log('Sucedio error al traer la información ')
      }
    });
    });
    });
  $('.icon__clie').click(function() {
    var url = window.location.origin
    var id_financiero = $('#id_financiero').val()
     var estu = $('#estudiante').val()
    $.ajax({
      type: "GET",
      url: url+'/admisiones/modal-cliente/?q='+id_financiero+'&estu='+estu,
      success: function (response) {
        $('#verModal').html(response)
        $('#verModal').modal('show')
      }, error: function() {
        console.log('Sucedio error al traer la información ')
      }
    });
  });
  $('.icon__padr').click(function() {
    var url = window.location.origin
    var id_padre = $('#id_padre').val()
    var estu = $('#estudiante').val()
    $.ajax({
      type: "GET",
       url: url+'/admisiones/modal-padres/?q='+id_padre+'&estu='+estu+'&paren=P',
      success: function (response) {
        $('#verModal').html(response)
        $('#verModal').modal('show')
      }, error: function() {
        console.log('Sucedio error al traer la información ')
      }
    });
  });
  $('.icon__madr').click(function() {
    var url = window.location.origin
    var id_madre = $('#id_madre').val()
    var estu = $('#estudiante').val()
    $.ajax({
      type: "GET",
      url: url+'/admisiones/modal-padres/?q='+id_madre+'&estu='+estu+'&paren=M',
      success: function (response) {
        $('#verModal').html(response)
        $('#verModal').modal('show')
      }, error: function() {
        console.log('Sucedio error al traer la información ')
      }
    });
  })
 $('#desRepresentante').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#countryList').show();


                    $('#countryList').html(data);
          }
         });
        }
        $(document).on('click','.repre', function(){
        $('#id_representante').val($(this).attr('id'));
        $('#desRepresentante').val($(this).text());
        $('#countryList').hide();
   });
    });
 $('#desFinanciero').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompleteFinanciero.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listFinanciero').show();


                    $('#listFinanciero').html(data);
          }
         });
        }
        $(document).on('click', '.finan', function(){
        $('#id_financiero').val($(this).attr('id'));
        $('#desFinanciero').val($(this).text());
        $('#listFinanciero').hide();
   });
    });
 $('#desPadre').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompletePadre.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listPadre').show();


                    $('#listPadre').html(data);
          }
         });
        }
        $(document).on('click', '.padre', function(){
        $('#id_padre').val($(this).attr('id'));
        $('#desPadre').val($(this).text());
        $('#listPadre').hide();
   });
    });
 $('#desMadre').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompleteMadre.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listMadre').show();


                    $('#listMadre').html(data);
          }
         });
        }
        $(document).on('click', '.madre', function(){
        $('#id_madre').val($(this).attr('id'));
        $('#desMadre').val($(this).text());
        $('#listMadre').hide();
    });
    });
</script>

