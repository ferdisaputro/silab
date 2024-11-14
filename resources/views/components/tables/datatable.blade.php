@props(['id' => ''])

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
        })
    '>
    {{ $slot }}
</table>
