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

<div class="overflow-x-auto">
    <div class="space-y-5 w-full min-w-[32rem]">
        <div class="flex gap-3">
            <div class="flex-1 max-w-20">
                <select wire:model.live="{{ $eventTarget."PerPage" }}" class="border h-12 disabled:bg-primaryGrey peer capitalize border-gray-200 text-sm rounded-lg focus:ring-primaryTeal focus:border-primaryTeal block w-full px-4 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primaryTeal dark:focus:border-primaryTeal">
                    <option value="15">15</option>
                    <option value="20" default>20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="flex justify-end flex-1 gap-3">
                <div class="flex items-center">
                    <x-loading.circle wire:loading></x-loading.circle>
                </div>
                <div class="flex-1 max-w-xs">
                    <input wire:model.live.debounce.200ms="{{ $eventTarget."Filter" }}" placeholder="Cari Data..." class="block w-full h-12 px-4 text-sm bg-transparent border border-gray-200 rounded-lg appearance-none dark:border-gray-600 dark:focus:border-primaryLightTeal focus:outline-none focus:ring-0 focus:border-primaryTeal peer">
                </div>
            </div>
        </div>
        <div>
            <style>
                .table :is(th, td) {
                    padding: .6rem 1rem;
                    text-align: left;
                    color: rgb(108, 107, 107);
                }

                .table th {
                    font-weight: 700;
                    font-size: .9rem
                }

                .table td {
                    border-bottom: 1px solid #ddd;
                }

                .table th {
                    background: rgb(231, 231, 231);
                }
            </style>

            <table class="table w-full">
                {{ $slot }}
            </table>
        </div>
        <div>
            {{ $data? $data->links() : "" }}
        </div>
    </div>
</div>

@pushOnce('scripts')
    @script
        <script>
            const tableContainer = document.querySelectorAll('.table')
            tableContainer.forEach(element => {
                const sortable = element.querySelectorAll('[data-sortby]')

                sortable.forEach(th => {
                    th.classList.add('cursor-pointer')
                    th.setAttribute('data-sort-direction', '')
                    th.setAttribute('wire:ignore', '')
                    const sortIcon = '<i class="fa-solid fa-sort ms-3">'
                    th.innerHTML = th.innerText + sortIcon

                    th.addEventListener('click', () => {
                        const currentDirection = th.getAttribute('data-sort-direction')
                        sortable.forEach(t => {
                            if (t !== th) {
                                t.setAttribute('data-sort-direction', '')
                                t.querySelector('i').classList.remove('fa-sort-up', 'fa-sort-down')
                                t.querySelector('i').classList.add('fa-sort')
                            }
                        })
                        switch (currentDirection) {
                            case '':
                                th.setAttribute('data-sort-direction', 'asc')
                                th.querySelector('i').classList.remove('fa-sort')
                                th.querySelector('i').classList.add('fa-sort-up')
                                break
                            case 'asc':
                                th.setAttribute('data-sort-direction', 'desc')
                                th.querySelector('i').classList.remove('fa-sort-up')
                                th.querySelector('i').classList.add('fa-sort-down')
                                break
                            case 'desc':
                                th.setAttribute('data-sort-direction', '')
                                th.querySelector('i').classList.remove('fa-sort-down')
                                th.querySelector('i').classList.add('fa-sort')
                                break
                        }
                        $wire.set("{{ $eventTarget."OrderBy" }}", th.getAttribute('data-sortby'))
                        $wire.set("{{ $eventTarget."OrderByDirection" }}", th.getAttribute('data-sort-direction'))
                    })
                })
            });
        </script>
    @endscript
@endPushOnce
