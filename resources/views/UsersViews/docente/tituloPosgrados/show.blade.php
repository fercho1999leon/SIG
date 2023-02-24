@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.tituloPosgrado.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.titulo-posgrados.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $tituloPosgrado->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.nombre') }}
                                    </th>
                                    <td>
                                        {{ $tituloPosgrado->nombre }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.codigo_senescyt') }}
                                    </th>
                                    <td>
                                        {{ $tituloPosgrado->codigo_senescyt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.universidad') }}
                                    </th>
                                    <td>
                                        {{ $tituloPosgrado->universidad }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.pais') }}
                                    </th>
                                    <td>
                                        {{ $tituloPosgrado->pais }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.ano') }}
                                    </th>
                                    <td>
                                        {{ $tituloPosgrado->ano }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $tituloPosgrado->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.titulo-posgrados.index') }}">
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