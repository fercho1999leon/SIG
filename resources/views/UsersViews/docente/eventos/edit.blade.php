@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.evento.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("eventos.update", [$evento->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre">{{ trans('cruds.evento.fields.nombre') }}</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ old('nombre', $evento->nombre) }}">
                            @if($errors->has('nombre'))
                                <span class="help-block" role="alert">{{ $errors->first('nombre') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.evento.fields.nombre_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lugar') ? 'has-error' : '' }}">
                            <label for="lugar">{{ trans('cruds.evento.fields.lugar') }}</label>
                            <input class="form-control" type="text" name="lugar" id="lugar" value="{{ old('lugar', $evento->lugar) }}">
                            @if($errors->has('lugar'))
                                <span class="help-block" role="alert">{{ $errors->first('lugar') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.evento.fields.lugar_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_publicacion') ? 'has-error' : '' }}">
                            <label for="fecha_publicacion">{{ trans('cruds.evento.fields.fecha_publicacion') }}</label>
                            <input class="form-control" type="text" name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fecha_publicacion', $evento->fecha_publicacion) }}">
                            @if($errors->has('fecha_publicacion'))
                                <span class="help-block" role="alert">{{ $errors->first('fecha_publicacion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.evento.fields.fecha_publicacion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                            <label for="url">{{ trans('cruds.evento.fields.url') }}</label>
                            <input class="form-control" type="text" name="url" id="url" value="{{ old('url', $evento->url) }}">
                            @if($errors->has('url'))
                                <span class="help-block" role="alert">{{ $errors->first('url') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.evento.fields.url_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.evento.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $evento->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.evento.fields.usuario_helper') }}</span>
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