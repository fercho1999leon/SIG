{!! Form::open(array('route' => 'editMisionVisionInstitution')) !!}
<div class="grid-form">
    <p class="grid-form-p no-margin">Misión</p>
    {{ Form::textarea('mision',$data->mision,['class'=>'form-control','id'=>'misionInst','rows'=>'7'])}}
    <!-- <textarea class="form-control" rows="7" id="mision"></textarea> -->
    <p class="grid-form-p no-margin">Vision</p>
    {{ Form::textarea('vision',$data->vision,['class'=>'form-control','id'=>'visionInst','rows'=>'7'])}}
        <!-- <textarea class="form-control" rows="7" id="vision"></textarea> -->
</div>
<div class="text-left mt-1">
    <input type="submit" value="Guardar" class="btn btn-success">
</div>
{!! Form::close() !!}
