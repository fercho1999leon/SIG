@extends('layouts.admin')
@section('content')
<div class="content">
    @can('certificacione_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('certificaciones.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.certificacione.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.certificacione.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Certificacione">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.nombre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.registro_setec') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.institucion_certificadora') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.pais') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.ano') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.certificacione.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certificaciones as $key => $certificacione)
                                    <tr data-entry-id="{{ $certificacione->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $certificacione->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificacione->nombre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificacione->registro_setec ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificacione->institucion_certificadora ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificacione->pais ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificacione->ano ?? '' }}
                                        </td>
                                        <td>
                                            {{ $certificacione->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('certificacione_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('certificaciones.show', $certificacione->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('certificacione_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('certificaciones.edit', $certificacione->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('certificacione_delete')
                                                <form action="{{ route('certificaciones.destroy', $certificacione->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('certificacione_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('certificaciones.massDestroy') }}",
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
  let table = $('.datatable-Certificacione:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection