@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.experienciaCapacitador.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("experiencia-capacitadors.update", [$experienciaCapacitador->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('curso_seminario') ? 'has-error' : '' }}">
                            <label for="curso_seminario">{{ trans('cruds.experienciaCapacitador.fields.curso_seminario') }}</label>
                            <input class="form-control" type="text" name="curso_seminario" id="curso_seminario" value="{{ old('curso_seminario', $experienciaCapacitador->curso_seminario) }}">
                            @if($errors->has('curso_seminario'))
                                <span class="help-block" role="alert">{{ $errors->first('curso_seminario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaCapacitador.fields.curso_seminario_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('entidades') ? 'has-error' : '' }}">
                            <label for="entidades">{{ trans('cruds.experienciaCapacitador.fields.entidades') }}</label>
                            <input class="form-control" type="text" name="entidades" id="entidades" value="{{ old('entidades', $experienciaCapacitador->entidades) }}">
                            @if($errors->has('entidades'))
                                <span class="help-block" role="alert">{{ $errors->first('entidades') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaCapacitador.fields.entidades_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('desde') ? 'has-error' : '' }}">
                            <label for="desde">{{ trans('cruds.experienciaCapacitador.fields.desde') }}</label>
                            <input class="form-control date" type="text" name="desde" id="desde" value="{{ old('desde', $experienciaCapacitador->desde) }}">
                            @if($errors->has('desde'))
                                <span class="help-block" role="alert">{{ $errors->first('desde') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaCapacitador.fields.desde_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('hasta') ? 'has-error' : '' }}">
                            <label for="hasta">{{ trans('cruds.experienciaCapacitador.fields.hasta') }}</label>
                            <input class="form-control date" type="text" name="hasta" id="hasta" value="{{ old('hasta', $experienciaCapacitador->hasta) }}">
                            @if($errors->has('hasta'))
                                <span class="help-block" role="alert">{{ $errors->first('hasta') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaCapacitador.fields.hasta_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.experienciaCapacitador.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $experienciaCapacitador->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaCapacitador.fields.usuario_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection