@props(['id'])

<table
    id="{{ $id }}"
    x-init='
        const dataTable = new DataTable("#{{ $id }}", {
            searchable: true,
            sortable: true,
        })
    '>
    {{ $slot }}
</table>
