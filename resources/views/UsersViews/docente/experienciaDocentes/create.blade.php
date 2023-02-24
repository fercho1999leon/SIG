@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.experienciaDocente.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("experiencia-docentes.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('curso_materia_modulo') ? 'has-error' : '' }}">
                            <label for="curso_materia_modulo">{{ trans('cruds.experienciaDocente.fields.curso_materia_modulo') }}</label>
                            <input class="form-control" type="text" name="curso_materia_modulo" id="curso_materia_modulo" value="{{ old('curso_materia_modulo', '') }}">
                            @if($errors->has('curso_materia_modulo'))
                                <span class="help-block" role="alert">{{ $errors->first('curso_materia_modulo') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaDocente.fields.curso_materia_modulo_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('institucion') ? 'has-error' : '' }}">
                            <label for="institucion">{{ trans('cruds.experienciaDocente.fields.institucion') }}</label>
                            <input class="form-control" type="text" name="institucion" id="institucion" value="{{ old('institucion', '') }}">
                            @if($errors->has('institucion'))
                                <span class="help-block" role="alert">{{ $errors->first('institucion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaDocente.fields.institucion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('desde') ? 'has-error' : '' }}">
                            <label for="desde">{{ trans('cruds.experienciaDocente.fields.desde') }}</label>
                            <input class="form-control date" type="text" name="desde" id="desde" value="{{ old('desde') }}">
                            @if($errors->has('desde'))
                                <span class="help-block" role="alert">{{ $errors->first('desde') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaDocente.fields.desde_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('hasta') ? 'has-error' : '' }}">
                            <label for="hasta">{{ trans('cruds.experienciaDocente.fields.hasta') }}</label>
                            <input class="form-control date" type="text" name="hasta" id="hasta" value="{{ old('hasta') }}">
                            @if($errors->has('hasta'))
                                <span class="help-block" role="alert">{{ $errors->first('hasta') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaDocente.fields.hasta_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.experienciaDocente.fields.usuario') }}</label>
                            <input class="form-control" type="text" name="usuario" id="usuario" value="{{ old('usuario', '') }}">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaDocente.fields.usuario_helper') }}</span>
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