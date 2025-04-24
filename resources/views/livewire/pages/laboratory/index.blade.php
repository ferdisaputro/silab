<x-container x-data="Object.assign({createLaboratoryState: false}, laboratory())">
    <div>
        <x-modals.modal identifier="detailLaboratoryState" max_width="max-w-4xl">
            <livewire:pages.laboratory.detail lazy/>
        </x-modals.modal>

        {{-- $this->authorize('hasPermissionTo', 'lab-list|lab-create|lab-edit|lab-delete'); --}}
        @can('lab-create')
            <x-modals.modal identifier="createLaboratoryState" max_width="max-w-4xl">
                <livewire:pages.laboratory.create lazy/>
            </x-modals.modal>
        @endcan
        @can('lab-edit')
            <x-modals.modal identifier="editLaboratoryState" max_width="max-w-4xl">
                <livewire:pages.laboratory.edit lazy/>
            </x-modals.modal>
        @endcan
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Laboratorium
            </x-text.page-title>
            {{-- <a href="{{ route('employee.create') }}" wire:navigate> --}}
            @can('lab-create')
                <div>
                    <x-buttons.fill x-on:click="createLaboratoryState = true" color="purple">Tambah Laboratorium</x-buttons.fill>
                </div>
            @endcan
        </div>

        <div>
            <x-tables.datatable :data="$this->laboratories" eventTarget="laboratory">
                <thead>
                    <tr>
                        <th data-sortby="id">#</th>
                        <th data-sortby="code">Kode Lab</th>
                        <th data-sortby="laboratory">Laboratorium</th>
                        <th>Ka. Laboratorium</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->laboratories as $laboratory)
                        <tr wire:key='{{ $loop->iteration + ($this->laboratories->perPage() * ($this->laboratories->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->laboratories->perPage() * ($this->laboratories->currentPage() - 1)) }}</td>
                            <td>{{ $laboratory->code?? 'N/A' }}</td>
                            <td>{{ $laboratory->name }}</td>
                            <td>{{ $laboratory->members->firstWhere('is_lab_leader')->staff->user->name?? 'N/A' }}</td>
                            <td class="text-center text-nowrap">
                                <x-badges.outline x-on:click="showDetailLaboratory('{{ Crypt::encrypt($laboratory->id) }}')" title="List Prodi" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-rectangle-list fa-lg"></i></i></x-badges.outline>
                                @can('lab-edit')
                                    <x-badges.outline x-on:click="showEditLaboratory('{{ Crypt::encrypt($laboratory->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                @endcan
                                @can('lab-delete')
                                    <x-badges.outline x-on:click="deleteLaboratory('{{ Crypt::encrypt($laboratory->id) }}', '{{ $laboratory->name }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                @endcan
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
            Alpine.data('laboratory', () => {
                return {
                    editLaboratoryState: false,
                    detailLaboratoryState: false,

                    showEditLaboratory(key) {
                        $wire.dispatch("initEditLaboratory", {key: key});
                        this.editLaboratoryState = true;
                    },
                    showDetailLaboratory(key) {
                        $wire.dispatch("initDetailLaboratory", {key: key});
                        this.detailLaboratoryState = true;
                    },
                    deleteLaboratory(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus laboratorium ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Laboratorium Berhasil Dihapus', 'success')
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
