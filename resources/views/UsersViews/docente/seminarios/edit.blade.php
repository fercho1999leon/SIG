@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.seminario.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("seminarios.update", [$seminario->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre">{{ trans('cruds.seminario.fields.nombre') }}</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ old('nombre', $seminario->nombre) }}">
                            @if($errors->has('nombre'))
                                <span class="help-block" role="alert">{{ $errors->first('nombre') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminario.fields.nombre_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('institucion') ? 'has-error' : '' }}">
                            <label for="institucion">{{ trans('cruds.seminario.fields.institucion') }}</label>
                            <input class="form-control" type="text" name="institucion" id="institucion" value="{{ old('institucion', $seminario->institucion) }}">
                            @if($errors->has('institucion'))
                                <span class="help-block" role="alert">{{ $errors->first('institucion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminario.fields.institucion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pais') ? 'has-error' : '' }}">
                            <label for="pais">{{ trans('cruds.seminario.fields.pais') }}</label>
                            <input class="form-control" type="text" name="pais" id="pais" value="{{ old('pais', $seminario->pais) }}">
                            @if($errors->has('pais'))
                                <span class="help-block" role="alert">{{ $errors->first('pais') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminario.fields.pais_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ano') ? 'has-error' : '' }}">
                            <label for="ano">{{ trans('cruds.seminario.fields.ano') }}</label>
                            <input class="form-control" type="text" name="ano" id="ano" value="{{ old('ano', $seminario->ano) }}">
                            @if($errors->has('ano'))
                                <span class="help-block" role="alert">{{ $errors->first('ano') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminario.fields.ano_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('numero_horas') ? 'has-error' : '' }}">
                            <label for="numero_horas">{{ trans('cruds.seminario.fields.numero_horas') }}</label>
                            <input class="form-control" type="text" name="numero_horas" id="numero_horas" value="{{ old('numero_horas', $seminario->numero_horas) }}">
                            @if($errors->has('numero_horas'))
                                <span class="help-block" role="alert">{{ $errors->first('numero_horas') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminario.fields.numero_horas_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.seminario.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $seminario->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.seminario.fields.usuario_helper') }}</span>
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