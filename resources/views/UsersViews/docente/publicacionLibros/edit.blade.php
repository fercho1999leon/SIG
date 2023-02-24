@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.publicacionLibro.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("publicacion-libros.update", [$publicacionLibro->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('titulo') ? 'has-error' : '' }}">
                            <label for="titulo">{{ trans('cruds.publicacionLibro.fields.titulo') }}</label>
                            <input class="form-control" type="text" name="titulo" id="titulo" value="{{ old('titulo', $publicacionLibro->titulo) }}">
                            @if($errors->has('titulo'))
                                <span class="help-block" role="alert">{{ $errors->first('titulo') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.publicacionLibro.fields.titulo_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('filiacion') ? 'has-error' : '' }}">
                            <label for="filiacion">{{ trans('cruds.publicacionLibro.fields.filiacion') }}</label>
                            <input class="form-control" type="text" name="filiacion" id="filiacion" value="{{ old('filiacion', $publicacionLibro->filiacion) }}">
                            @if($errors->has('filiacion'))
                                <span class="help-block" role="alert">{{ $errors->first('filiacion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.publicacionLibro.fields.filiacion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('codigo_issn') ? 'has-error' : '' }}">
                            <label for="codigo_issn">{{ trans('cruds.publicacionLibro.fields.codigo_issn') }}</label>
                            <input class="form-control" type="text" name="codigo_issn" id="codigo_issn" value="{{ old('codigo_issn', $publicacionLibro->codigo_issn) }}">
                            @if($errors->has('codigo_issn'))
                                <span class="help-block" role="alert">{{ $errors->first('codigo_issn') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.publicacionLibro.fields.codigo_issn_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('volumen') ? 'has-error' : '' }}">
                            <label for="volumen">{{ trans('cruds.publicacionLibro.fields.volumen') }}</label>
                            <input class="form-control" type="text" name="volumen" id="volumen" value="{{ old('volumen', $publicacionLibro->volumen) }}">
                            @if($errors->has('volumen'))
                                <span class="help-block" role="alert">{{ $errors->first('volumen') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.publicacionLibro.fields.volumen_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_publicacion') ? 'has-error' : '' }}">
                            <label for="fecha_publicacion">{{ trans('cruds.publicacionLibro.fields.fecha_publicacion') }}</label>
                            <input class="form-control" type="text" name="fecha_publicacion" id="fecha_publicacion" value="{{ old('fecha_publicacion', $publicacionLibro->fecha_publicacion) }}">
                            @if($errors->has('fecha_publicacion'))
                                <span class="help-block" role="alert">{{ $errors->first('fecha_publicacion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.publicacionLibro.fields.fecha_publicacion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.publicacionLibro.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $publicacionLibro->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.publicacionLibro.fields.usuario_helper') }}</span>
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