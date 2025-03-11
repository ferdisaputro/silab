<x-container x-data="role">
    {{-- modal untuk menampilkan detail role --}}
    <x-modals.modal identifier="detailRoleState" max_width="max-w-3xl">
        <livewire:pages.role.detail></livewire:pages.role.detail>
    </x-modals.modal>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Role
            </x-text.page-title>
            @can('role-create')
                <div x-data="{showDetailModal: false}">
                    <a href="{{ route('role.create') }}" wire:navigate>
                        <x-buttons.fill x-on:click="showDetailModal = true" title="" color="purple">Tambah Role</x-buttons.fill>
                    </a>
                </div>
            @endcan
        </div>

        <div>
            <x-tables.datatable :data="$this->roles" eventTarget="role">
                <thead>
                    <tr>
                        <th data-sortby="id">#</i></th>
                        <th data-sortby="name">Nama</i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->roles as $role)
                        <tr wire:key='{{ $loop->iteration + ($this->roles->perPage() * ($this->roles->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->roles->perPage() * ($this->roles->currentPage() - 1)) }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="text-center">
                                <x-badges.outline class="px-2.5 py-1.5" x-on:click="showDetailRole('{{ Crypt::encrypt($role->id) }}')" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-badges.outline>
                                @can('role-edit')
                                    <a href="{{ route('role.edit', ['key' => Crypt::encrypt($role->id)]) }}" wire:navigate>
                                        <x-badges.outline class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                    </a>
                                @endcan
                                @can('role-delete')
                                    <x-badges.outline x-on:click="deleteRole('{{ Crypt::encrypt($role->id) }}', '{{ $role->name }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('role', () => {
                return {
                    detailRoleState: false,
                    showDetailRole(key) {
                        this.detailRoleState = true;
                        $wire.dispatch('initDetailRole', {key: key})
                    },

                    deleteRole(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus role ${name}?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire('Berhasil', 'Data Role Berhasil Dihapus', 'success')
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
