<x-container x-data="Object.assign({createEmployeeState: false}, editEmployee())">
    <div>
        <x-modals.modal identifier="createEmployeeState" max_width="max-w-6xl">
            <livewire:pages.employee.create wire:key='createEmployee' />
        </x-modals.modal>

        <x-modals.modal identifier="editEmployeeState" max_width="max-w-6xl">
            <livewire:pages.employee.edit wire:key='editEmployee' />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Pegawai
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createEmployeeState = true" color="purple">Tambah Pegawai</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable :data="$this->users" eventTarget="employee" wire:key='{{ now() }}'>
                <thead>
                    <tr>
                        <th data-sortby="id">#</i></th>
                        <th>Foto</th>
                        <th data-sortby="name">Nama</i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->users as $index => $user)
                        <tr wire:key='{{ $loop->iteration + ($this->users->perPage() * ($this->users->currentPage() - 1)) }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration + ($this->users->perPage() * ($this->users->currentPage() - 1)) }}</td>
                            <td>
                                @if ($user->photo)
                                    <a href="{{ Storage::url($user->photo) }}" target="blank">
                                        <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->photo }}" class="object-cover object-center w-20 h-20 rounded-lg">
                                    </a>
                                @else
                                    <img src="{{ asset('/assets/images/no-profile.jpg') }}" alt="no-profile.jpg" class="w-20 rounded-lg h-2w-20">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td class="text-center">
                                <x-badges.outline x-on:click="showEditEmployee('{{ Crypt::encrypt($user->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-tables.datatable>
        </div>
        {{-- <livewire:pages.employee.table-employee wire:key='{{ now() }}'/> --}}
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editEmployee', () => {
                return {
                    editEmployeeState: false,
                    showEditEmployee(key) {
                        $wire.dispatch('initEditEmployee', {key: key});
                        this.editEmployeeState = true;
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
