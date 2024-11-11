<x-container x-data="{createItemState: false}">
    <div>
        <x-modals.modal identifier="createItemState" max_width="max-w-6xl">
            <livewire:pages.employee.create />
        </x-modals.modal>
    </div>
    <div class="p-5 space-y-6 bg-white rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Barang
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createItemState = true" color="purple">Create Pegawai</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="item-table">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Barang<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Quantity<i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 70; $i++)
                        <tr wire:key='{{ $i }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i + 1 }}</td>
                            <td>nama {{ $i }}</td>
                            <td>{{ mt_rand(1, 100) }}</td>
                            <td class="text-center">
                                <x-badges.outline class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>
