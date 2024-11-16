<x-container x-data="Object.assign({toolInventoryState: false}, editToolInventory())">
    <div>
        <x-modals.modal identifier="toolInventoryState" max_width="max-w-xl">
            <livewire:pages.tool-inventory.create />
        </x-modals.modal>

        <x-modals.modal identifier="editToolInventoryState" max_width="max-w-xl">
            <livewire:pages.tool-inventory.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Alat Laboratorium
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="toolInventoryState = true" title="" color="purple">Tambah Alat Laboratorium</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-toolInventory">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Barang <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Jumlah <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Keterangan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>Barang - {{ $i }}</td>
                            <td>{{ $i + 13 }}</td>
                            <td>keterangan {{ $i }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditToolInventory('{{ Crypt::encrypt($i) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editToolInventory', () => {
                return {
                    editToolInventoryState: false,
                    showEditToolInventory (id) {
                        $wire.dispatch('initEditToolInventory', {id: id}); // this is function is dispatching a function from pages/ToolInventory/Edit
                        this.editToolInventoryState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
