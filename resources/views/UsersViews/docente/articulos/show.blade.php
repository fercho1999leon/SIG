@extends('layouts.master2')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.articulo.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.articulos.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.articulo.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $articulo->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.articulo.fields.titulo') }}
                                    </th>
                                    <td>
                                        {{ $articulo->titulo }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.articulo.fields.nombre_revista') }}
                                    </th>
                                    <td>
                                        {{ $articulo->nombre_revista }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.articulo.fields.codigo_issn') }}
                                    </th>
                                    <td>
                                        {{ $articulo->codigo_issn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.articulo.fields.volumen') }}
                                    </th>
                                    <td>
                                        {{ $articulo->volumen }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.articulo.fields.fecha_publicacion') }}
                                    </th>
                                    <td>
                                        {{ $articulo->fecha_publicacion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.articulo.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $articulo->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.articulos.index') }}">
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