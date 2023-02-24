@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.certificacione.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("certificaciones.update", [$certificacione->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre">{{ trans('cruds.certificacione.fields.nombre') }}</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ old('nombre', $certificacione->nombre) }}">
                            @if($errors->has('nombre'))
                                <span class="help-block" role="alert">{{ $errors->first('nombre') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.certificacione.fields.nombre_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('registro_setec') ? 'has-error' : '' }}">
                            <label for="registro_setec">{{ trans('cruds.certificacione.fields.registro_setec') }}</label>
                            <input class="form-control" type="text" name="registro_setec" id="registro_setec" value="{{ old('registro_setec', $certificacione->registro_setec) }}">
                            @if($errors->has('registro_setec'))
                                <span class="help-block" role="alert">{{ $errors->first('registro_setec') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.certificacione.fields.registro_setec_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('institucion_certificadora') ? 'has-error' : '' }}">
                            <label for="institucion_certificadora">{{ trans('cruds.certificacione.fields.institucion_certificadora') }}</label>
                            <input class="form-control" type="text" name="institucion_certificadora" id="institucion_certificadora" value="{{ old('institucion_certificadora', $certificacione->institucion_certificadora) }}">
                            @if($errors->has('institucion_certificadora'))
                                <span class="help-block" role="alert">{{ $errors->first('institucion_certificadora') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.certificacione.fields.institucion_certificadora_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pais') ? 'has-error' : '' }}">
                            <label for="pais">{{ trans('cruds.certificacione.fields.pais') }}</label>
                            <input class="form-control" type="text" name="pais" id="pais" value="{{ old('pais', $certificacione->pais) }}">
                            @if($errors->has('pais'))
                                <span class="help-block" role="alert">{{ $errors->first('pais') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.certificacione.fields.pais_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ano') ? 'has-error' : '' }}">
                            <label for="ano">{{ trans('cruds.certificacione.fields.ano') }}</label>
                            <input class="form-control" type="text" name="ano" id="ano" value="{{ old('ano', $certificacione->ano) }}">
                            @if($errors->has('ano'))
                                <span class="help-block" role="alert">{{ $errors->first('ano') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.certificacione.fields.ano_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.certificacione.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $certificacione->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.certificacione.fields.usuario_helper') }}</span>
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