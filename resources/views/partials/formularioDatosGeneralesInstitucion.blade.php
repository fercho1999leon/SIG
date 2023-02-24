
    {!! Form::open(array('route' => 'editDatosGeneralesInstitution', 'files' => true)) !!}
    <div class="grid-form">
		<p class="grid-form-p no-margin">Logotipo</p>
		<div class="flex align-items-center">
			<input type="file" name="logo">
			@if ($data->logo != null)
				<img src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" width="50" alt="">
			@endif
		</div>
		<p class="grid-form-p no-margin">Nombre Institución</p>
		{{ Form::text('nombre',$data->nombre,['class'=>'form-control', 'placeholder'=>'Nombre de la institución','required' => 'required','id'=>'nombreInst'])}}
		<p class="grid-form-p no-margin">Ciudad</p>
        {{ Form::text('ciudad',$data->ciudad,['class'=>'form-control', 'placeholder'=>'Ciudad de la institución','required' => 'required','id'=>'ciudadInst'])}}
        <p class="grid-form-p no-margin">Dirección</p>
        {{ Form::text('direccion',$data->direccion,['class'=>'form-control', 'placeholder'=>'Direccion de la institución','required' => 'required','id'=>'dirInst'])}}

        @if($data->correo!=null)
        <p class="grid-form-p no-margin">Correo</p>
        {{ Form::text('correo',$data->correo,['class'=>'form-control', 'placeholder'=>'Correo de la institución','id'=>'correoInst'])}}
        @endif

        @if($data->telefonos!=null)
        <p class="grid-form-p no-margin">Teléfonos</p>
        {{ Form::text('telefonos',$data->telefonos,['class'=>'form-control', 'placeholder'=>'Telefonos de la institución','required' => 'required','id'=>'telfInst'])}}
        @endif

        @if($data->jornada!=null)
        <p class="grid-form-p no-margin">Jornada</p>
        {{ Form::text('jornada',$data->jornada,['class'=>'form-control', 'placeholder'=>'Jornada de la institución','required' => 'required','id'=>'jornadaInst'])}}
		@endif

        <p class="grid-form-p no-margin">Coordinación Zonal <br><small class="red">(Numero de coordinación zonal)</small></p>
		{{ Form::number('coordinacionZonal',$data->coordinacionZonal,['class'=>'form-control', 'placeholder'=>'Número de la coordinación Zonal','required' => 'required','id'=>'coordinacionZonalInst'])}}

        <p class="grid-form-p no-margin">Distrito </p>
		{{ Form::text('distrito',$data->distrito,['class'=>'form-control', 'placeholder'=>'Número de la coordinación Zonal','required' => 'required','id'=>'distritoInst'])}}

        <p class="grid-form-p no-margin">Codigo Amie</p>
		{{ Form::text('codigoAmie',$data->codigoAmie,['class'=>'form-control', 'placeholder'=>'Número de la coordinación Zonal','required' => 'required','id'=>'codigoAmieInst'])}}

		<p class="grid-form-p no-margin">Parroquia</p>
		<input type="text" name="parroquia" class="form-control" placeholder="Parroquia" value="{{$data->parroquia}}">

		<p class="grid-form-p no-margin">Periodo Lectivo</p>
		<select name="periodoLectivo" class="form-control">
			@foreach ($periodos as $periodo)
				<option value="{{$periodo->id}}" {{$data->periodoLectivo == $periodo->id ? 'selected' : ''}} > {{$periodo->nombre}} </option>
			@endforeach
		</select>
        <p class="grid-form-p no-margin">Horario Atención</p>
        {{ Form::text('horariosDeAtencion',$data->horariosDeAtencion,['class'=>'form-control', 'placeholder'=>'Horario de atención','id'=>'horarioInst'])}}
        
        <p class="grid-form-p no-margin">Correo para Admisiones</p>
		{{ Form::email('correoAdmisiones',$data->correoAdmisiones,['class'=>'form-control', 'placeholder'=>'Email al que llegaran correo de admisiones','id'=>'correoAdmisiones'])}}
    
    </div>
    <div class="text-left mt-1">
        <input type="submit" value="Guardar" class="btn btn-success">
    </div>
{!! Form::close() !!}
