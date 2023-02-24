@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.tituloGrado.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.titulo-grados.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloGrado.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $tituloGrado->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloGrado.fields.nombre') }}
                                    </th>
                                    <td>
                                        {{ $tituloGrado->nombre }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloGrado.fields.codigo_senescyt') }}
                                    </th>
                                    <td>
                                        {{ $tituloGrado->codigo_senescyt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloGrado.fields.universidad') }}
                                    </th>
                                    <td>
                                        {{ $tituloGrado->universidad }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloGrado.fields.pais') }}
                                    </th>
                                    <td>
                                        {{ $tituloGrado->pais }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloGrado.fields.ano') }}
                                    </th>
                                    <td>
                                        {{ $tituloGrado->ano }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tituloGrado.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $tituloGrado->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.titulo-grados.index') }}">
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