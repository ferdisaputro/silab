@props([
    'id' => '',
    'perPage' => 15,
    'perPageSelect' => [10, 15, 20, 30, 40],
    'data' => null,
    'eventTarget' => null, // recomend to use camelcase based on folder name. e.g. 'employee' or 'handoverPracticalResult'
])

@php
    $letters = range('a', 'j');
    $randId = "";
    for ($i = 0; $i < count($letters); $i++) {
        $randId = $randId.$letters[array_rand($letters)];
    }
@endphp

<div>
    <div class="flex justify-between">
        <div class="flex-1 max-w-20">
            <select wire:model.live="{{ $eventTarget."PerPage" }}" class="border h-12 disabled:bg-primaryGrey peer capitalize border-gray-200 text-sm rounded-lg focus:ring-primaryTeal focus:border-primaryTeal block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryTeal dark:focus:border-primaryTeal">
                <option value="15">15</option>
                <option value="20" default>20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="flex-1 max-w-xs">
            <input wire:model.live.debounce.200ms="{{ $eventTarget."Filter" }}" placeholder="Cari Data..." class="block w-full h-12 px-4 text-sm bg-transparent border border-gray-200 rounded-lg appearance-none dark:border-gray-600 dark:focus:border-primaryLightTeal focus:outline-none focus:ring-0 focus:border-primaryTeal peer">
        </div>


    </div>
    <table
        id="{{ $randId }}"
        x-init='
            const dataTable = new DataTable("#{{ $randId }}", {
                paging: false,
                searchable: false,
                sortable: true,
                perPage: {{ $perPage }},
                perPageSelect: {!! json_encode($perPageSelect) !!},
            })

            dataTable.on("datatable.sort", (columnIndex, direction) => {
                const columns = Array.from(document.querySelectorAll("#{{ $randId }} th")).map(th => th.getAttribute("data-name"))
                console.log(direction, columns[columnIndex])
                $wire.{{ $eventTarget."OrderBy" }} = columns[columnIndex]
                $wire.{{ $eventTarget."OrderByDirection" }} = direction
                {{-- $wire.dump() --}}
            })
        '>
        {{ $slot }}
    </table>
    <div class="-mt-8">
        {{ $data !== ""? $data->links() : "" }}
    </div>
</div>
