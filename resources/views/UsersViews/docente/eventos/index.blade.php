@extends('layouts.master2')
@section('content')
<div class="content">
    @can('evento_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.eventos.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.evento.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.evento.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Evento">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.evento.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.evento.fields.nombre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.evento.fields.lugar') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.evento.fields.fecha_publicacion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.evento.fields.url') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.evento.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventos as $key => $evento)
                                    <tr data-entry-id="{{ $evento->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $evento->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $evento->nombre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $evento->lugar ?? '' }}
                                        </td>
                                        <td>
                                            {{ $evento->fecha_publicacion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $evento->url ?? '' }}
                                        </td>
                                        <td>
                                            {{ $evento->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('evento_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.eventos.show', $evento->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('evento_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.eventos.edit', $evento->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('evento_delete')
                                                <form action="{{ route('admin.eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('evento_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.eventos.massDestroy') }}",
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
  let table = $('.datatable-Evento:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection