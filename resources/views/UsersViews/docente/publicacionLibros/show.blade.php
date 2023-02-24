@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.publicacionLibro.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.publicacion-libros.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $publicacionLibro->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.titulo') }}
                                    </th>
                                    <td>
                                        {{ $publicacionLibro->titulo }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.filiacion') }}
                                    </th>
                                    <td>
                                        {{ $publicacionLibro->filiacion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.codigo_issn') }}
                                    </th>
                                    <td>
                                        {{ $publicacionLibro->codigo_issn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.volumen') }}
                                    </th>
                                    <td>
                                        {{ $publicacionLibro->volumen }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.fecha_publicacion') }}
                                    </th>
                                    <td>
                                        {{ $publicacionLibro->fecha_publicacion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $publicacionLibro->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.publicacion-libros.index') }}">
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