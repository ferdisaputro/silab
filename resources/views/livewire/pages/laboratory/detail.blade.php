<div x-data="listEmployee()">
    <div>
        <x-modals.modal identifier="listEmployeeState">
            <livewire:pages.employee.table-employee identifier="listEmployeeState" isSelectable="true" employeeStatus="teknisi" />
        </x-modals.modal>
    </div>
    <div class="flex items-center justify-between mb-6">
        <x-text.page-title>
            Pengurus Lab {{ $id }}
        </x-text.page-title>
        <div>
            <x-buttons.fill x-on:click="listEmployeeState = true" color="purple">Tambahkan Teknisi</x-buttons.fill>
        </div>
    </div>
    <livewire:pages.employee.table-employee employeeStatus="teknisi" identifier="listEmployeeState" {{-- this is the identifier to close the modal(table-employee modal) --}}/>
</div>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('listEmployee', () => {
                return {
                    listEmployeeState: false,
                    showListEmployee() {
                        this.listEmployeeState = true
                    }
                }
            })
        </script>
    @endscript
@endPushOnce
