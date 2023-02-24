@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<a class="button-br" href=" {{route('representantePagosPendientes', [$student->id]) }} ">
  <button>
    <img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
  </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    
  <div class="card">
    <div class="row wrapper white-bg mb-1">
  <div class="card-header">
    <h2 class="no-margins">
    Anular Transacción
  </h2>
</div>
</div>
  <div class="row mt-1">
    <div class="col-lg-6">
  <div class="card-body">
    <h5 class="card-title">Complete los siguientes datos</h5>
    <div class="modal-body">
      <form action="{{route('EliminarTransaccion')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id_pago_factura" value="{{$id_factura}}">
        <input type="hidden" name="id_estudiante" value="{{$student->id}}"> 
        <input type="hidden" name="id_historico" value="{{$historico->id}}">       
   <div class="row">
    <div class="col">
      <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" placeholder="Número de Tarjeta" name="nTarjeta" id="nTarjeta" maxlength="19" value="{{old('nTarjeta')}}" required>
    </div>
  </div>
    <div class="row">
    <div class="col">
        <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="MM/AA" name="expiry" id="expiry" maxlength="5" value="{{old('expiry')}}" required>
    </div>
  </div>
  <div class="modal-footer">    
  <button type="submit"  class="btn btn-primary">Anular ${{$historico->total}}</button> 
  </div>
</div>
</form>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">  
  $(document).ready(function(){
var characterCount
$('#expiry').on('input',function(e){
    if($(this).val().length == 2 && characterCount < $(this).val().length) {
        $(this).val($(this).val()+'/');
    }
    characterCount = $(this).val().length
});
$('#nTarjeta').on('input',function(e){
    if(($(this).val().length == 4 || $(this).val().length == 9 || $(this).val().length == 14)){
      $(this).val($(this).val()+' ');
    }
});
$('#nTarjeta').on("cut copy paste",function(e) {
      e.preventDefault();
   });
$('#expiry').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});
$(function(){

  $('.validanumericos').keypress(function(e) {
  if(isNaN(this.value + String.fromCharCode(e.charCode))) 
     return false;
  })
  .on("cut copy paste",function(e){
  e.preventDefault();
  });

});

</script>
