<x-container x-data="Object.assign({materialInventoryState: false}, initEditLabItem())">
    {{-- @dd($this->laboratories) --}}
    <div>
        <x-modals.modal identifier="materialInventoryState" max_width="max-w-xl">
            <livewire:pages.material-inventory.create data="{{ $lab_id }}" wire:key="{{ now() }}" />
        </x-modals.modal>

        <x-modals.modal identifier="editMaterialInventoryState" max_width="max-w-xl">
            <livewire:pages.material-inventory.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            {{-- @dump($lab_id) --}}
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
                <x-buttons.fill x-on:click="materialInventoryState = true" title="" color="purple">Tambah Bahan Laboratorium</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-materialInventory" :data="$this->labItems" eventTarget="labItem">
                <thead>
                    <tr>
                        <th data-sortby="id">#</th>
                        <th data-sortby="code">Nama Bahan</th>
                        <th>Satuan</th>
                        <th data-sortby="stock">Jumlah</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->labItems as $index => $labitem)
                        <tr wire:key='{{ $loop->iteration + ($this->LabItems->perPage() * ($this->LabItems->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->LabItems->perPage() * ($this->LabItems->currentPage() - 1)) }}</td>
                            <td>{{ $labitem->item->item_name }}</td>
                            <td>{{ $labitem->item->unit->satuan }}</td>
                            <td>{{ $labitem->stock }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditMaterialInventory('{{ Crypt::encrypt($labitem->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="deleteItem('{{ Crypt::encrypt($labitem->id) }}', '{{ $labitem->code }}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('initEditLabItem', () => {
                return {
                    editMaterialInventoryState: false,
                    showEditMaterialInventory (key) {
                        $wire.dispatch('initEditLabItem', {key: key}); // this is function is dispatching a function from pages/MaterialInventory/Edit
                        this.editMaterialInventoryState = true;
                    },

                    deleteItem(key, code) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Tool ${name}?`,
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
