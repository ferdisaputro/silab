<x-container x-data="Object.assign({createItemState: false}, Item())">
    <div>
        <x-modals.modal identifier="createItemState" max_width="max-w-6xl">
            <livewire:pages.item.create lazy/>
        </x-modals.modal>
        <x-modals.modal identifier="editItemState" max_width="max-w-6xl">
            <livewire:pages.item.edit/>
        </x-modals.modal>
    </div>
z`    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Barang
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createItemState = true" color="purple">Tambah Barang</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="item-table" :data="$this->items" eventTarget="item">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th data-sortby="item_name">Barang</th>
                        <th data-sortby="quantity">Quantity</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->items as $index => $item)
                        <tr wire:key='{{ $loop->iteration + ($this->items->perPage() * ($this->items->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->items->perPage() * ($this->items->currentPage() - 1)) }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->labItems->sum('stock') }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditItem('{{ Crypt::encrypt($item->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="deleteItem('{{ Crypt::encrypt($item->id) }}', '{{ $item->item_name }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('Item', () => {
                return {
                    editItemState: false,
                    showEditItem(key) {
                        // console.log(key);
                        $wire.dispatch("initEditItem", {key: key});
                        this.editItemState = true;
                    },

                    deleteItem(key,item_name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Item ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data item Berhasil Dihapus', 'success')
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
@endPushOnce

