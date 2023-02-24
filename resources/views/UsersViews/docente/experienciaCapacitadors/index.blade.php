@extends('layouts.master2')
@section('content')
<div class="content">
    @can('experiencia_capacitador_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.experiencia-capacitadors.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.experienciaCapacitador.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.experienciaCapacitador.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ExperienciaCapacitador">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.curso_seminario') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.entidades') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.desde') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.hasta') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaCapacitador.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($experienciaCapacitadors as $key => $experienciaCapacitador)
                                    <tr data-entry-id="{{ $experienciaCapacitador->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $experienciaCapacitador->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaCapacitador->curso_seminario ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaCapacitador->entidades ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaCapacitador->desde ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaCapacitador->hasta ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaCapacitador->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('experiencia_capacitador_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.experiencia-capacitadors.show', $experienciaCapacitador->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('experiencia_capacitador_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.experiencia-capacitadors.edit', $experienciaCapacitador->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('experiencia_capacitador_delete')
                                                <form action="{{ route('admin.experiencia-capacitadors.destroy', $experienciaCapacitador->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('experiencia_capacitador_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.experiencia-capacitadors.massDestroy') }}",
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
  let table = $('.datatable-ExperienciaCapacitador:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection