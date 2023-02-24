@extends('layouts.master2')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.certificacione.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.certificaciones.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $certificacione->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.nombre') }}
                                    </th>
                                    <td>
                                        {{ $certificacione->nombre }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.registro_setec') }}
                                    </th>
                                    <td>
                                        {{ $certificacione->registro_setec }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.institucion_certificadora') }}
                                    </th>
                                    <td>
                                        {{ $certificacione->institucion_certificadora }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.pais') }}
                                    </th>
                                    <td>
                                        {{ $certificacione->pais }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.ano') }}
                                    </th>
                                    <td>
                                        {{ $certificacione->ano }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $certificacione->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.certificaciones.index') }}">
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