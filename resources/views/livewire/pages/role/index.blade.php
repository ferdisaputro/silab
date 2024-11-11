<x-container x-data="DetailRole">
    {{-- modal untuk menampilkan detail role --}}
    <x-modals.modal identifier="detailRoleState" max_width="max-w-3xl">
        <x-text.page-title class="mb-3">Detail Permission Role</x-text.page-title>
        <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 md:grid-cols-3">
            {{-- @foreach ($selectedPermissions as $permission) --}}
                @for ($i = 0; $i < 8; $i++)
                    <div class="px-3 py-2 border border-gray-200 rounded-lg dark:border-gray-700">
                        test
                        {{-- {{ $permission->name }} --}}
                    </div>
                @endfor
            {{-- @endforeach --}}
        </div>
    </x-modals.modal>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Role
            </x-text.page-title>
            <div x-data="{showDetailModal: false}">
                <a href="{{ route('role.create') }}" wire:navigate>
                    <x-buttons.fill x-on:click="showDetailModal = true" title="" color="purple">Tambah Role</x-buttons.fill>
                </a>
                {{-- <x-modals.modal identifier="showDetailModal" max_width="max-w-xl">
                    <livewire:pages.pegawai.tambah />
                </x-modals.modal> --}}
            </div>
        </div>

        <div>
            <x-tables.datatable id="tabel-role">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama<i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 50; $i++)
                        <tr wire:key='{{ $i }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i +1 }}</td>
                            <td>Nama - {{ $i + 1 }}</td>
                            <td class="text-center">
                                <x-badges.outline class="px-2.5 py-1.5" x-on:click="showDetailModal" title="Detail" color="green"><i class="fa-regular fa-eye fa-lg"></i></x-badges.outline>
                                <a href="{{ route('role.edit', ['id' => Crypt::encrypt($i)]) }}" wire:navigate>
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
            Alpine.data('DetailRole', () => {
                return {
                    detailRoleState: false,
                    showDetailModal($id) {
                        this.detailRoleState = true;
                        // show Modal and get the data
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
