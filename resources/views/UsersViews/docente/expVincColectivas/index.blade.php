@extends('layouts.master2')
@section('content')
<div class="content">
    @can('exp_vinc_colectiva_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.exp-vinc-colectivas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.expVincColectiva.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.expVincColectiva.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ExpVincColectiva">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.tipo_experiencia') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.programa_proyecto') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.duracion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expVincColectiva.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expVincColectivas as $key => $expVincColectiva)
                                    <tr data-entry-id="{{ $expVincColectiva->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $expVincColectiva->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expVincColectiva->tipo_experiencia ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expVincColectiva->programa_proyecto ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expVincColectiva->duracion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expVincColectiva->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('exp_vinc_colectiva_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.exp-vinc-colectivas.show', $expVincColectiva->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('exp_vinc_colectiva_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.exp-vinc-colectivas.edit', $expVincColectiva->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('exp_vinc_colectiva_delete')
                                                <form action="{{ route('admin.exp-vinc-colectivas.destroy', $expVincColectiva->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('exp_vinc_colectiva_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.exp-vinc-colectivas.massDestroy') }}",
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
  let table = $('.datatable-ExpVincColectiva:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection