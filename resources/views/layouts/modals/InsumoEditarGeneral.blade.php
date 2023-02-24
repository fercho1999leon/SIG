@php
  use App\General;
@endphp
<form  method="" id="formEditGeneral">
  {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
    <div class="matricula__matriculacion__input">
          <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" class="form-control" id="nombre" name="nombre">
            <label for="nombre">Porcentaje: </label>
            <input type="number" class="form-control" id="porcentaje" name="porcentaje" step="1" min="0" max="100" placeholder="porcentaje">
          </div>
          <input type="text"  id="nombre" name="nombre" value="{{$insumo->nombre}}">
          <select id="seccion" name="seccion">
            {{--<option value="todos"{{$insumo->seccion =='todos' ? 'Selected': ''}}>Aplica Para Todos</option>
            <option value="EI" {{$insumo->seccion =='EI' ? 'Selected': ''}}>{{General::getSeccion('EI')}}</option>
            <option value="EGB"{{$insumo->seccion =='EGB' ? 'Selected': ''}}>{{General::getSeccion('EGB')}}</option>
            <option value="BGU"{{$insumo->seccion =='BGU' ? 'Selected': ''}}>{{General::getSeccion('BGU')}}</option>--}}
            @foreach($careers as $career)
              <option value="{{ $career ['id'] }}">{{ $career ['nombre'] }}</option>
            @endforeach
          </select>
            <button  type="submit" class="btn btn-primary">Actualizar</button>
            </div>
  </form>
  <script type="text/javascript">
    $('#formEditGeneral').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('insumos.update',['insumo'  =>  $insumo->id])}}",
            type: "POST",
            data : $( this ).serialize()  ,
            success: function (result, status, xhr) {
                $('#respuesta').html(result)
                reloadInsumosGenerales();
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
  });
</script>
  </script>