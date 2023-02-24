@extends('layouts.master2')
@section('content')
<div class="content">
    @can('seminario_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.seminarios.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.seminario.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.seminario.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Seminario">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.seminario.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.seminario.fields.nombre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.seminario.fields.institucion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.seminario.fields.pais') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.seminario.fields.ano') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.seminario.fields.numero_horas') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.seminario.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seminarios as $key => $seminario)
                                    <tr data-entry-id="{{ $seminario->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $seminario->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $seminario->nombre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $seminario->institucion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $seminario->pais ?? '' }}
                                        </td>
                                        <td>
                                            {{ $seminario->ano ?? '' }}
                                        </td>
                                        <td>
                                            {{ $seminario->numero_horas ?? '' }}
                                        </td>
                                        <td>
                                            {{ $seminario->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('seminario_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.seminarios.show', $seminario->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('seminario_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.seminarios.edit', $seminario->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('seminario_delete')
                                                <form action="{{ route('admin.seminarios.destroy', $seminario->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('seminario_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.seminarios.massDestroy') }}",
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
  let table = $('.datatable-Seminario:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection