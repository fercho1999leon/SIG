@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.experienciaVinculacion.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-vinculacions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaVinculacion.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $experienciaVinculacion->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaVinculacion.fields.tipo_experiencia') }}
                                    </th>
                                    <td>
                                        {{ $experienciaVinculacion->tipo_experiencia }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaVinculacion.fields.programa') }}
                                    </th>
                                    <td>
                                        {{ $experienciaVinculacion->programa }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaVinculacion.fields.duracion') }}
                                    </th>
                                    <td>
                                        {{ $experienciaVinculacion->duracion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaVinculacion.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $experienciaVinculacion->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-vinculacions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection