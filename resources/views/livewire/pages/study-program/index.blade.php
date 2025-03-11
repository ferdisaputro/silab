<x-container x-data="Object.assign({createStudyProgramState: false}, showEditStudyProgram())">
    <div>
        {{-- $this->authorize('hasPermissionTo', 'jurusan-list|jurusan-create|jurusan-edit|jurusan-delete'); --}}
        @can('jurusan-create')
            <x-modals.modal identifier="createStudyProgramState" max_width="max-w-xl">
                <livewire:pages.study-program.create lazy/>
            </x-modals.modal>
        @endcan
        @can('jurusan-edit')
            <x-modals.modal identifier="showEditStudyProgramState" max_width="max-w-xl">
                <livewire:pages.study-program.edit lazy/>
            </x-modals.modal>
        @endcan
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title class="mb-5 flex items-center gap-4">Tabel Program Studi</x-text.page-title>
            @can('jurusan-create')
                <div>
                    <x-buttons.fill x-on:click="createStudyProgramState = true" title="" color="purple">Tambah Program Studi</x-buttons.fill>
                </div>
            @endcan
        </div>
        <div>
            <livewire:pages.study-program.table-study wire:key='{{ now() }}'>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('showEditStudyProgram', () => {
                return {
                    showEditStudyProgramState: false,
                    showEditStudyProgram (key) {
                        $wire.dispatch('initEditStudyProgram', {key: key});
                        this.showEditStudyProgramState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
