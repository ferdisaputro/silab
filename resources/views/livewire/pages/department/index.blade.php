<x-container x-data="Object.assign({createDepartmentState: false}, detailDepartment(), editDepartment())">
    <div>
        <x-modals.modal identifier="createDepartmentState" max_width="max-w-xl">
            <livewire:pages.department.create />
        </x-modals.modal>

        <x-modals.modal identifier="editDepartmentState" max_width="max-w-xl">
            <livewire:pages.department.edit />
        </x-modals.modal>

        <x-modals.modal identifier="detailDepartmentState" max_width="max-w-4xl">
            <livewire:pages.department.detail />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Jurusan
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createDepartmentState = true" title="" color="purple">Tambah Department</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-department">
                <thead>
                    <tr>
                        <th># <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Kode Jurusan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Jurusan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Ketua Jurusan <i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>KODE-{{ $i }}</td>
                            <td>Nama jurusan {{ $i }}</td>
                            <td>Ketua jurusan {{ $i }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showDetailDepartment('{{ Crypt::encrypt($i) }}')" title="List Prodi" class="px-2.5 py-1.5" color="blue"><i class="fa-solid fa-rectangle-list fa-lg"></i></i></x-badges.outline>
                                <x-badges.outline x-on:click="showEditDepartment('{{ Crypt::encrypt($i) }}')" title="Edit" class="px-2.5 py-1.5" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
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
            Alpine.data('detailDepartment', () => {
                return {
                    detailDepartmentState: false,
                    showDetailDepartment (id) {
                        $wire.dispatch('initDetailDepartment', {id: id});
                        this.detailDepartmentState = true;
                    }
                }
            })

            Alpine.data('editDepartment', () => {
                return {
                    editDepartmentState: false,
                    showEditDepartment (id) {
                        $wire.dispatch('initEditDepartment', {id: id});
                        this.editDepartmentState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
