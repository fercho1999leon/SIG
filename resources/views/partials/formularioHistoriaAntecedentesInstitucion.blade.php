{!! Form::open(array('route' => 'editMisionHistoriaAntecedentesInstitucion')) !!}
<div class="grid-form">
    <p class="grid-form-p no-margin">Historia</p>
    {{ Form::textarea('historia',$data->historia,['class'=>'form-control','id'=>'historiaInst','rows'=>'7'])}}
    <!-- <textarea class="form-control" rows="7" id="historia"></textarea> -->
    <p class="grid-form-p no-margin">Antecedentes</p>
    {{ Form::textarea('antecedentes',$data->antecedentes,['class'=>'form-control','id'=>'historiaInst','rows'=>'7'])}}
    <!-- <textarea class="form-control" rows="7" id="antecedentes"></textarea> -->
</div>
<div class="text-left mt-1">
    <input type="submit" value="Guardar" class="btn btn-success">
</div>
{!! Form::close() !!}
