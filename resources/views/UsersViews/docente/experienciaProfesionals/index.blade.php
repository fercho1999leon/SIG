@extends('layouts.master2')
@section('content')
<div class="content">
    @can('experiencia_profesional_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.experiencia-profesionals.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.experienciaProfesional.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.experienciaProfesional.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ExperienciaProfesional">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.empresa_institucion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.cargo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.desde') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.hasta') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaProfesional.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($experienciaProfesionals as $key => $experienciaProfesional)
                                    <tr data-entry-id="{{ $experienciaProfesional->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $experienciaProfesional->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaProfesional->empresa_institucion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaProfesional->cargo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaProfesional->desde ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaProfesional->hasta ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaProfesional->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('experiencia_profesional_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.experiencia-profesionals.show', $experienciaProfesional->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('experiencia_profesional_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.experiencia-profesionals.edit', $experienciaProfesional->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('experiencia_profesional_delete')
                                                <form action="{{ route('admin.experiencia-profesionals.destroy', $experienciaProfesional->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('experiencia_profesional_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.experiencia-profesionals.massDestroy') }}",
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
  let table = $('.datatable-ExperienciaProfesional:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection