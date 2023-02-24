@extends('admin::layout')

@component('admin::include.page.header')
    @slot('title', clean(trans('author::authors.authors')))

    <li class="nav-item">{{ clean(trans('author::authors.authors')) }}</li>
@endcomponent

@component('admin::include.page.table')
    @slot('title', clean(trans('author::authors.authors')))
    @slot('buttons', ['create'])
    @slot('resource', 'authors')
    @slot('name', clean(trans('author::authors.authors')))

    @slot('thead')
        <tr>
            @include('admin::include.table.select-all',["name"=>trans('author::authors.author')])
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Creado Por</th>
            <th>Estado</th>
            <th>Verificado</th>
            <th data-sort>Fecha Creacion</th>
        </tr>
    @endslot
@endcomponent

@push('scripts')
    <script>
        new DataTable('#authors-table .table', {
            columns: [
                { data: 'checkbox', orderable: false, searchable: false, width: '3%' },
                { data: 'image', orderable: false, searchable: false, width: '10%' },
                { data: 'name', name: 'translations.name', orderable: false, defaultContent: '' },
                { data: 'user.full_name', name: 'user.first_name', orderable: false, defaultContent: '' },
                { data: 'status', name: 'is_active', searchable: false },
                { data: 'is_verified', name: 'is_verified', searchable: false },
                { data: 'created', name: 'created_at' },
            ],
        });
    </script>
@endpush
