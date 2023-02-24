@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.tituloPosgrado.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("titulo-posgrados.update", [$tituloPosgrado->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre">{{ trans('cruds.tituloPosgrado.fields.nombre') }}</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ old('nombre', $tituloPosgrado->nombre) }}">
                            @if($errors->has('nombre'))
                                <span class="help-block" role="alert">{{ $errors->first('nombre') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tituloPosgrado.fields.nombre_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('codigo_senescyt') ? 'has-error' : '' }}">
                            <label for="codigo_senescyt">{{ trans('cruds.tituloPosgrado.fields.codigo_senescyt') }}</label>
                            <input class="form-control" type="text" name="codigo_senescyt" id="codigo_senescyt" value="{{ old('codigo_senescyt', $tituloPosgrado->codigo_senescyt) }}">
                            @if($errors->has('codigo_senescyt'))
                                <span class="help-block" role="alert">{{ $errors->first('codigo_senescyt') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tituloPosgrado.fields.codigo_senescyt_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('universidad') ? 'has-error' : '' }}">
                            <label for="universidad">{{ trans('cruds.tituloPosgrado.fields.universidad') }}</label>
                            <input class="form-control" type="text" name="universidad" id="universidad" value="{{ old('universidad', $tituloPosgrado->universidad) }}">
                            @if($errors->has('universidad'))
                                <span class="help-block" role="alert">{{ $errors->first('universidad') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tituloPosgrado.fields.universidad_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pais') ? 'has-error' : '' }}">
                            <label for="pais">{{ trans('cruds.tituloPosgrado.fields.pais') }}</label>
                            <input class="form-control" type="text" name="pais" id="pais" value="{{ old('pais', $tituloPosgrado->pais) }}">
                            @if($errors->has('pais'))
                                <span class="help-block" role="alert">{{ $errors->first('pais') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tituloPosgrado.fields.pais_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ano') ? 'has-error' : '' }}">
                            <label for="ano">{{ trans('cruds.tituloPosgrado.fields.ano') }}</label>
                            <input class="form-control" type="text" name="ano" id="ano" value="{{ old('ano', $tituloPosgrado->ano) }}">
                            @if($errors->has('ano'))
                                <span class="help-block" role="alert">{{ $errors->first('ano') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tituloPosgrado.fields.ano_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.tituloPosgrado.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $tituloPosgrado->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.tituloPosgrado.fields.usuario_helper') }}</span>
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