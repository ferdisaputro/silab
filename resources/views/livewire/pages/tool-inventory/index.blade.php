<x-container x-data="Object.assign({toolInventoryState: false}, editToolInventory())">
    <div>
        <x-modals.modal identifier="toolInventoryState" max_width="max-w-xl">
            <livewire:pages.tool-inventory.create data="{{ $lab_id }}" wire:key="{{ now() }}" />
        </x-modals.modal>

        <x-modals.modal identifier="editToolInventoryState" max_width="max-w-xl">
            <livewire:pages.tool-inventory.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                <x-forms.select class="flex-1"
                    name="lab_id"
                    label="Pilih Labolatorium"
                    key="lab_id"
                    wire:model.live.debounce="lab_id"
                    wire:init="set('lab_id', '{{ $this->laboratories->first()->id }}')">
                    @foreach ($this->laboratories as $labolatory)
                        <option value="{{ $labolatory->id }}">{{ ucfirst($labolatory->name) }}</option>
                    @endforeach
                </x-forms.select>
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="toolInventoryState = true" title="" color="purple">Tambah Alat Laboratorium</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable>
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortby=''>Barang <i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortby=''>Jumlah <i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortby=''>Keterangan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->labTools as $index => $labtool)
                        <tr wire:key='{{ $loop->iteration + ($this->labTools->perPage() * ($this->labTools->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->labTools->perPage() * ($this->labTools->currentPage() - 1)) }}</td>
                            <td>{{ $labtool->item->item_name }}</td>
                            <td>{{ $labtool->item->unit->satuan }}</td>
                            <td>{{ $labtool->stock }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditToolInventory('{{ Crypt::encrypt($labtool->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="deleteItem('{{ Crypt::encrypt($labtool->id) }}', '{{ $labtool->code }}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                        @endforeach
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
                    showEditToolInventory (key) {
                        $wire.dispatch('initEditLabTool', {key: key}); // this is function is dispatching a function from pages/ToolInventory/Edit
                        this.editToolInventoryState = true;
                    },
                    deleteItem(key, code) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Alat ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Tool Berhasil Dihapus', 'success')
                                    $wire.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', 'Data Gagal Dihapus: ' + result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
