@extends('layouts.master2')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.expVincColectiva.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.exp-vinc-colectivas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $expVincColectiva->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.tipo_experiencia') }}
                                    </th>
                                    <td>
                                        {{ $expVincColectiva->tipo_experiencia }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.programa_proyecto') }}
                                    </th>
                                    <td>
                                        {{ $expVincColectiva->programa_proyecto }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.duracion') }}
                                    </th>
                                    <td>
                                        {{ $expVincColectiva->duracion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.usuario') }}
                                    </th>
                                    <td>
                                        {{ $expVincColectiva->usuario }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.exp-vinc-colectivas.index') }}">
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