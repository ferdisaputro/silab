<x-container x-data="Object.assign({ createPermissionState: false }, permission())">
    <div>
        @can('permission-edit')
            <x-modals.modal identifier="editPermissionState">
                <livewire:pages.permission.edit />
            </x-modals.modal>
        @endcan

        @can('permission-create')
            <x-modals.modal identifier="createPermissionState">
                <livewire:pages.permission.create />
            </x-modals.modal>
        @endcan
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Permission
            </x-text.page-title>
            {{-- <a href="{{ route('pegawai.create') }}" wire:navigate> --}}
            @can('permission-create')
                <div>
                    <x-buttons.fill x-on:click="createPermissionState = true" color="purple">Tambah Permission</x-buttons.fill>
                </div>
            @endcan

        </div>
        <div>
            <x-tables.datatable id="tabel-permission" :data="$this->permissions" eventTarget="permission">
                <thead>
                    <tr>
                        <th>#</th>
                        <th data-sortby="name">Nama</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->permissions as $index => $permission)
                        <tr wire:key='{{ $loop->iteration + ($this->permissions->perPage() * ($this->permissions->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->permissions->perPage() * ($this->permissions->currentPage() - 1)) }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="text-center">
                                @can('permission-edit')
                                    <x-badges.outline wire:key='{{ $index }}' x-on:click="showEditPermission('{{ Crypt::encrypt($permission->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                @endcan
                                @can('permission-delete')
                                    <x-badges.outline x-on:click="deletePermission('{{ Crypt::encrypt($permission->id) }}', '{{ $permission->name }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('permission', () => {
                return {
                    editPermissionState: false,
                    showEditPermission(key) {
                        $wire.dispatch("initEditPermission", {key: key});
                        this.editPermissionState = true;
                    },

                    deletePermission(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus permission ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Permission Berhasil Dihapus', 'success')
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
