<div x-data="{listEmployeeState: false}">
    <div>
        <x-modals.modal identifier="listEmployeeState">
            <livewire:pages.employee.table-employee isSelectable="true" employeeStatus="teknisi" identifier="listEmployeeState" {{-- this is the identifier to close the modal(table-employee modal) --}} />
        </x-modals.modal>
    </div>
    <div class="space-y-6">
        <div class="flex items-center justify-between mb-6">
            <x-text.page-title>
                Pengurus Lab {{ $id }}
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="listEmployeeState = true" color="purple">Tambahkan Teknisi</x-buttons.fill>
            </div>
        </div>

        @if (count($newTechnicians) > 0)
            <div wire:key='testsadfoiuase'>
                <x-alerts.outline class="mb-4" color="blue" title="NEW!" message="Tambahan pengurus laboratorium." />
                <x-tables.datatable>
                    <thead>
                        <tr>
                            <th>#<i class="fa-solid fa-sort ms-2"></i></th>
                            <th>Foto<i class="fa-solid fa-sort ms-2"></i></th>
                            <th>Nama<i class="fa-solid fa-sort ms-2"></i></th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newTechnicians as $newTechnician)
                            <tr wire:key='newTechnician-{{ $loop->iteration }}'>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</td>
                                <td>{{ $newTechnician['foto'] }}</td>
                                <td>{{ $newTechnician['nama'] }}</td>
                                <td class="text-center">
                                    <x-badges.outline title="Hapus karyawan dari laboratory" class="px-2.5 py-1.5" color="yellow"><i class="fa-regular fa-trash-can fa-lg"></i></x-badges.outline>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-tables.datatable>
            </div>
        @endif

        <div>
            @if (count($newTechnicians) > 0)
                <x-alerts.outline wire:key='asiouncasiejuhrfaskdjfh' class="mb-4" color="green" title="OLD!" message="Data lama pengurus laboratorium." />
            @endif
            <livewire:pages.employee.table-employee employeeStatus="teknisi"/>
        </div>
    </div>
</div>



{{-- @pushOnce('scripts')
    @script
        <script>
            Alpine.data('listEmployee', () => {
                return {
                    listEmployeeState: false,
                    showListEmployee(key) {
                        this.listEmployeeState = true
                    }
                }
            })
        </script>
    @endscript
@endPushOnce --}}
