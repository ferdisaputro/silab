<x-container x-data="Object.assign({createEmployeeState: false}, employee())">
    <div>
        @can('staff-create')
            <x-modals.modal identifier="createEmployeeState" max_width="max-w-6xl">
                <livewire:pages.employee.create wire:key='createEmployee' />
            </x-modals.modal>
        @endcan

        @can('staff-edit')
            <x-modals.modal identifier="editEmployeeState" max_width="max-w-6xl">
                <livewire:pages.employee.edit wire:key='editEmployee' />
            </x-modals.modal>
        @endcan
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Pegawai
            </x-text.page-title>
            @can('staff-create')
                <div>
                    <x-buttons.fill x-on:click="createEmployeeState = true" color="purple">Tambah Pegawai</x-buttons.fill>
                </div>
            @endcan
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
                                @can('staff-edit')
                                    <x-badges.outline x-on:click="showEditEmployee('{{ Crypt::encrypt($user->id) }}')" class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                @endcan
                                @can('staff-delete')
                                    <x-badges.outline x-on:click="deleteEmployee('{{ Crypt::encrypt($user->id) }}', '{{ addslashes($user->name) }}')" class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                @endcan
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
            Alpine.data('employee', () => {
                return {
                    editEmployeeState: false,
                    showEditEmployee(key) {
                        $wire.dispatch('initEditEmployee', {key: key});
                        this.editEmployeeState = true;
                    },

                    deleteEmployee(key, name) {
                        swal.fire({
                            title: `Hapus Data`,
                            text: `Apakah Anda yakin ingin menghapus data ${name} dari pegawai?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal',
                        }).then(async res => {
                            if (res.isConfirmed) {
                                result = await $wire.delete(key);
                                if (result.original.status !== 'error') {
                                    swal.fire({
                                        text: result.original.message,
                                        icon: 'success'
                                    })
                                    $wire.$refresh() //refresh component from the parent of this component wich is index
                                } else
                                    swal.fire('Gagal', result.original.message, 'error')
                            }
                        })
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
