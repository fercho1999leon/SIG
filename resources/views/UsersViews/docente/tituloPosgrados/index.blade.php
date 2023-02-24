@extends('layouts.master2')
@section('content')
<div class="content">
    @can('titulo_posgrado_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.titulo-posgrados.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.tituloPosgrado.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.tituloPosgrado.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TituloPosgrado">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.nombre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.codigo_senescyt') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.universidad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.pais') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.ano') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tituloPosgrado.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tituloPosgrados as $key => $tituloPosgrado)
                                    <tr data-entry-id="{{ $tituloPosgrado->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $tituloPosgrado->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tituloPosgrado->nombre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tituloPosgrado->codigo_senescyt ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tituloPosgrado->universidad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tituloPosgrado->pais ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tituloPosgrado->ano ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tituloPosgrado->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('titulo_posgrado_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.titulo-posgrados.show', $tituloPosgrado->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('titulo_posgrado_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.titulo-posgrados.edit', $tituloPosgrado->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('titulo_posgrado_delete')
                                                <form action="{{ route('admin.titulo-posgrados.destroy', $tituloPosgrado->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('titulo_posgrado_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.titulo-posgrados.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-TituloPosgrado:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection