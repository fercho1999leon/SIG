@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.seminario.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.seminarios.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.seminario.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $seminario->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.seminario.fields.nombre') }}
                                    </th>
                                    <td>
                                        {{ $seminario->nombre }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.seminario.fields.institucion') }}
                                    </th>
                                    <td>
                                        {{ $seminario->institucion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.seminario.fields.pais') }}
                                    </th>
                                    <td>
                                        {{ $seminario->pais }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.seminario.fields.ano') }}
                                    </th>
                                    <td>
                                        {{ $seminario->ano }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.seminario.fields.numero_horas') }}
                                    </th>
                                    <td>
                                        {{ $seminario->numero_horas }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.seminario.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $seminario->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.seminarios.index') }}">
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