<!-- formularioWebOficial -->
{!! Form::open(array('route' => 'editWebOficialInstitucion')) !!}
<div class="grid-form">
    <p class="grid-form-p no-margin">Sitio web</p>
    {{ Form::text('sitioWeb',$data->sitioWeb,['class'=>'form-control','id'=>'webInst','placeholder'=>'Ej: www.misitioweb.com'])}}
    <!-- <input class="form-control" id="sitio" placeholder="Sitio web institucional" name="nombreinstitucion" value="www.sitio-web.com" type="text"> -->
</div>
<div class="text-left mt-1">
    <input type="submit" value="Guardar" class="btn btn-success">
</div>
{!! Form::close() !!}
