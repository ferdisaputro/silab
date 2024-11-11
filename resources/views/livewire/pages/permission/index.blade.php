<x-container x-data="Object.assign({ createPermissionState: false }, editModal())">
    <div>
        <x-modals.modal identifier="editModalState">
            <livewire:pages.permission.edit />
        </x-modals.modal>

        <x-modals.modal identifier="createPermissionState">
            <livewire:pages.permission.create />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Permission
            </x-text.page-title>
            {{-- <a href="{{ route('pegawai.create') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="createPermissionState = true" color="purple">Tambah Permission</x-buttons.fill>
            </div>
        </div>
        <div>
            <x-tables.datatable id="tabel-permission">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama<i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 80; $i++)
                        <tr wire:key='{{ $i }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>Nama - {{ $i }}</td>
                            <td class="text-center">
                                <a x-on:click='showEditModal("{{ Crypt::encrypt($i) }}")'>
                                    <x-badges.outline class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                </a>
                                <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
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
            Alpine.data('editModal', () => {
                return {
                    editModalState: false,
                    showEditModal(id) {
                        $wire.dispatch("initEditPermission", {id: id});
                        this.editModalState = true;
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
