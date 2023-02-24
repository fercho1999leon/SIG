@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.experienciaProfesional.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-profesionals.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $experienciaProfesional->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.empresa_institucion') }}
                                    </th>
                                    <td>
                                        {{ $experienciaProfesional->empresa_institucion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.cargo') }}
                                    </th>
                                    <td>
                                        {{ $experienciaProfesional->cargo }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.desde') }}
                                    </th>
                                    <td>
                                        {{ $experienciaProfesional->desde }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.hasta') }}
                                    </th>
                                    <td>
                                        {{ $experienciaProfesional->hasta }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $experienciaProfesional->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.experiencia-profesionals.index') }}">
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