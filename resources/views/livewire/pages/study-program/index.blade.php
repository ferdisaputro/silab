<x-container x-data="Object.assign({createStudyProgramState: false}, showEditStudyProgram())">    
    <div>
        <x-modals.modal identifier="createStudyProgramState" max_width="max-w-xl">
            <livewire:pages.study-program.create lazy/>
        </x-modals.modal>

        <x-modals.modal identifier="showEditStudyProgramState" max_width="max-w-xl">
            <livewire:pages.study-program.edit lazy/>
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white shadow-lg rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title class="mb-5 flex items-center gap-4">Tabel Program Studi</x-text.page-title> 
            <div>
                <x-buttons.fill x-on:click="createStudyProgramState = true" title="" color="purple">Tambah Program Studi</x-buttons.fill>
            </div>
        </div>

        <div>
            <livewire:pages.study-program.table-study lazy wire:key='{{ now() }}'>
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
