@extends('layouts.master2')
@section('content')
<div class="content">
    @can('experiencia_docente_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.experiencia-docentes.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.experienciaDocente.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.experienciaDocente.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ExperienciaDocente">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.curso_materia_modulo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.institucion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.desde') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.hasta') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.experienciaDocente.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($experienciaDocentes as $key => $experienciaDocente)
                                    <tr data-entry-id="{{ $experienciaDocente->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $experienciaDocente->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaDocente->curso_materia_modulo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaDocente->institucion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaDocente->desde ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaDocente->hasta ?? '' }}
                                        </td>
                                        <td>
                                            {{ $experienciaDocente->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('experiencia_docente_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.experiencia-docentes.show', $experienciaDocente->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('experiencia_docente_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.experiencia-docentes.edit', $experienciaDocente->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('experiencia_docente_delete')
                                                <form action="{{ route('admin.experiencia-docentes.destroy', $experienciaDocente->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('experiencia_docente_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.experiencia-docentes.massDestroy') }}",
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
  let table = $('.datatable-ExperienciaDocente:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection