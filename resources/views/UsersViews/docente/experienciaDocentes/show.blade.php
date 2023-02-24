@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.experienciaDocente.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-docentes.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $experienciaDocente->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.curso_materia_modulo') }}
                                    </th>
                                    <td>
                                        {{ $experienciaDocente->curso_materia_modulo }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.institucion') }}
                                    </th>
                                    <td>
                                        {{ $experienciaDocente->institucion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.desde') }}
                                    </th>
                                    <td>
                                        {{ $experienciaDocente->desde }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.hasta') }}
                                    </th>
                                    <td>
                                        {{ $experienciaDocente->hasta }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $experienciaDocente->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-docentes.index') }}">
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