@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.experienciaVinculacion.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("experiencia-vinculacions.update", [$experienciaVinculacion->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('tipo_experiencia') ? 'has-error' : '' }}">
                            <label for="tipo_experiencia">{{ trans('cruds.experienciaVinculacion.fields.tipo_experiencia') }}</label>
                            <input class="form-control" type="text" name="tipo_experiencia" id="tipo_experiencia" value="{{ old('tipo_experiencia', $experienciaVinculacion->tipo_experiencia) }}">
                            @if($errors->has('tipo_experiencia'))
                                <span class="help-block" role="alert">{{ $errors->first('tipo_experiencia') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaVinculacion.fields.tipo_experiencia_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('programa') ? 'has-error' : '' }}">
                            <label for="programa">{{ trans('cruds.experienciaVinculacion.fields.programa') }}</label>
                            <input class="form-control" type="text" name="programa" id="programa" value="{{ old('programa', $experienciaVinculacion->programa) }}">
                            @if($errors->has('programa'))
                                <span class="help-block" role="alert">{{ $errors->first('programa') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaVinculacion.fields.programa_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('duracion') ? 'has-error' : '' }}">
                            <label for="duracion">{{ trans('cruds.experienciaVinculacion.fields.duracion') }}</label>
                            <input class="form-control" type="text" name="duracion" id="duracion" value="{{ old('duracion', $experienciaVinculacion->duracion) }}">
                            @if($errors->has('duracion'))
                                <span class="help-block" role="alert">{{ $errors->first('duracion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaVinculacion.fields.duracion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.experienciaVinculacion.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $experienciaVinculacion->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaVinculacion.fields.usuario_helper') }}</span>
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