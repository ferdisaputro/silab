@props([
    'id' => '',
    'perPage' => 15,
    'perPageSelect' => [10, 15, 20, 30, 40]
])

@php
    $letters = range('a', 'j');
    $randId = "";
    for ($i = 0; $i < count($letters); $i++) {
        $randId = $randId.$letters[array_rand($letters)];
    }
@endphp

<table
    id="{{ $randId }}"
    x-init='
        const dataTable = new DataTable("#{{ $randId }}", {
            searchable: true,
            sortable: true,
            perPage: {{ $perPage }},
            perPageSelect: {!! json_encode($perPageSelect) !!},
        })
    '>
    {{ $slot }}
</table>
