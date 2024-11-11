<x-container x-data="{createEmployeeState: false}">
    <div>
        <x-modals.modal identifier="createEmployeeState" max_width="max-w-6xl">
            <livewire:pages.employee.create />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Data Pegawai
            </x-text.page-title>
            {{-- <a href="{{ route('employee.create') }}" wire:navigate> --}}
            <div>
                <x-buttons.fill x-on:click="createEmployeeState = true" color="purple">Tambah Pegawai</x-buttons.fill>
            </div>
        </div>

        <livewire:pages.employee.table-employee />
    </div>
</x-container>
