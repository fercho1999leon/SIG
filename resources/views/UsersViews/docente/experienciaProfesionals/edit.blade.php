@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.experienciaProfesional.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("experiencia-profesionals.update", [$experienciaProfesional->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('empresa_institucion') ? 'has-error' : '' }}">
                            <label for="empresa_institucion">{{ trans('cruds.experienciaProfesional.fields.empresa_institucion') }}</label>
                            <input class="form-control" type="text" name="empresa_institucion" id="empresa_institucion" value="{{ old('empresa_institucion', $experienciaProfesional->empresa_institucion) }}">
                            @if($errors->has('empresa_institucion'))
                                <span class="help-block" role="alert">{{ $errors->first('empresa_institucion') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaProfesional.fields.empresa_institucion_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('cargo') ? 'has-error' : '' }}">
                            <label for="cargo">{{ trans('cruds.experienciaProfesional.fields.cargo') }}</label>
                            <input class="form-control" type="text" name="cargo" id="cargo" value="{{ old('cargo', $experienciaProfesional->cargo) }}">
                            @if($errors->has('cargo'))
                                <span class="help-block" role="alert">{{ $errors->first('cargo') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaProfesional.fields.cargo_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('desde') ? 'has-error' : '' }}">
                            <label for="desde">{{ trans('cruds.experienciaProfesional.fields.desde') }}</label>
                            <input class="form-control date" type="text" name="desde" id="desde" value="{{ old('desde', $experienciaProfesional->desde) }}">
                            @if($errors->has('desde'))
                                <span class="help-block" role="alert">{{ $errors->first('desde') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaProfesional.fields.desde_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('hasta') ? 'has-error' : '' }}">
                            <label for="hasta">{{ trans('cruds.experienciaProfesional.fields.hasta') }}</label>
                            <input class="form-control date" type="text" name="hasta" id="hasta" value="{{ old('hasta', $experienciaProfesional->hasta) }}">
                            @if($errors->has('hasta'))
                                <span class="help-block" role="alert">{{ $errors->first('hasta') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaProfesional.fields.hasta_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('usuario') ? 'has-error' : '' }}">
                            <label for="usuario">{{ trans('cruds.experienciaProfesional.fields.usuario') }}</label>
                            <input class="form-control" type="number" name="usuario" id="usuario" value="{{ old('usuario', $experienciaProfesional->usuario) }}" step="1">
                            @if($errors->has('usuario'))
                                <span class="help-block" role="alert">{{ $errors->first('usuario') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.experienciaProfesional.fields.usuario_helper') }}</span>
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