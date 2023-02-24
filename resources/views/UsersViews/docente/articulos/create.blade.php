@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.articulo.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("articulos.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('titulo') ? 'has-error' : '' }}">
                            <label for="titulo">{{ trans('cruds.articulo.fields.titulo') }}</label>
                            <input class="form-control" type="text" name="titulo" id="titulo" value="{{ old('titulo', '') }}">
                            @if($errors->has('titulo'))
                                <span class="help-block" role="alert">{{ $errors->first('titulo') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.articulo.fields.titulo_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('nombre_revista') ? 'has-error' : '' }}">
                            <label for="nombre_revista">{{ trans('cruds.articulo.fields.nombre_revista') }}</label>
                            <input class="form-control" type="text" name="nombre_revista" id="nombre_revista" value="{{ old('nombre_revista', '') }}">
                            @if($errors->has('nombre_revista'))
                                <span class="help-block" role="alert">{{ $errors->first('nombre_revista') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.articulo.fields.nombre_revista_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('codigo_issn') ? 'has-error' : '' }}">
                            <label for="codigo_issn">{{ trans('cruds.articulo.fields.codigo_issn') }}</label>
                            <input class="form-control" type="text" name="codigo_issn" id="codigo_issn" value="{{ old('codigo_issn', '') }}">
                            @if($errors->has('codigo_issn'))
                                <span class="help-block" role="alert">{{ $errors->first('codigo_issn') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.articulo.fields.codigo_issn_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('volumen') ? 'has-error' : '' }}">
                            <label for="volumen">{{ trans('cruds.articulo.fields.volumen') }}</label>
                            <input class="form-control" type="text" name="volumen" id="volumen" value="{{ old('volumen', '') }}">
                            @if($errors->has('volumen'))
                                <span class="help-block" role="alert">{{ $errors->first('volumen') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.articulo.fields.volumen_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_publicacion') ? 'has-error' : '' }}">
                            <label for="fecha_publicacion">{{ trans('cruds.articulo.fields.fecha_publicacion') }}</label>
                            <input class="form-control date" type="text" name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fecha_publicacion') }}">
                            @if($errors->has('fecha_publicacion'))
                                <span class="help-block" role="alert">{{ $errors->first('fecha_publicacion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.articulo.fields.fecha_publicacion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.articulo.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', '') }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.articulo.fields.usuario_helper') }}</span>
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