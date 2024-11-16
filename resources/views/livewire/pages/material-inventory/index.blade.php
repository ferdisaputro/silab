<x-container x-data="Object.assign({materialInventoryState: false}, editMaterialInventory())">
    <div>
        <x-modals.modal identifier="materialInventoryState" max_width="max-w-xl">
            <livewire:pages.material-inventory.create />
        </x-modals.modal>

        <x-modals.modal identifier="editMaterialInventoryState" max_width="max-w-xl">
            <livewire:pages.material-inventory.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Bahan Laboratorium
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="materialInventoryState = true" title="" color="purple">Tambah Bahan Laboratorium</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-materialInventory">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Barang <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Satuan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Jumlah <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>Barang - {{ $i }}</td>
                            <td>satuan {{ $i }}</td>
                            <td>{{ $i + 13 }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditMaterialInventory('{{ Crypt::encrypt($i) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
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
            Alpine.data('editMaterialInventory', () => {
                return {
                    editMaterialInventoryState: false,
                    showEditMaterialInventory (id) {
                        $wire.dispatch('initEditMaterialInventory', {id: id}); // this is function is dispatching a function from pages/MaterialInventory/Edit
                        this.editMaterialInventoryState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
