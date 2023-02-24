@extends('layouts.master2')
@section('content')
<div class="content">
    @can('publicacion_libro_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.publicacion-libros.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.publicacionLibro.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.publicacionLibro.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PublicacionLibro">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.titulo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.filiacion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.codigo_issn') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.volumen') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.fecha_publicacion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.publicacionLibro.fields.usuario') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($publicacionLibros as $key => $publicacionLibro)
                                    <tr data-entry-id="{{ $publicacionLibro->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $publicacionLibro->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $publicacionLibro->titulo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $publicacionLibro->filiacion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $publicacionLibro->codigo_issn ?? '' }}
                                        </td>
                                        <td>
                                            {{ $publicacionLibro->volumen ?? '' }}
                                        </td>
                                        <td>
                                            {{ $publicacionLibro->fecha_publicacion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $publicacionLibro->usuario ?? '' }}
                                        </td>
                                        <td>
                                            @can('publicacion_libro_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.publicacion-libros.show', $publicacionLibro->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('publicacion_libro_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.publicacion-libros.edit', $publicacionLibro->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('publicacion_libro_delete')
                                                <form action="{{ route('admin.publicacion-libros.destroy', $publicacionLibro->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('publicacion_libro_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.publicacion-libros.massDestroy') }}",
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
  let table = $('.datatable-PublicacionLibro:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection