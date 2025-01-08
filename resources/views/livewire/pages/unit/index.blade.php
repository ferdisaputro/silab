<x-container x-data="Object.assign({ createUnitState: false }, unit())">
    <div>
        <x-modals.modal identifier="createUnitState">
            <livewire:pages.unit.create />
        </x-modals.modal>

        <x-modals.modal identifier="editModalState">
            <livewire:pages.unit.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Satuan
            </x-text.page-title>
            {{-- <a href="{{ route('pegawai.create') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="createUnitState = true" color="purple">Create Satuan</x-buttons.fill>
            </div>
        </div>
        <div>
            <x-tables.datatable id="tabel-unit" :data="$this->units" eventTarget="unit">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid ms-2"></i></th>
                        <th data-sortby="satuan">Satuan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->units as  $index => $unit)
                        <tr wire:key='{{ $loop->iteration + ($this->units->perPage() * ($this->units->currentPage() - 1)) }}'>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->satuan }}</td>
                            <td class="text-center">
                                    <x-badges.outline wire:key='{{ $index }}' x-on:click="showEditUnit('{{ Crypt::encrypt($unit->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                    <x-badges.outline x-on:click="deleteUnit('{{ Crypt::encrypt($unit->id) }}', '{{ $unit->satuan }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('unit', () => {
                return {
                    editModalState: false,
                    showEditUnit(key) {
                        $wire.dispatch("initEditUnit", {key: key});
                        this.editModalState = true;
                    },

                    deleteUnit(key, satuan) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus Unit ${satuan}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Unit Berhasil Dihapus', 'success')
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
