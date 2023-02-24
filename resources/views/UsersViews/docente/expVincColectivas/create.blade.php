@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.expVincColectiva.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("exp-vinc-colectivas.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('tipo_experiencia') ? 'has-error' : '' }}">
                            <label for="tipo_experiencia">{{ trans('cruds.expVincColectiva.fields.tipo_experiencia') }}</label>
                            <input class="form-control" type="text" name="tipo_experiencia" id="tipo_experiencia" value="{{ old('tipo_experiencia', '') }}">
                            @if($errors->has('tipo_experiencia'))
                                <span class="help-block" role="alert">{{ $errors->first('tipo_experiencia') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.expVincColectiva.fields.tipo_experiencia_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('programa_proyecto') ? 'has-error' : '' }}">
                            <label for="programa_proyecto">{{ trans('cruds.expVincColectiva.fields.programa_proyecto') }}</label>
                            <input class="form-control" type="text" name="programa_proyecto" id="programa_proyecto" value="{{ old('programa_proyecto', '') }}">
                            @if($errors->has('programa_proyecto'))
                                <span class="help-block" role="alert">{{ $errors->first('programa_proyecto') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.expVincColectiva.fields.programa_proyecto_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('duracion') ? 'has-error' : '' }}">
                            <label for="duracion">{{ trans('cruds.expVincColectiva.fields.duracion') }}</label>
                            <input class="form-control" type="text" name="duracion" id="duracion" value="{{ old('duracion', '') }}">
                            @if($errors->has('duracion'))
                                <span class="help-block" role="alert">{{ $errors->first('duracion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.expVincColectiva.fields.duracion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.expVincColectiva.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', '') }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.expVincColectiva.fields.usuario_helper') }}</span>
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