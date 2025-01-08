<x-container x-data="Object.assign({createDepartmentState: false}, department())">
    <div>
        <x-modals.modal identifier="createDepartmentState" max_width="max-w-xl">
            <livewire:pages.department.create lazy/>
        </x-modals.modal>

        <x-modals.modal identifier="editDepartmentState" max_width="max-w-xl">
            <livewire:pages.department.edit lazy/>
        </x-modals.modal>

        <x-modals.modal identifier="detailDepartmentState" max_width="max-w-4xl">
            <livewire:pages.department.detail lazy/>
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title class="mb-5 flex items-center gap-4">Tabel Jurusan</x-text.page-title> 
            <div>
                <x-buttons.fill x-on:click="createDepartmentState = true" title="" color="purple">Tambah Jurusan</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-department" :data="$this->departments" eventTarget="department">
                <thead>
                    <tr>
                        <th data-sortby="id">#</i></th>
                        <th data-sortby="code">Kode Jurusan</i></th>
                        <th data-sortby="department">Jurusan</i></th>
                        <th>Ketua Jurusan</i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->departments as $index => $department)
                        <tr wire:key='{{ $loop->iteration + ($this->departments->perPage() * ($this->departments->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->departments->perPage() * ($this->departments->currentPage() - 1)) }}</td>
                            <td>{{ $department->code }}</td>
                            <td>{{ $department->department }}</td>
                            <td>
                                {{ $department->headOfDepartments->firstWhere('is_active', 1)->staff->user->name?? 'N/A' }}
                            </td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showDetailDepartment('{{ Crypt::encrypt($department->id) }}')" title="List Prodi" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-rectangle-list fa-lg"></i></i></x-badges.outline>
                                <x-badges.outline x-on:click="showEditDepartment('{{ Crypt::encrypt($department->id) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline x-on:click="deleteDepartment('{{ Crypt::encrypt($department->id) }}', '{{ $department->department }}')" title="Hapus" class="px-2.5 py-1.5" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('department', () => {
                return {
                    detailDepartmentState: false,
                    showDetailDepartment (key) {
                        $wire.dispatch('initDetailDepartment', {key: key});
                        this.detailDepartmentState = true;
                    },

                    editDepartmentState: false,
                    showEditDepartment (key) {
                        $wire.dispatch('initEditDepartment', {key: key});
                        this.editDepartmentState = true;
                    },

                    deleteDepartment(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus jurusan ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Jurusan Berhasil Dihapus', 'success')
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
