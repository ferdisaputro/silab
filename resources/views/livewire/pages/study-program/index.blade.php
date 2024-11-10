<x-container x-data="Object.assign({createStudyProgramState: false}, editStudyProgram())">
    <div>
        <x-modals.modal identifier="createStudyProgramState" max_width="max-w-xl">
            <livewire:pages.study-program.create />
        </x-modals.modal>

        <x-modals.modal identifier="editStudyProgramState" max_width="max-w-xl">
            <livewire:pages.study-program.edit />
        </x-modals.modal>
    </div>

    <div class="p-5 space-y-6 bg-white rounded-xl">
        <div class="flex items-center justify-between">
            <x-text.page-title>
                Tabel Program Studi
            </x-text.page-title>
            <div>
                <x-buttons.fill x-on:click="createStudyProgramState = true" title="" color="purple">Tambah Program Studi</x-buttons.fill>
            </div>
        </div>

        <div>
            <livewire:pages.study-program.table-study>
        </div>
    </div>
</x-container>

@pushOnce('scripts')
    @script
        <script>
            Alpine.data('editStudyProgram', () => {
                return {
                    editStudyProgramState: false,
                    showEditStudyProgram (id) {
                        $wire.dispatch('initEditStudyProgram', {id: id});
                        this.editStudyProgramState = true;
                    }
                }
            })
        </script>
    @endscript
@endpushOnce
