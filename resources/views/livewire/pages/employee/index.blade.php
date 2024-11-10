<x-container x-data="{createEmployeeState: false}">
    <div>
        <x-modals.modal identifier="createEmployeeState" max_width="max-w-6xl">
            <livewire:pages.employee.create />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Pegawai
            </x-text.page-title>
            {{-- <a href="{{ route('employee.create') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="createEmployeeState = true" color="purple">Create Pegawai</x-buttons.fill>
            </div>
        </div>

        <div>
            <x-tables.datatable id="employee-table">
                <thead>
                    <tr>
                        <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Foto<i class="fa-solid fa-sort ms-2"></i></th>
                        <th>Nama<i class="fa-solid fa-sort ms-2"></i></th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 70; $i++)
                        <tr wire:key='{{ $i }}'>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i }}</td>
                            <td>foto-{{ $i }}.png</td>
                            <td>pegawai - {{ $i }}</td>
                            <td class="text-center">
                                <x-badges.outline class="px-2.5 py-1.5" title="Ubah" color="teal"><i class="fa-regular fa-pen-to-square fa-lg"></i></x-badges.outline>
                                <x-badges.outline class="px-2.5 py-1.5" title="Hapus" color="red"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </x-tables.datatable>
        </div>
    </div>
</x-container>
