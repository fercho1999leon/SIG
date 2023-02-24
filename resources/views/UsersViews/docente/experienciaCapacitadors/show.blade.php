@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.experienciaCapacitador.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-capacitadors.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $experienciaCapacitador->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.curso_seminario') }}
                                    </th>
                                    <td>
                                        {{ $experienciaCapacitador->curso_seminario }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.entidades') }}
                                    </th>
                                    <td>
                                        {{ $experienciaCapacitador->entidades }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.desde') }}
                                    </th>
                                    <td>
                                        {{ $experienciaCapacitador->desde }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.hasta') }}
                                    </th>
                                    <td>
                                        {{ $experienciaCapacitador->hasta }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $experienciaCapacitador->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-capacitadors.index') }}">
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