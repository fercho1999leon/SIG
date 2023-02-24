{!! Form::open(array('route' => 'editReportesMinisterialesInstitucion')) !!}
    <h3>
        <p class="mt-1 mb-1">PRIMER RESPONSABLE 
            <span class="title-school"> Rector/a</span>
        </p>
    </h3>
    <div class="grid-form">
        <p class="grid-form-p">Nombre </p>
        {{ Form::text('representante1',$data->representante1,['class'=>'form-control', 'placeholder'=>'Nombres y Apellidos','id'=>'nombreRep1Inst'])}}
        
        <p class="grid-form-p">Cargo </p>
        {{ Form::text('cargo1',$data->cargo1,['class'=>'form-control', 'placeholder'=>'Cargo','id'=>'cargo1Inst'])}}    
    </div>

    <h3>
        <p class="mt-1 mb-1">SEGUNDO RESPONSABLE
            <span class="title-school"> Secretaría General</span>
        </p>
    </h3>
    <div class="grid-form">
        <p class="grid-form-p">Nombre </p>
        {{ Form::text('representante2',$data->representante2,['class'=>'form-control', 'placeholder'=>'Nombres y Apellidos','id'=>'nombreRep2Inst'])}}
        
        <p class="grid-form-p">Cargo </p>
        {{ Form::text('cargo2',$data->cargo2,['class'=>'form-control', 'placeholder'=>'Cargo','id'=>'cargo2Inst'])}}
    </div>

    <h3>
        <p class="mt-1 mb-1">TERCER RESPONSABLE
            <span class="title-school"> </span>
        </p>
    </h3>
    <div class="grid-form">
        <p class="grid-form-p">Nombre </p>
        {{ Form::text('representante3',$data->representante3,['class'=>'form-control', 'placeholder'=>'Nombres y Apellidos','id'=>'nombreRep3Inst'])}}
        
        <p class="grid-form-p">Cargo </p>
        {{ Form::text('cargo3',$data->cargo3,['class'=>'form-control', 'placeholder'=>'Cargo','id'=>'cargo3Inst'])}}
    </div>

    <h3>
        <p class="mt-1 mb-1">CUARTO RESPONSABLE
            <span class="title-school"> </span>
        </p>
    </h3>
    <div class="grid-form">
        <p class="grid-form-p">Nombre </p>
        {{ Form::text('representante4',$data->representante4,['class'=>'form-control', 'placeholder'=>'Nombres y Apellidos','id'=>'nombreRep4Inst'])}}
        
        <p class="grid-form-p">Cargo </p>
        {{ Form::text('cargo4',$data->cargo4,['class'=>'form-control', 'placeholder'=>'Cargo','id'=>'cargo4Inst'])}}
    </div>

    <h3>
        <p class="mt-1 mb-1">QUINTO RESPONSABLE </p>
    </h3>
    <div class="grid-form">
        <p class="grid-form-p">Nombre </p>
        {{ Form::text('representante5',$data->representante5,['class'=>'form-control', 'placeholder'=>'Nombres y Apellidos','id'=>'nombreRep5Inst'])}}
        <p class="grid-form-p">Cargo </p>
        {{ Form::text('cargo5',$data->cargo5,['class'=>'form-control', 'placeholder'=>'Cargo','id'=>'cargo5Inst'])}}
	</div>
	
	<h3>
		<p class="mt-1 mb-1">Certificado de Promoción
		</p>
	</h3>
	<div class="grid-form">
		<p class="grid-form-p">Fecha:</p>
		<input type="text" name="fechaCertificadoPromocion" class="form-control" placeholder="Fecha de promoción" value="{{$data->fechaCertificadoPromocion}}">
	</div>

    <div class="text-left mt-1">
        <input type="submit" value="Guardar" class="btn btn-success">
    </div>
{!! Form::close() !!}
