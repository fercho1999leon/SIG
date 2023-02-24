@extends('layouts.master3')
@php
use App\TituloGrado;
@endphp
@section('content')
    <div class="content">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('titulo-grados.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.tituloGrado.title_singular') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('cruds.tituloGrado.title_singular') }} {{ trans('global.list') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-TituloGrado">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                            {{ trans('cruds.tituloGrado.fields.id') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.tituloGrado.fields.nombre') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.tituloGrado.fields.codigo_senescyt') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.tituloGrado.fields.universidad') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.tituloGrado.fields.pais') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.tituloGrado.fields.ano') }}
                                        </th>
                                        <th>
                                            {{ trans('cruds.tituloGrado.fields.usuario') }}
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $tituloGrados = TituloGrado::where('usuario_id', $docente->id);
                                    @endphp
                                    @foreach ($tituloGrados as $key => $tituloGrado)
                                        <tr data-entry-id="{{ $tituloGrado->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $tituloGrado->id ?? '' }}
                                            </td>
                                            <td>
                                                {{ $tituloGrado->nombre ?? '' }}
                                            </td>
                                            <td>
                                                {{ $tituloGrado->codigo_senescyt ?? '' }}
                                            </td>
                                            <td>
                                                {{ $tituloGrado->universidad ?? '' }}
                                            </td>
                                            <td>
                                                {{ $tituloGrado->pais ?? '' }}
                                            </td>
                                            <td>
                                                {{ $tituloGrado->ano ?? '' }}
                                            </td>
                                            <td>
                                                {{ $tituloGrado->usuario ?? '' }}
                                            </td>
                                            <td>
                                                @can('titulo_grado_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('admin.titulo-grados.show', $tituloGrado->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('titulo_grado_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('admin.titulo-grados.edit', $tituloGrado->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('titulo_grado_delete')
                                                    <form
                                                        action="{{ route('admin.titulo-grados.destroy', $tituloGrado->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                        style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger"
                                                            value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('titulo_grado_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.titulo-grados.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
                });
            
                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')
            
                return
                }
            
                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-TituloGrado:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
